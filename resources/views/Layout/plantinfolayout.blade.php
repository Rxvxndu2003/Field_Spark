<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Spark</title>
    <script>
        window.authUser = @json(auth()->user());
    </script>
</head>
<body>
@include('Libraries.plantstyle') 
        @yield('nav')

    
    <main>
        @yield('product')
    </main>
<!-- menu -->
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
 
<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
	@include('scripts.plantscript')
    @stack('scripts')

    @stack('search')
</body>
</html>


