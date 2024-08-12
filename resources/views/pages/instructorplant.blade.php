@extends('Layout.instructorplantlayout')

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
									<li><a href="{{ route('pages.plantinfo') }}">Plants</a></li> 
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


@section('form')
<main>
    <h2>Add a new plant</h2>
    <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-row">
        <div class="form-group">
            <input type="text" id="plant-name" name="name" placeholder="Plant name" required>
        </div>
        <div class="form-group">
            <input type="text" id="plant-origin" name="origin" placeholder="Plant Origin" required>
        </div>
        <div class="form-group">
            <input type="text" id="plant-care" name="care" placeholder="Plant Care" required>
        </div>
    </div>
    <div class="form-group">
        <textarea id="plant-description" name="description" placeholder="Plant description" required></textarea>
    </div>
    <div class="form-group">
        <input type="file" id="plant-image" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn-new">Submit</button>
    </form>

</main>
@endsection

@section('plantTable')
<main>
<h2>Manage Plants</h2>
    <table id="plantsTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Origin</th>
                <th>Care</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- AJAX will populate this -->
        </tbody>
    </table>
</main>
<!-- Edit Plant Modal -->
<div id="editPlantModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Plant</h2>
        <form id="editPlantForm">
            <input type="hidden" id="editPlantId">
            <div class="form-group">
                <label for="editName">Name</label>
                <input type="text" id="editName" required>
            </div>
            <div class="form-group">
                <label for="editOrigin">Origin</label>
                <input type="text" id="editOrigin" required>
            </div>
            <div class="form-group">
                <label for="editCare">Care</label>
                <input type="text" id="editCare" required>
            </div>
            <div class="form-group">
                <label for="editDescription">Description</label>
                <textarea id="editDescription" required></textarea>
            </div>
            <div class="form-group">
                <label for="editImage">Image</label>
                <input type="file" id="editImage" accept="image/*">
            </div>
            <button class="btn-new"type="submit">Save Changes</button>
        </form>
    </div>
</div>

@endsection



@section('footer')
<div class="container3">
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
			<div class="container2">
				<p>Field Spark 2024</p>
				<p>	&copy; Powered by 4GBx</p>
			</div>
		</div>
@endsection




