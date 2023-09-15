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
                <input type="file" name="Rphoto" class="Rphoto form-control">
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
  function photoPreView(){
  var rPreImg = document.querySelector("#rPreImg");
  var file = document.querySelector(".Rphoto");
  file.addEventListener("change",function(e){
    if (!(e.target.files[0].type.match("image.*"))) {
      toastr.error("Your Image Type Error");
    }else{
      rPreImg.src = URL.createObjectURL(e.target.files[0])
    }

  })
}

function register(){
  var registerForm = document.querySelector("#registerForm");
  var file = registerForm['Rphoto'];

  registerForm.addEventListener("submit",function(e){
    e.preventDefault();

    if (file.files.length == 0) {
      toastr.error('Please User Photo');
    }else if(!(file.files[0].type.match("image.*"))){
      toastr.error("Your Image Type Error");
    }else if (registerForm['Rname'].value == "") {
      toastr.error('Please User Name');
    }else if (registerForm['Remail'].value == "") {
      toastr.error('Please User Email');
    }else if (registerForm['Rphone'].value == "") {
      toastr.error('Please User Mobile');
    }else if(registerForm['Rphone'].value.length > 11){
      toastr.error('Number Less Then 12');
    }else if (registerForm['RshopName'].value == "") {
      toastr.error('Please User Shop Name');
    }else if (registerForm['Rvillage'].value == "") {
      toastr.error('Please User Village');
    }else if (registerForm['Rpassword'].value == "") {
      toastr.error('Please User Password');
    }else{

      removeClass(".ProgressContent","d-none");
      removeClass(".fullScreenDiv","d-none");

      var url = "/userStore";
      var data = new FormData(registerForm);
      axios.post(url,data)
      .then(function(response){
        addClass(".ProgressContent","d-none");
        addClass(".fullScreenDiv","d-none");
        if (response.status == 200) {
          Swal.fire("Success","congratulations for registration","success");
          registerForm.reset();
        }else{
          Swal.fire("Sorry","Your registration Faild","error");
          registerForm.reset();
        }

      })
      .catch(function(error){
        addClass(".ProgressContent","d-none");
        addClass(".fullScreenDiv","d-none");
        Swal.fire("Sorry","Your registration Faild","error");
        registerForm.reset();

      })
    }

  })
}
</script>
@endsection