@extends("frontend.layout.app")
@section("title","Password Reset")
@section("content")
<div class="resetPassRow">
	<div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4">

        <div class="card">
          <div class="card-body">
          	<div class="cardImgTitle">
          		<h5>Reset Password</h5>
          		<img src="{{ asset($sendOtp->user->photo) }}" alt="">
          	</div>
            <hr>
            <form id="passResetForm">
            	@csrf
              <div class="form-group">
              	<input type="hidden" name="otp" value="{{ $sendOtp->token }}">
                <div class="col-12">
                  <label>New Password:</label>
                  <input type="password" name="newPass" class="form-control" placeholder="Password">
                </div>
                 <div class="col-12">
                  <label>Confirm Password:</label>
                  <input type="password" name="conPass" class="form-control" placeholder="Password">
                </div>

                <br>
                <div class="col-12 m-auto">
                  <button type="submit" class="btn form-control create">Send</button>
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
</div>
<h4 class="aaa"></h4>
@if(Session::has("otp"))
<h4>{{ Session::get("otp") }}</h4>
@endif
@endsection()
@section("script")
<script type="text/javascript">
	var url = "{{ route('users.passReset') }}";
	passwordReset(url);
	function passwordReset(url){
		var passResetF = document.querySelector("#passResetForm");
		passResetF.addEventListener("submit",function(e){
			e.preventDefault();
			var otp = passResetF["otp"];
			var newPass = passResetF["newPass"];
			var conPass = passResetF["conPass"];

			if (otp.value == "") {
				toastr.error("please otp Verify");
			}else if (newPass.value == "") {
				toastr.error("please New Password");
			}else if (conPass.value == "") {
				toastr.error("please Confirm Password");
			}else if (conPass.value !== newPass.value) {
				toastr.error("Not Match Confirm Password");
			}else{

				 removeClass(".ProgressContent","d-none");
	       		 removeClass(".fullScreenDiv","d-none");

				var data = new FormData(passResetF);
				axios.post(url,data)
				.then(function(response){
					 addClass(".ProgressContent","d-none");
	        		 addClass(".fullScreenDiv","d-none");
					if (response.data["faild"]) {
						toastr.error(response.data["faild"]);
					}else{
						toastr.success("Password Reset Success");
						setTimeout(function(){
			              window.location.href = "{{ route('web.login') }}";
			            },1500);
					}

				})
				.catch(function(error){
					addClass(".ProgressContent","d-none");
	        		addClass(".fullScreenDiv","d-none");
					toastr.error("Request Faild");
				})
			}

		});
	}

</script>
@endsection()