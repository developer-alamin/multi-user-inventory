toastr.options = {
    "positionClass": "toast-bottom-center"
}
toastr.options.extendedTimeOut = 1500; //1000;
toastr.options.timeOut = 1500;
toastr.options.fadeOut = 250;
toastr.options.fadeIn = 250;

var loader = "<span class='spinner-border text-warning'></span>";
var loaderSpen = " <span class='spinner-border spinner-border-sm'></span>";

function img(clas,path){
    document.querySelector(clas).src = path;
}
function html(element,html){
	document.querySelector(element).innerHTML = html;
}
function element(element, values) {
    document.querySelector(element).value = values;
}

function addClass(ele, action) {
    document.querySelector(ele).classList.add(action);
}

function removeClass(ele, action) {
    document.querySelector(ele).classList.remove(action);
}
