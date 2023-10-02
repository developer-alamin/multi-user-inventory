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