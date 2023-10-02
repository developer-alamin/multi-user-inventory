@extends("frontend.layout.app")
@section("title","Admin Login")
@section("content")
<div class="adminLoginContent">
	<div class="row">
		<div class="col-4 m-auto">
			<div class="card">
				<div class="card-body">
					@if(Session::has("faild"))
			            <div class="alert alert-danger" role="alert">
			             <strong>{{ Session::get("faild") }}</strong>
			            </div>
			          @endif
					<h4>Admin Login</h4>
					<hr>
					<form id="adminLoginForm">
						@csrf
						<div class="row">
							<div class="col-12">
								<label>Emial:</label>
								<input type="email" name="email" class="email form-control" placeholder="Please Email..">
							</div>
							<div class="col-12">
								<label>Pasword:</label>
								<input type="password" name="password" class="password form-control" placeholder="Please Password..">
							</div>
							<div class="col-7 mt-2 m-auto">
								<button type="submit" class="form-control create">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection()
@section("script")
<script type="text/javascript">
	adminLogin();
function adminLogin(){

	var adminLogin = document.querySelector("#adminLoginForm");
	adminLogin.addEventListener("submit",function(e){
		e.preventDefault();
		var email = adminLogin["email"];
		var pass = adminLogin["password"];
		if (email.value && pass.value !== "") {
			removeClass(".ProgressContent","d-none");
			removeClass(".fullScreenDiv","d-none");

			var url = "{{ route('admin.adminPLogin') }}";
			var data = new FormData(adminLogin);
			axios.post(url,data)
			.then(function(response){
				addClass(".ProgressContent","d-none")
				addClass(".fullScreenDiv","d-none")
				if (response.data["faild"]) {
					toastr.error(response.data["faild"]);
				}else{
					toastr.success(response.data["success"]);
					window.open("/admin/dashboard","_SELF")
				}
			})
			.catch(function(error){
				addClass(".ProgressContent","d-none")
				addClass(".fullScreenDiv","d-none")
				toastr.error(response.data["faild"]);
			})
		}else{
			toastr.error("Email And Password");
		}

	})
}
</script>
@endsection()