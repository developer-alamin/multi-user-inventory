<header id="header" class="">
	<div class="container">
		<div class="row">
			<div class="col-6 collumnRight">
				<a href="{{ route('web.home') }}">
					<img class="logo" src="{{ asset("img/logo.png") }}" alt="" style="width:100px">
				</a>
			</div>
			<div class="col-6 collumnLeft">
				<nav>
					<ul>
						<li><a href="{{ route("web.home") }}">Home</a></li>
						<li><a href="{{ route("web.login") }}">Login</a></li>
						<li><a href="{{ route("web.register") }}">Register</a></li>
						<li><a href="{{ route('admin.login') }}">Admin</a></li>

					</ul>
				</nav>
			</div>
		</div>
	</div>
</header><!-- /header -->