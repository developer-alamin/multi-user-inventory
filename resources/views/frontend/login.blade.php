@extends("frontend.layout.app")
@section("title","Login Page")
@section("content")
<div class="loginRow">
      <div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="card">
          @if(Session::has("faild"))
            <div class="alert alert-danger" role="alert">
             <strong>{{ Session::get("faild") }}</strong>
            </div>
          @endif
          <div class="card-body">
            <h5>SIGN IN</h5>
            <form id="signFormId">
            	@csrf
              <div class="form-group">
                <div class="col-12">
                  <input type="email" name="email" class="email form-control" placeholder="Enter Your Email">
                </div>
                <div class="col-12 mt-2">
                  <input type="password" name="password" class="password form-control" placeholder="Enter Your Password">
                </div>
                <br>
                <div class="col-12 m-auto">
                  <button type="submit" class="btn form-control loginBtn create">Login</button>
                </div>
                <br>
                <div class="others float-center">
                	<span>
                		<a href="{{ route('web.register') }}">Sign Up</a>
                	</span>
                	 |
                	<span>
                		<a href="{{ route('users.sendOtp') }}">Forget Password</a>
                	</span>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection
@section("script")
<script type="text/javascript">
  signInFunc()
  function signInFunc(){
    var signForm = document.querySelector("#signFormId");
    var email = document.querySelector(".email");
    var password = document.querySelector(".password");
    signForm.addEventListener("submit",function(e){
      e.preventDefault();
      if(email.value == "") {
        toastr.error("Please Email");
      }else if(password.value == ""){
        toastr.error("Please Password");
      }else{
        removeClass(".ProgressContent","d-none");
        removeClass(".fullScreenDiv","d-none");

        var url = "/loginPost";
        var data = new FormData(signForm);

         axios.post(url,data)
        .then(function(response){
          addClass(".ProgressContent","d-none");
          addClass(".fullScreenDiv","d-none");
          if (response.data["email"]) {
            toastr.error(response.data["email"]);
          }else if(response.data["password"]){
            toastr.error(response.data["password"]);
          }else if(response.data["faild"]){
            toastr.error(response.data["faild"]);
          }else{
           window.location.replace("/users/dashboard");
            toastr.success(response.data["success"]);
          }

        })
        .catch(function(error){
          addClass(".ProgressContent","d-none");
          addClass(".fullScreenDiv","d-none");
          console.log(error)

        })
      }
    })
  }

</script>
@endsection