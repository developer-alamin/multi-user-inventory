toastr.options = {
    "positionClass": "toast-bottom-center"
}

toastr.options.extendedTimeOut = 1500; //1000;
toastr.options.timeOut = 1500;
toastr.options.fadeOut = 250;
toastr.options.fadeIn = 250;

function removeClass(ele,action){
	document.querySelector(ele).classList.remove(action);
}
function addClass(ele,action){
	document.querySelector(ele).classList.add(action);
}



// function verifyOtp(){
// 	var verifyOtpF = document.querySelector("#verifyOtpForm");
// 	verifyOtpF.addEventListener("submit",function(e){
// 		e.preventDefault();
// 		var otpNum = verifyOtpF["VerifyOtp"];
// 		if (otpNum.value == "") {
// 			toastr.error("Please Your Otp")
// 		}else{
// 			 removeClass(".ProgressContent","d-none");
//        		 removeClass(".fullScreenDiv","d-none");

// 			var data = new FormData(verifyOtpF);
// 			axios.post(url,data)
// 			.then(function(response){
// 				 addClass(".ProgressContent","d-none");
//         		 addClass(".fullScreenDiv","d-none");
// 				if (response.data["faild"]) {
// 					toastr.error(response.data["faild"])
// 				}else{
// 					toastr.success("OTP Verify Success");
// 					// sessionStorage.clear();
// 					// setTimeout(() => {
// 	                //     window.location.href='/users/passReset'
// 	                // }, 1000);
// 	                console.log(response)
// 				}
// 			})
// 			.catch(function(error){
// 				addClass(".ProgressContent","d-none");
//         		addClass(".fullScreenDiv","d-none");
// 				toastr.error(response.data["faild"])
// 			})
// 		}
// 	});
// }
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

  function adminLogin(url){

	var adminLogin = document.querySelector("#adminLoginForm");
	adminLogin.addEventListener("submit",function(e){
		e.preventDefault();
		var email = adminLogin["email"];
		var pass = adminLogin["password"];
		if (email.value && pass.value !== "") {
			removeClass(".ProgressContent","d-none");
			removeClass(".fullScreenDiv","d-none");

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