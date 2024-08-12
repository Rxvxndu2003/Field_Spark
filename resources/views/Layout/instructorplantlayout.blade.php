<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Field Spark - Add a new plant</title>

</head>
<body>
@include('Libraries.instructorplantstyle') 
<div class="banner">
		<div class="container3">
           @yield('navbar')
        </div>
</div>
<!-- breadcrumbs -->
<div class="breadcrumbs">
		<div class="container2">
			<div class="w3layouts_breadcrumbs_left">
				<ul>
					<li><i class="fa fa-home" aria-hidden="true"></i><a href="{{ route('pages.instructordashboard') }}">Dashboard</a><span>/</span></li>
					<li><i class="fa fa-picture-o" aria-hidden="true"></i>Instructor Plants</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

    <div class="container">
        @yield('form')
    </div>
    <div class="container1">
       @yield('plantTable')
    </div>
    <div class="footer">
		@yield('footer')
	</div>
    @include('scripts.plantscript') 
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
<!-- //menu -->


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const plantsTableBody = document.querySelector('#plantsTable tbody');
    const editPlantModal = document.getElementById('editPlantModal');
    const editForm = document.getElementById('editPlantForm');
    const closeModal = document.querySelector('.close');

    // Fetch and display plants
    fetch('{{ route('plants.api') }}')
        .then(response => response.json())
        .then(data => {
            data.forEach(plant => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${plant.name}</td>
                    <td>${plant.origin}</td>
                    <td>${plant.care}</td>
                    <td>${plant.description}</td>
                    <td>${plant.image ? `<img src="{{ asset('storage/') }}/${plant.image}" alt="${plant.name}" width="100">` : 'No image'}</td>
                    <td class="actions">
                        <button class="edit-btn" data-id="${plant.id}">Edit</button>
                        <button class="delete-btn" data-id="${plant.id}">Delete</button>
                    </td>
                `;
                plantsTableBody.appendChild(row);
            });

           // Open the edit modal and populate fields
        $(document).on('click', '.edit-btn', function() {
            const plantId = $(this).data('id');
            const plantName = $(this).data('name');
            const plantOrigin = $(this).data('origin');
            const plantCare = $(this).data('care');
            const plantDescription = $(this).data('description');
            const plantImage = $(this).data('image');

            $('#editPlantId').val(plantId);
            $('#editName').val(plantName);
            $('#editOrigin').val(plantOrigin);
            $('#editCare').val(plantCare);
            $('#editDescription').val(plantDescription);

            // Show current image (if any)
            if (plantImage) {
                $('#currentImage').attr('src', '/storage/' + plantImage).show();
            } else {
                $('#currentImage').hide();
            }

            $('#editPlantModal').show();
        });

        // Close the modal
        $('.close').click(function() {
            $('#editPlantModal').hide();
        });

        // Handle edit form submission
        $('#editPlantForm').on('submit', function(event) {
    event.preventDefault();
    const plantId = $('#editPlantId').val();
    const formData = new FormData();
    formData.append('name', $('#editName').val());
    formData.append('origin', $('#editOrigin').val());
    formData.append('care', $('#editCare').val());
    formData.append('description', $('#editDescription').val());

    const imageFile = $('#editImage')[0].files[0];
    if (imageFile) {
        formData.append('image', imageFile);
    }

    $.ajax({
        url: `/api/plants/${plantId}`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            if (response.success) {
                alert('Plant updated successfully.');
                editPlantModal.style.display = 'none';
                location.reload(); 
                fetchPlants(); // Refresh the page
            } else {
                alert('Failed to update plant.');
            }
        },
        error: function(error) {
            console.error('Error updating plant:', error);
            alert('Failed to update plant.');
        }
    });
});

            // Add click event to delete buttons
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const plantId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this plant?')) {
                        fetch(`/plants/${plantId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                alert(data.success);
                                location.reload(); // Reload page to reflect changes
                            })
                            .catch(error => console.error('Error deleting plant:', error));
                    }
                });
            });
        })
        .catch(error => console.error('Error fetching plant data:', error));

    // Close the modal
    closeModal.onclick = function () {
        editPlantModal.style.display = 'none';
    }

    // Save changes made in the edit modal
    editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const plantId = document.getElementById('editPlantId').value;
        const formData = new FormData(this);
        formData.append('_method', 'PUT');

        fetch(`/plants/${plantId}`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    editPlantModal.style.display = 'none';
                    location.reload(); // Reload page to reflect changes
                } else {
                    console.error('Failed to update plant:', data.error);
                }
            })
            .catch(error => console.error('Error updating plant:', error));
    });

    // Close the modal when clicking outside of it
    window.onclick = function (event) {
        if (event.target == editPlantModal) {
            editPlantModal.style.display = 'none';
        }
    }
});

</script>

<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="b48ca7c7-c3fc-4bf5-acf7-c6bbc1bc1e37";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</body>
</html>