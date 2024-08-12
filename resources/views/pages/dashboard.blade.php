@extends('Layout.dashboardlayout')

@section('nav')
<nav>
            <div class="w3_agileits_banner_main_grid">
                <div class="w3_agile_logo">
					<h1><a href="{{ route('dashboard') }}"><span>F</span>ieldSpark<i>Grow healthy products</i></a></h1>
				</div>
				<div class="agileits_w3layouts_menu">
					<div class="shy-menu">
						<a class="shy-menu-hamburger">
							<span class="layer top"></span>
							<span class="layer mid"></span>
							<span class="layer btm"></span>
						</a>
						<div class="shy-menu-panel">
							<nav class="menu menu--horatio link-effect-8" id="link-effect-8">
								<ul class="w3layouts_menu__list">
									<li class="active"><a href="{{ route('dashboard') }}">Home</a></li>
									<li><a href="{{ route('pages.appointment') }}">Appointments</a></li> 
									<li><a href="{{ route('pages.discussion') }}">Discussion Forum</a></li>
									<li><a href="{{ route('pages.plantinfo') }}">Plants</a></li> 
									<li><a href="{{ route('pages.resource') }}">Resources</a></li>
									<li class="dropdown">
                                    @auth
                                    <div class="profile-dropdown">
                                         <button class="profile-button">{{ Auth::user()->name }}</button>
                                         <div class="profile-menu">
                                               <a href="{{ route('profile.show') }}">Profile</a>
                                               <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                   @csrf
                                               </form>
                                         </div>
                                    </div>
                                    @endauth
                                </li>
								</ul>
							</nav>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
</nav>
    <div class="content">
        <h1>Welcome To The Place Where Natural Beauty Born</h1>
        <p>Field Spark empowers farmers with cutting-edge technology, offering real-time data, expert guidance,<br> and sustainable solutions to boost agricultural productivity.</p>
        <div>
            <a href="{{ route('pages.appointment') }}" class="link"><button type="button"><span></span>Make a Appoinment</button></a>
            <a href="{{ route('pages.plantinfo') }}" class="link"><button type="button"><span></span>Search plants</button></a>
		    <a href="{{ route('pages.instructors') }}" class="link"><button type="button"><span></span>Search Instructors</button></a>	
        </div> 

    </div>
@endsection

@section('background')
			<h3 class="agileits_w3layouts_head agileinfo_head w3_head"><span>What</span> we do</h3>
			<div class="w3_agile_image">
				<img src="images/17.png" alt=" " class="img-responsive-new">
			</div>
			<p class="agile_para agileits_para">We support farmers by providing knowledge, sustainable practices, and modern tools, ensuring a resilient and thriving agricultural future.</p>
			<div class="w3ls_news_grids">
				<div class="col-md-4 w3_agileits_services_bottom_grid">
					<div class="wthree_services_bottom_grid1">
						<img src="images/5.jpg" alt=" " class="img-responsive" />
						<div class="wthree_services_bottom_grid1_pos">
							<h4>Fertilizing</h4>
						</div>
					</div>
					<div class="agileinfo_services_bottom_grid2">
						<p>Fertilizing enriches soil, ensuring plants receive the nutrients they need to grow strong and healthy, enhancing yields.</p>
						<!-- <div class="agileits_w3layouts_learn_more hvr-radial-out">
							<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
						</div> -->
					</div>
				</div>
				<div class="col-md-4 w3_agileits_services_bottom_grid">
					<div class="wthree_services_bottom_grid1">
						<img src="images/6.jpg" alt=" " class="img-responsive" />
						<div class="wthree_services_bottom_grid1_pos">
							<h4>Soil Testing</h4>
						</div>
					</div>
					<div class="agileinfo_services_bottom_grid2">
						<p>Soil testing analyzes nutrient content and pH levels, helping gardeners adjust their care for optimal plant growth.</p>
						<!-- <div class="agileits_w3layouts_learn_more hvr-radial-out">
							<a href="#" data-toggle="modal" data-target="#myModal">Read More</a>
						</div> -->
					</div>
				</div>
				<div class="col-md-4 w3_agileits_services_bottom_grid">
					<div class="wthree_services_bottom_grid1">
						<img src="images/3.jpg" alt=" " class="img-responsive" />
						<div class="wthree_services_bottom_grid1_pos">
							<h4>Planting</h4>
						</div>
					</div>
					<div class="agileinfo_services_bottom_grid2">
						<p>Planting seeds or seedlings in prepared soil starts the journey of nurturing a garden, leading to fruitful harvests.</p>
						<!-- <div class="agileits_w3layouts_learn_more hvr-radial-out">
							<a href="/" data-toggle="modal" data-target="#myModal">Read More</a>
						</div> -->
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
@endsection

@section('footer')
<div class="footer">
	    <div class="container">
			<div class="w3agile_footer_grids">
				<div class="col-md-3 agileinfo_footer_grid">
					<div class="agileits_w3layouts_footer_logo">
					<h2><a href="/"><span>F</span>eildSpark<i>Grow healthy products</i></a></h2>
					</div>
				</div>
				<div class="col-md-4 agileinfo_footer_grid">
					<h3>Contact Info</h3>
					<h4>Call Us <span>+94 713300619</span></h4>
					<p>Field Spark,No.78, Main Road, Kegalle. <span>71000 Sri Lanka.</span></p>
					<ul class="agileits_social_list">
						<li><a href="#" class="w3_agile_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="#" class="agile_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
						<li><a href="#" class="w3_agile_vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="col-md-2 agileinfo_footer_grid agileinfo_footer_grid1">
					<h3>Navigation</h3>
					<ul class="w3layouts_footer_nav">
						<li><a href="/"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>Home</a></li>
						<li><a href="/aboutus"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>About Us</a></li>
						<li><a href="/services"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>Services</a></li>
						<li><a href="/contactus"><i class="fa fa-long-arrow-right" aria-hidden="true"></i>Contact Us</a></li>
					</ul>
				</div>
				<div class="col-md-3 agileinfo_footer_grid">
					<h3>Blog Posts</h3>
					<div class="agileinfo_footer_grid_left">
						<a href="#" data-toggle="modal" data-target="#myModal"><img src="images/6.jpg" alt=" " class="img-responsive" /></a>
					</div>
					<div class="agileinfo_footer_grid_left">
						<a href="#" data-toggle="modal" data-target="#myModal"><img src="images/2.jpg" alt=" " class="img-responsive" /></a>
					</div>
					<div class="agileinfo_footer_grid_left">
						<a href="#" data-toggle="modal" data-target="#myModal"><img src="images/5.jpg" alt=" " class="img-responsive" /></a>
					</div>
					<div class="agileinfo_footer_grid_left">
						<a href="#" data-toggle="modal" data-target="#myModal"><img src="images/3.jpg" alt=" " class="img-responsive" /></a>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<div class="w3_agileits_footer_copy">
			<div class="container">
				<p>Field Spark 2024</p>
				<p>	&copy; Powered by 4GBx</p>
			</div>
		</div>
</div>
@endsection

