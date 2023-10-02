
<?php
use App\Http\Controllers\usersController\brandController;
use App\Http\Controllers\usersController\categoryController;
use App\Http\Controllers\usersController\customerController;
use App\Http\Controllers\usersController\dashboardController;
use App\Http\Controllers\usersController\invoiceController;
use App\Http\Controllers\usersController\productController;
use App\Http\Controllers\usersController\profileController;
use App\Http\Controllers\usersController\reportController;
use App\Http\Controllers\usersController\salesController;
use App\Http\Controllers\usersController\SendController;
use App\Http\Middleware\userMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "/users"], function () {
	Route::match(["get", "post"], "/sendOtp", [SendController::class, "userSendOtp"])->name("users.sendOtp");

	Route::match(["get", "post"], "/verifyOtp", [SendController::class, "verifyOtp"])->name("users.verifyOtp");

	Route::match(["get", "post"], "/passReset", [SendController::class, "passReset"])->name("users.passReset");
});

Route::middleware([userMiddleware::class])->group(function () {
	Route::group(['prefix' => '/users'], function () {
		Route::get("/dashboard", [dashboardController::class, "dashboard"])->name("users.dashboard");

		// custer route code start form here
		Route::get("/customerPage", [customerController::class, "customerPage"])->name("users.customer");
		Route::post("/createCustomer", [customerController::class, "admincreateCustomer"])->name("users.createCustomer");
		Route::get("/getCustomer", [customerController::class, "adminGetCustomer"])->name("users.GetCustomer");
		Route::post("/customerShow", [customerController::class, "adminCustomerShow"])->name("users.CustomerShow");
		Route::post("/customerUPdate", [customerController::class, "adminCustomerUPdate"])->name("users.customerUPdate");
		Route::post("/customerDelete", [customerController::class, "adminCustomerDelete"])->name("users.CustomerDelete");
		// custer route code end form here
		// category route start form here
		Route::get("/categoryPage", [categoryController::class, "categoryPage"])->name("users.categoryPage");
		Route::post("/createCategory", [categoryController::class, "createCategory"])->name("users.createCategory");
		Route::get("/getCategory", [categoryController::class, "getCategory"])->name("users.getCategory");
		Route::post("/categoryShow", [categoryController::class, "adminCategoryShow"])->name("users.categoryShow");
		Route::post("/categoryUpdate", [categoryController::class, "categoryUpdate"])->name("users.categoryUpdate");
		Route::post("/categoryDelete", [categoryController::class, "categoryDelete"])->name("users.categoryDelete");
		// category route start form here

		// brand route start form here
		Route::get("/brandPage", [brandController::class, "brandPage"])->name("users.brandPage");
		Route::post("/createBrand", [brandController::class, "createBrand"])->name("users.createBrand");
		Route::get("/getBrand", [brandController::class, "getBrand"])->name("users.getBrand");
		Route::post("/brandShow", [brandController::class, "brandShow"])->name("users.brandShow");
		Route::post("/brandUpdate", [brandController::class, "brandUpdate"])->name("users.brandUpdate");
		Route::post("/brandDelete", [brandController::class, "brandDelete"])->name("users.brandDelete");
		// brand route end form here
		// product route start form here
		Route::get("/productPage", [productController::class, "productPage"])->name("users.productPage");
		Route::post("/createProduct", [productController::class, "createProduct"])->name("users.createProduct");
		Route::get("/getProduct", [productController::class, "getProduct"])->name("users.getProduct");
		Route::post("/productUpShow", [productController::class, "productUpShow"])->name("users.productUpShow");
		Route::post("/productUpdate", [productController::class, "productUpdate"])->name("users.productUpdate");
		Route::post("/productDelete", [productController::class, "productDelete"])->name("users.productDelete");
		// product route end form here

		// create product sales route start form here
		Route::get("/salesPage", [salesController::class, "salesPage"])->name("users.salesPage");
		Route::get("/salProductShow", [salesController::class, "salProductShow"])->name("users.salProductShow");

		Route::post("/invAddProShow", [salesController::class, "invAddProShow"])->name("users.invAddProShow");

		Route::post("/InvProductAdd", [salesController::class, "InvProductAdd"])->name("users.InvProductAdd");

		Route::post("/productPick", [salesController::class, "productPick"])->name("users.productPick");

		Route::post("/customerPick", [salesController::class, "customerPick"])->name("users.customerPick");

		Route::post("/createSales", [salesController::class, "createSales"])->name("users.createSales");
		// create product sales route end form here
		// invoice page route code start fork here
		Route::get("/invoicePage", [invoiceController::class, "invoicePage"])->name("users.invoicePage");
		Route::get("/InvoiceAll", [invoiceController::class, "InvoiceAll"])->name("users.InvoiceAll");

		Route::post("/InvoiceViewShow", [invoiceController::class, "InvoiceViewShow"])->name("users.InvoiceViewShow");

		Route::post("/invoiceDelete", [invoiceController::class, "invoiceDelete"])->name("users.invoiceDelete");
		// invoice page route code end fork here
		// report page route code start form here
		Route::get("/reportPage", [reportController::class, "reportPage"])->name("users.reportPage");
		Route::post("/reportGena", [reportController::class, "reportGena"])->name("users.reportGena");
		// report page route code end form here
		// profile route code start form here
		Route::get("/profilePage", [profileController::class, "profilePage"])->name("users.profilePage");
		Route::post("/profileShow", [profileController::class, "profileShow"])->name("users.profileShow");
		Route::post("/profileUpdate", [profileController::class, "profileUpdate"])->name("users.profileUpdate");
		Route::get("/logout", [profileController::class, "logout"])->name("users.logout");
		// profile route code end form here
	});
});
