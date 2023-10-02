@extends("frontend.layout.app")
@section("title","User | Send Otp")
@section("content")
<div class="forgetRow">
	<div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="card">
          <div class="card-body">
            <h5>EMAIL ADDRESS</h5>
            <hr>
            <form id="mailSendForm">
            	@csrf
              <div class="form-group">
                <div class="col-12">
                	<label>Email:</label>
                  <input type="email" name="SendEmail" class="SendEmail form-control" placeholder="Enter Your Email">
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
@endsection()
@section("script")
<script type="text/javascript">
	var url = "{{ route('users.sendOtp') }}";
	sendMail(url);
  function sendMail(url){
    var SendForm = document.querySelector("#mailSendForm");
    SendForm.addEventListener("submit",function(e){
      e.preventDefault();
      var email = SendForm["SendEmail"];
      if (email.value == "") {
        toastr.error("Please Email");
      }else{
        removeClass(".ProgressContent","d-none");
        removeClass(".fullScreenDiv","d-none");

        var data = new FormData(SendForm);
        axios.post(url,data)
        .then(function(response){
          addClass(".ProgressContent","d-none");
          addClass(".fullScreenDiv","d-none");
          if (response.data["faild"]) {
            toastr.error(response.data["faild"]);
          }else{
            toastr.success(response.data["success"]);
            sessionStorage.setItem('email',email);
            setTimeout(function(){
              window.location.href = "{{ route('users.verifyOtp') }}";
            },1000);
          }

        })
        .catch(function(error){
          addClass(".ProgressContent","d-none");
          addClass(".fullScreenDiv","d-none");
          toastr.error(response.data["faild"]);
        })
      }
    });
  }
</script>
@endsection()