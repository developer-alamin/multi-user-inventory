<?php

namespace App\Http\Controllers\usersController;

use App\helper\helper;
use App\Http\Controllers\Controller;
use App\Models\Users\brand;
use App\Models\Users\category;
use App\Models\Users\product;
use App\Models\Users\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class productController extends Controller {
	function productPage() {
		$userId = new helper();
		if ($userId::UserId()) {
			$userData = user::findOrFail($userId::UserId());
			$brand = brand::where("usersId", $userId::UserId())->get();
			$brandUp = brand::where("usersId", $userId::UserId())->get();
			$category = category::where("usersId", $userId::UserId())->get();
			$cateUp = category::where("usersId", $userId::UserId())->get();
			return view("users.product", compact("brand", "category", "brandUp", "cateUp", "userData"));
		}
	}
	function createProduct(Request $request) {
		$userId = new helper();
		$file = $request->file("productImg");
		$proName = $request->productName;
		$nameResize = str_replace(' ', '', $proName);

		$http = "http://" . $_SERVER['HTTP_HOST'] . "/";
		$randomPath = "product/" . time() . "/" . date("m") . "/";
		$imgExten = $file->getClientOriginalExtension();
		$serverUpload = $http . $randomPath . $nameResize . "." . $imgExten;

		$file->move(public_path($randomPath), $nameResize . "." . $imgExten);

		$product = new product();
		$product->name = $request->productName;
		$product->rate = $request->productRate;
		$product->quantity = $request->productQuantity;
		$product->brand = $request->productBrand;
		$product->category = $request->productCategory;
		$product->status = $request->productStatus;
		$product->usersId = $userId::UserId();
		$product->photo = $serverUpload;
		return $product->save();
	}

	function getProduct() {
		$userId = new helper();
		$getProduct = product::where("usersId", $userId::UserId())->get();
		return $getProduct;
	}
	function productUpShow(Request $request) {
		$proShowId = $request->showId;
		$productShowData = product::findOrFail($proShowId);
		return $productShowData;
	}

	function productUpdate(Request $request) {

		if ($request->hasFile("proUpImg")) {
			$upFile = $request->file("proUpImg");

			$proUpName = $request->productName;
			$nameResize = str_replace(' ', '', $proUpName);

			$http = "http://" . $_SERVER['HTTP_HOST'] . "/";
			$UpranPath = "product/" . time() . "/" . date("m") . "/";
			$UpimgEx = $upFile->getClientOriginalExtension();
			$UpserverLoad = $http . $UpranPath . $nameResize . "." . $UpimgEx;

			$upFile->move(public_path($UpranPath), $nameResize . "." . $UpimgEx);

			$productPreImg = $request->ProUpImgPath;
			$explodeImg = explode("/", $productPreImg);
			$sendImg = end($explodeImg);
			$FirstEndPreImg = prev($explodeImg);
			$secondEndPreImg = prev($explodeImg);
			$publicPath = public_path("product/" . $secondEndPreImg);
			if (File::exists($publicPath)) {
				File::deleteDirectory($publicPath);
			}
		} else {
			$UpserverLoad = $request->ProUpImgPath;
		}

		$productUpData = product::findOrFail($request->ProUpId);
		$productUpData->name = $request->proUpName;
		$productUpData->rate = $request->proUpRate;
		$productUpData->quantity = $request->proUpQuantity;
		$productUpData->brand = $request->ProductUpBrand;
		$productUpData->category = $request->ProductUpCate;
		$productUpData->status = $request->ProductUpStatus;
		$productUpData->photo = $UpserverLoad;
		return $productUpData->update();
	}
	function productDelete(Request $request) {
		$proDleteId = $request->proDelId;
		$productDelete = product::findOrFail($proDleteId);
		$deleteImgPath = $productDelete->photo;

		$explodeImg = explode("/", $deleteImgPath);
		$deleteEndImg = end($explodeImg);
		$deleteEndPreImg = prev($explodeImg);
		$SecondDelEndPreImg = prev($explodeImg);

		$deletePath = public_path("product/" . $SecondDelEndPreImg);
		if (File::exists($deletePath)) {
			File::deleteDirectory($deletePath);
			return product::destroy($proDleteId);
		}
	}
}
