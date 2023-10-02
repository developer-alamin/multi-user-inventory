@extends("admin.layout.app")
@section("title","Admin | Profile")
@section("content")
<div class="profileContent">
	<div class="row">
		<div class="col-11 m-auto">
			<div class="card
			flex-row">
				<img src="{{ asset("img/alamin.jpg") }}" alt="">
				<div class="card-body ">
					<div class="userInfo">
						<div class="row">
							<h6>Profile Of Alamin</h6>
							<div class="col-12">
								<div class="row">
									<div class="col-1">
										<label>Name:</label>
									</div>
									<div class="col-4">
										<label>{{ $data->name }}</label>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-1">
										<label>Email:</label>
									</div>
									<div class="col-4">
										<label>{{ $data->email }}</label>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-1">
										<label>Phone:</label>
									</div>
									<div class="col-4">
										<label>{{ __("01740816676") }}</label>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-1">
										<label>About:</label>
									</div>
									<div class="col-11">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.
										Lorem ipsum dolor sit amet, consectetur adipisicing elit.

										</p>
									</div>
								</div>

							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection()