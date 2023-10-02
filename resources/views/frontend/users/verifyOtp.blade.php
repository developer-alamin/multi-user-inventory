@extends("frontend.layout.app")
@section("title","User | OTP")
@section("content")
<div class="verifyOtpDiv">
	<div class="col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4">
        <div class="card">
          <div class="card-body">
            <h5>Verify Otp</h5>
            <hr>
           @if($errors->has("VerifyOtp"))
             <div class="alert alert-danger" role="alert">
              <strong>Error !</strong> {{ $errors->first("VerifyOtp") }}
            </div>
            @elseif(Session::has("faild"))
            <div class="alert alert-danger" role="alert">
              <strong>Error !</strong> {{ session::get("faild") }}
            </div>
            @endif
            <form action="{{ route('users.verifyOtp') }}" method="post">
            	@csrf
              <div class="form-group">
                <div class="col-12">
                	<label>Otp:</label>
                  <input type="number" name="VerifyOtp" class="VerifyOtp form-control" placeholder="Otp Code">
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
  // var url = "{{ route('users.verifyOtp') }}";
  // verifyOtp(url);
</script>
@endsection()