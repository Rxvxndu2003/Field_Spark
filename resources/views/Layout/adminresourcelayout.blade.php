<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Field Spark - Add a new plant</title>

</head>
<body>
@include('Libraries.resourcestyle') 
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
					<li><i class="fa fa-picture-o" aria-hidden="true"></i>Add New Resources</li>
				</ul>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
    <div class="container">
        @yield('form')
    </div>
    <div class="container1">
       @yield('ResourceTable')
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function fetchResources() {
            $.ajax({
                url: '/api/resources',
                method: 'GET',
                success: function(resources) {
                    const tbody = $('#resourcesTable tbody');
                    tbody.empty();

                    resources.forEach(resource => {
                        const row = `
                            <tr>
                                <td>${resource.title}</td>
                                <td>${resource.description}</td>
                                <td><img src="/storage/${resource.image}" alt="${resource.title}" style="width: 100px;"></td>
                                <td class="actions">
                                    <button class="edit-btn" data-id="${resource.id}">Edit</button>
                                    <button class="delete-btn" data-id="${resource.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                },
                error: function(error) {
                    console.error('Error fetching resources:', error);
                }
            });
        }

        fetchResources();

        // Handle form submission
        $('form').on('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert('Resource added successfully.');
                    // Reload the page after successful submission
                    location.reload();
                },
                error: function(error) {
                    console.error('Error adding resource:', error);
                    alert('Failed to add resource.');
                }
            });
        });


         // Open the edit modal and populate fields
        $(document).on('click', '.edit-btn', function() {
            const resourceId = $(this).data('id');
            const resourceTitle = $(this).data('title');
            const resourceDescription = $(this).data('description');
            const resourceImage = $(this).data('image');

            $('#editResourceId').val(resourceId);
            $('#editName').val(resourceTitle);
            $('#editDescription').val(resourceDescription);

            // Show current image (if any)
            if (resourceImage) {
                $('#currentImage').attr('src', '/storage/' + resourceImage).show();
            } else {
                $('#currentImage').hide();
            }

            $('#editResourceModal').show();
        });

        // Close the modal
        $('.close').click(function() {
            $('#editResourceModal').hide();
        });

        // Handle edit form submission
        $('#editResourceForm').on('submit', function(event) {
            event.preventDefault();
            const resourceId = $('#editResourceId').val();
            const formData = new FormData();
            formData.append('title', $('#editName').val());
            formData.append('description', $('#editDescription').val());

            const imageFile = $('#editImage')[0].files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            $.ajax({
                url: `/api/resources/${resourceId}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    if (response.success) {
                        alert('Resource updated successfully.');
                        $('#editResourceModal').hide();
                        fetchResources();
                    } else {
                        alert('Failed to update resource.');
                    }
                },
                error: function(error) {
                    console.error('Error updating resource:', error);
                    alert('Failed to update resource.');
                }
            });
        });

        // Handle delete button
        $(document).on('click', '.delete-btn', function() {
            const resourceId = $(this).data('id');
            if (confirm('Are you sure you want to delete this resource?')) {
                $.ajax({
                    url: `/api/resources/${resourceId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                    },
                    success: function() {
                        fetchResources();
                        alert('Resource deleted successfully.');
                    },
                    error: function(error) {
                        console.error('Error deleting resource:', error);
                        alert('Failed to delete resource.');
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="b48ca7c7-c3fc-4bf5-acf7-c6bbc1bc1e37";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</body>
</html>