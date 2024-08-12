<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Appointments</title>
    <link rel="stylesheet" href="instrucotrappoinment.css">
</head>
<body data-instructor-id="{{ Auth::guard('instructor')->user()->id }}">
@include('Libraries.adminappointstyle')
<div class="banner">
		<div class="container">
           @yield('navbar')
        </div>
</div>
<!-- breadcrumbs -->
<div class="breadcrumbs">
		<div class="container">
			<div class="w3layouts_breadcrumbs_left">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('pages.instructordashboard') }}">Dashboard</a><span>/</span></li>
					<li><i class="fa fa-picture-o" aria-hidden="true"></i>Appointments</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

    <main>
        <div class="container">
            <div class="card">
                @yield('table')
            </div>
        </div>
    </main>
    @yield('transfer')
    <div class="footer">
		@yield('footer')
	</div>
    @include('scripts.dashscripts')
     <script>
		$(function() {
			
			initDropDowns($("div.shy-menu"));

		});

		function initDropDowns(allMenus) {

			allMenus.children(".shy-menu-hamburger").on("click", function() {
				
				var thisTrigger = jQuery(this),
					thisMenu = thisTrigger.parent(),
					thisPanel = thisTrigger.next();

				if (thisMenu.hasClass("is-open")) {

					thisMenu.removeClass("is-open");

				} else {			
					
					allMenus.removeClass("is-open");	
					thisMenu.addClass("is-open");
					thisPanel.on("click", function(e) {
						e.stopPropagation();
					});
				}
				
				return false;
			});
		}
	</script>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the instructor ID from the data attribute
            const instructorId = document.body.getAttribute('data-instructor-id');

            // Fetch the appointment data via AJAX
            fetch(`/api/instructors/${instructorId}/appointments`)
                .then(response => response.json())
                .then(data => {
                    const appointmentsTableBody = document.querySelector('#appointmentsTable tbody');

                    // Clear existing table rows
                    appointmentsTableBody.innerHTML = '';

                    // Iterate through the appointments and render each row
                    data.forEach(appointment => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${appointment.first_name}</td>
                            <td>${appointment.last_name}</td>
                            <td>${appointment.contact_number}</td>
                            <td>${appointment.date} at ${appointment.time}</td>
                            <td class="action-cell">
                                <button class="start">Start</button>
                                <button class="transfer">Transfer</button>
                                <button class="delete" data-id="${appointment.id}">Delete</button>
                            </td>
                        `;
                        appointmentsTableBody.appendChild(row);
                    });
                })
                .catch(error => console.error('Error fetching appointment data:', error));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const appointmentsTableBody = document.querySelector('#appointmentsTable tbody');

    // Event delegation: listen for clicks on delete buttons within the table body
    appointmentsTableBody.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete')) {
            const appointmentId = event.target.getAttribute('data-id');

            // Confirm before deleting
            if (confirm('Are you sure you want to delete this appointment?')) {
                fetch(`/api/appointments/${appointmentId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For CSRF protection in Laravel
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Remove the row from the table
                        event.target.closest('tr').remove();
                        alert('Appointment deleted successfully.');
                    } else {
                        throw new Error('Error deleting appointment.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        }
    });
});

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
    const appointmentsTableBody = document.querySelector('#appointmentsTable tbody');
    const transferModal = document.getElementById('transferModal');
    const instructorList = document.getElementById('instructorList');
    let selectedAppointmentId = null;

    // Event delegation for the Transfer button
    appointmentsTableBody.addEventListener('click', function(event) {
        if (event.target.classList.contains('transfer')) {
            selectedAppointmentId = event.target.closest('tr').querySelector('.delete').getAttribute('data-id');
            showTransferModal();
        }
    });

    // Show the transfer modal and load instructors
    function showTransferModal() {
        // Fetch instructors and populate the list
        fetch('/api/instructors')
            .then(response => response.json())
            .then(instructors => {
                instructorList.innerHTML = ''; // Clear previous list
                instructors.forEach(instructor => {
                    const li = document.createElement('li');
                    li.classList.add('instructor-item');
                    li.setAttribute('data-id', instructor.id);
                    li.innerHTML = `
                        ${instructor.name}
                        <span class="checkmark">&#10003;</span>
                    `;
                    instructorList.appendChild(li);
                });
                transferModal.style.display = 'flex';
            })
            .catch(error => console.error('Error fetching instructors:', error));
    }

    // Handle instructor selection
    instructorList.addEventListener('click', function(event) {
        const selected = document.querySelector('.instructor-item.selected');
        if (selected) {
            selected.classList.remove('selected');
        }
        if (event.target.classList.contains('instructor-item')) {
            event.target.classList.add('selected');
        }
    });

    // Confirm transfer
    document.getElementById('confirmTransfer').addEventListener('click', function() {
        const selectedInstructor = document.querySelector('.instructor-item.selected');
        if (selectedInstructor && selectedAppointmentId) {
            const instructorId = selectedInstructor.getAttribute('data-id');

            // Send the transfer request to the server
            fetch(`/api/appointments/${selectedAppointmentId}/transfer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ instructor_id: instructorId })
            })
            .then(response => {
                if (response.ok) {
                    alert('Appointment transferred successfully.');
                    transferModal.style.display = 'none';
                    location.reload(); // Reload to reflect changes
                } else {
                    throw new Error('Error transferring appointment.');
                }
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert('Please select an instructor.');
        }
    });

    // Close the modal
    document.getElementById('closeModal').addEventListener('click', function() {
        transferModal.style.display = 'none';
    });
});
    </script>
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="b48ca7c7-c3fc-4bf5-acf7-c6bbc1bc1e37";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</body>
</html>
