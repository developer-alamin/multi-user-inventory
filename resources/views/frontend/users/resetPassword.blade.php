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

</script>
@endsection()