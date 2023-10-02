@extends("frontend.layout.app")
@section("title","Register Page")
@section("content")
<div class="ProgressContent d-none">
  <div class="progress-bar">
    <div class="progress-bar-value"></div>
  </div>
</div>
<div class="fullScreenDiv d-none"></div>

<div class="registerContent">
  <div class="col-10 m-auto">
    <div class="card">
      <div class="card-body">
        <div class="cardHeadingRow">
          <h4 class="card-title">Sign Up</h4>
          <img src="{{ asset('img/image-gallery.jpg') }}" id="rPreImg" alt="">
        </div>

        <hr>
        <div class="registerForm">
          <form id="registerForm" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Photo:</label>
                <input type="file" accept="image/*" name="Rphoto" class="Rphoto form-control">
              </div>
               <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Name:</label>
                <input type="text" name="Rname" class="Rname form-control" placeholder="Enter Your Name...">
              </div>
               <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Email:</label>
                <input type="email" name="Remail" class="Remail form-control" placeholder="Enter Your Email...">
              </div>
               <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Mobile:</label>
                <input type="number" name="Rphone" class="Rphone form-control" placeholder="Enter Your Phone...">
              </div>
              <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Shop Name:</label>
                <input type="text" name="RshopName" class="RshopName form-control" placeholder="Enter Your Shop Name...">
              </div>
              <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Village:</label>
                <input type="text" name="Rvillage" class="Rvillage form-control" placeholder="Enter Your Village Name...">
              </div>
              <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label>Password:</label>
                <input type="password" name="Rpassword" class="Rpassword form-control" placeholder="Enter Your Password...">
              </div>
              <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-4">
                <label></label>
                <button type="submit" class="form-control create">Register</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section("script")
<script type="text/javascript">
  register();
  photoPreView();

</script>
@endsection