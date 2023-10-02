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