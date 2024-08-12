@extends('Layout.adminappointlayout')


@section('navbar')
            <div class="w3_agileits_banner_main_grid">
               <div class="w3_agile_logo">
					<h1><a href="{{ route('pages.instructordashboard') }}"><span>F</span>ieldSpark<i>Grow healthy products</i></a></h1>
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
									<li class="active"><a href="{{ route('pages.instructordashboard') }}">Home</a></li>
									<li><a href="{{ route('pages.adminappoint') }}">Appointments</a></li> 
									<li><a href="{{ route('pages.idiscussion') }}">Discussion Forum</a></li>
									<li><a href="{{ route('pages.instructorplant') }}">Plants</a></li> 
									<li><a href="{{ route('pages.adminresource') }}">Resources</a></li>
									<li class="dropdown">
                                    @auth('instructor')
                                    <div class="profile-dropdown">
                                         <button class="profile-button">{{ Auth::guard('instructor')->user()->name }}</button>
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
@endsection


@section('table')
<h2>Manage Appointments</h2>
<table id="appointmentsTable">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Phone Number</th>
            <th>Details</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <!-- AJAX will populate this -->
    </tbody>
</table>

@endsection

@section('transfer')
<!-- Modal Structure -->
<div id="transferModal" class="modal" style="display: none;">
    <div class="modal-content">
        <h4>Select Instructor</h4>
        <ul id="instructorList">
            <!-- Instructors will be loaded here -->
        </ul>
        <button id="confirmTransfer">Transfer</button>
        <button id="closeModal">Close</button>
    </div>
</div>
@endsection

@section('footer')
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
@endsection