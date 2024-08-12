<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Spark Discussion Forum - Farmers</title>
    <script>
        window.authUser = @json(auth()->user());
    </script>
   
</head>

<body>
    @include('Libraries.discussionstyle') 
	<div class="banner1">
		<div class="container">
           @yield('navbar')
        </div>
    </div>
	<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			@yield('breadcrumbs')
		</div>
	</div>
<!-- //breadcrumbs -->
    <div class="forum-container">
       @yield('forum')
    </div>

    <div id="question-detail" class="question-detail hidden">
        @yield('question')
    </div>
    <!-- banner-bottom -->
	<div class="footer">
		@yield('footer')
	</div>
<!-- //banner-bottom -->
    
     <!-- JavaScript Libraries -->
     @include('scripts.scripts') 
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
<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="b48ca7c7-c3fc-4bf5-acf7-c6bbc1bc1e37";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
</body>
</html>
