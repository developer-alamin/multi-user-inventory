<?php
use App\Http\Controllers\frontendController\homeController;
use App\Http\Controllers\frontendController\loginController;
use App\Http\Controllers\frontendController\registerController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/'], function () {
	Route::get("/", [homeController::class, "home"])->name("web.home");
	Route::get("/login", [loginController::class, "login"])->name("web.login");

	Route::post("/loginPost", [loginController::class, "loginPost"])->name("web.loginPost");

	Route::get("/register", [registerController::class, "register"])->name("web.register");
	Route::post("/userStore", [registerController::class, "userStore"])->name("web.userStore");
});