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


