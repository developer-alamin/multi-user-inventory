<?php
use App\Http\Controllers\adminController\dashboradController;
use App\Http\Controllers\adminController\loginController;
use App\Http\Controllers\adminController\profileController;
use App\Http\Controllers\adminController\usersController;
use App\Http\Middleware\adminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get("admin/", [loginController::class, "login"])->name("admin.login");
Route::post("admin/adminPLogin", [loginController::class, "adminPLogin"])->name("admin.adminPLogin");

Route::middleware([adminMiddleware::class])->group(function () {
	Route::group(['prefix' => '/admin'], function () {
		Route::get("/dashboard", [dashboradController::class, "dashboard"])->name("admin.dashboard");

		Route::get("/users", [usersController::class, "users"])->name("admin.users");

		Route::get("/usersInfo", [usersController::class, "usersInfo"])->name("admin.usersInfo");

		Route::post("/usersShow", [usersController::class, "usersShow"])->name("admin.usersShow");
		Route::post("/adUserUpdate", [usersController::class, "adUserUpdate"])->name("admin.adUserUpdate");
		Route::post("/usersDel", [usersController::class, "usersDel"])->name('admin.usersDel');
		Route::get("/profile", [profileController::class, "adminProfile"])->name("admin.profile");
		Route::get("/logout", [loginController::class, "logout"])->name("admin.logout");
	});
});
