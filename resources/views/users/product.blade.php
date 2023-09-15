@extends("users.layout.app")
@section("title","User | Product")
@section("content")
<div class="productContentDiv">
	<div class="card">
		<div class="card-body">
			<div class="productRowDiv d-flex">
				<h4>Create Product</h4>
				<button id="createProBtn" class="btn create float-left">Create</button>
			</div>
			<hr>
			<div class="productToptbDiv">
				<table id="productTable" class="table text-center table-bordered table-hover table-striped d-none">
					<thead class="thead">
						<tr>
							<td>Sr</td>
							<th>Photo</th>
							<th>Name</th>
							<th>Rate</th>
							<th>Quantity</th>
							<th>Brand</th>
							<th>Category</th>
							<th>status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="productTbody">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="loaderDiv">
	<img src="{{ asset("img/loader.gif") }}" alt="">
</div>
<div class="noDataFoundDiv d-none">
    <img src="{{ asset("img/no data.png") }}" alt="">
</div>


{{-- create product modal show --}}
<div class="modal fade" id="createProductModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create Product</h4>
				<img class="creProPreImg" src="{{ asset("img/image-gallery.jpg") }}"alt="" style="width:60px;height:60px">
			</div>
			<form id="creProdForm" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<div class="form-row">
						<div class="col-5">
							<label>Image:</label>
							<input type="file" accept="image/*" name="productImg" class="form-control productImg">
						</div>
						<div class="col-5">
							<label>Product Name:</label>
							<input type="text" name="productName" class="form-control productName" placeholder="Please Product Name">
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Rate:</label>
							<input type="number" name="productRate" class="form-control productRate" placeholder="Product Rate">
						</div>
						<div class="col-5">
							<label>Quantity:</label>
							<input type="number" name="productQuantity" class="form-control productQuantity" placeholder="Please Product Quantity">
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Brand:</label>
							<select name="productBrand" class="form-select productBrand">
								<option value="">--Select Brand--</option>
								@foreach($brand as $brand)
								<option value="{{ $brand->name }}">{{ $brand->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-5">
							<label>Category:</label>
							<select name="productCategory" class="form-select productCategory">
							  <option value="">--Select Category--</option>
							  @foreach($category as $category)
							  <option value="{{ $category->name }}">{{ $category->name }}</option>
							  @endforeach
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Status:</label>
							<select name="productStatus" class="form-select productStatus">
								<option value="">--Select Status--</option>
								<option value="1">Available</option>
								<option value="0">Not Available</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn successBtn creProFormBtn btn-outline-primary">Create</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- product update modal show --}}
<div class="modal fade" id="ProUpModalId">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Product Update</h4>
				<img src="" id="productUpImg" alt="" style="width: 60px;height: 60px;">
			</div>
			<form id="productUpForn" enctype="multipart/form-data">
				@csrf;
				<div class="modal-body">
					<div class="form-row">
						<input type="hidden" name="ProUpImgPath" class="ProUpImgPath">
						<input type="hidden" name="ProUpId" class="ProUpId">
						<div class="col-5">
							<label>Product Photo:</label>
							<input type="file" accept="image/*" name="proUpImg" class="form-control proUpImg">
						</div>
						<div class="col-5">
							<label>Product Name:</label>
							<input type="text" name="proUpName" class="form-control proUpName">
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Rate:</label>
							<input type="number" name="proUpRate" class="form-control proUpRate">
						</div>
						<div class="col-5">
							<label>Quantity:</label>
							<input type="number" name="proUpQuantity" class="form-control proUpQuantity">
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Brand:</label>
							<select name="ProductUpBrand" class="form-select" id="ProductUpBrand">
								@foreach($brandUp as $key => $brandUp)
								<option value="{{ $brandUp->name }}">{{ $brandUp->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-5">
							<label>Category:</label>
							<select name="ProductUpCate" class="form-select" id="ProductUpCate">
								@foreach($cateUp as $cateUp)
							  		<option value="{{ $cateUp->name}}">{{ $cateUp->name}}</option>
							  @endforeach
							</select>
						</div>
					</div>
					<div class="form-row">
						<div class="col-5">
							<label>Status:</label>
							<select name="ProductUpStatus" class="form-control" id="ProductUpStatus">
								<option value="1">Available</option>
								<option value="0">Not Available</option>
							</select>
						</div>
					</div>
				</div>
				<div class="UploaderDiv">
					<img src="{{ asset("img/loader.gif") }}" alt="">
				</div>
				<div class="UpNotfoundDiv d-none">
				    <img src="{{ asset("img/no data.png") }}" alt="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn btn-outline-success successBtn ProUpbtn">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section("script")
<script type="text/javascript">
	CreateProduct();
	getProduct();
	ProductUpdate();

	var creProductModals = document.querySelector("#createProductModal");
	var creProModal = new mdb.Modal(creProductModals);

	var createProBtn = document.querySelector("#createProBtn");
	createProBtn.addEventListener("click",function(){
		creProModal.show();
	});

	function CreateProduct(){
		var creProFormBtn = document.querySelector(".creProFormBtn");
		var creProdForm = document.querySelector("#creProdForm");
		var photo = document.querySelector(".productImg");
		var name = document.querySelector(".productName");
		var rate = document.querySelector(".productRate");
		var quantity = document.querySelector(".productQuantity");
		var brand = document.querySelector(".productBrand");
		var category = document.querySelector(".productCategory");
		var status = document.querySelector(".productStatus");

		creProdForm.addEventListener("submit",function(e){
			e.preventDefault();

			if (photo.files.length == 0) {
				toastr.error("please Product Image");
			}else if(!(photo.files[0].type.match("image.*"))){
				toastr.error("please Image Select");
			}else if(name.value == ""){
				toastr.error("please Product Name");
			}else if(rate.value == ""){
				toastr.error("please Product Rate");
			}else if(quantity.value == ""){
				toastr.error("please Product Quantity");
			}else if(brand.value == ""){
				toastr.error("please Product Brand");
			}else if(category.value == ""){
				toastr.error("please Product Category");
			}else if(status.value == ""){
				toastr.error("please Product Status");
			}else{
				creProFormBtn.innerHTML = loader;
				creProFormBtn.style.width = '100px';

				var url = "{{ route('users.createProduct') }}";
				var data = new FormData(creProdForm);
				axios.post(url,data)
				.then(function(response){
					if (response.status == 200) {
						getProduct()
						creProdForm.reset();
						creProModal.hide();
						Swal.fire("Success","Product Create Success","success");
						creProFormBtn.innerHTML = "Create";
					}else{
						getProduct()
						creProdForm.reset();
						creProModal.hide();
						Swal.fire("Sorry","Product Create Faild","error");
						creProFormBtn.innerHTML = "Create";
					}

				})
				.catch(function(error){
					getProduct()
					creProdForm.reset();
					creProModal.hide();
					Swal.fire("Sorry","Product Create Faild","error");
					creProFormBtn.innerHTML = "Create";
				})
			}

		})
	}

	var ProUpModalId = document.querySelector("#ProUpModalId");
	var ProUpModal = new mdb.Modal(ProUpModalId);

	function getProduct(){
		var ProductTbody = document.querySelector(".productTbody");

		var url = "{{ route('users.getProduct') }}";
		axios.get(url)
		.then(function(response){
			if (response.status == 200) {

				addClass(".loaderDiv","d-none");
				removeClass("#productTable","d-none");
				$("#productTable").DataTable().destroy();
				ProductTbody.innerHTML = "";
				var productJson = response.data;
				var i = 1;
				productJson.forEach(function(item){
					var id = "<td>"+ i++ +"</td>";
					var img = "<td class='productTdImg'><img src="+item.photo+"></td>";
					var name = "<td>"+item.name+"</td>";
					var rate = "<td>"+item.rate+"</td>";
					var quantity = "<td>"+item.quantity+"</td>";
					var brand = "<td>"+item.brand+"</td>";
					var category = "<td>"+item.category+"</td>";
					if (item.status == 1) {
						var status = "<td><p class='active'>Available</p></td>";
					}else{
						var status = "<td><p class='deactive'>Not Available</p></td>";
					}
					var action = " <td class='actionTd'><button data-edit="+item.id+" class='btn btn-outline-success proEditBtn editBtn'>Edit</button> <button data-delete="+item.id+" class='btn btn-outline-danger proDeletBtn deleteBtn'>Delete</button></td>";
					var createTr = document.createElement("tr");
					createTr.innerHTML = id+img+name+rate+quantity+brand+category+status+action;
					ProductTbody.appendChild(createTr)
				});

			var proEditBtn = document.querySelectorAll(".proEditBtn");
			proEditBtn.forEach(function(item,i){
				item.addEventListener("click",function(){
					var showId = item.getAttribute("data-edit");
					ProUpModal.show();
					productUpShow(showId)
				});
			});
			var proDeletBtn = document.querySelectorAll(".proDeletBtn");
			proDeletBtn.forEach(function(item){
				item.addEventListener("click",function(){
					var proDelId = item.getAttribute("data-delete");
					ProductDelete(proDelId)
				})
			})


			$("#productTable").DataTable({
				order : [0,"desc"],
				pageLength : 5,
				lengthMenu : [5,10,20,50,100]
			});
			}else{
				addClass(".loaderDiv","d-none");
				removeClass(".noDataFoundDiv","d-none");
			}

		})
		.catch(function(error){
			addClass(".loaderDiv","d-none");
			removeClass(".noDataFoundDiv","d-none");
		})
	}

	function productUpShow(showId){
		var productUpImg = document.querySelector("#productUpImg");
		var url = "{{ route('users.productUpShow') }}";
		var data = {showId:showId}
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				var ProShowJson = response.data;
				addClass(".UploaderDiv","d-none");

				productUpImg.setAttribute("src",ProShowJson.photo);
				element(".ProUpImgPath",ProShowJson.photo)
				element(".ProUpId",ProShowJson.id)
				element(".proUpName",ProShowJson.name)
				element(".proUpRate",ProShowJson.rate)
				element(".proUpQuantity",ProShowJson.quantity)
				element("#ProductUpBrand",ProShowJson.brand)
				element("#ProductUpCate",ProShowJson.category)
				element("#ProductUpStatus",ProShowJson.status)

			}else{
				addClass(".UploaderDiv","d-none");
				removeClass(".UpNotfoundDiv",'d-none')
			}

		})
		.catch(function(error){
			addClass(".UploaderDiv","d-none");
			removeClass(".UpNotfoundDiv",'d-none')
		})
	}
	function ProductUpdate(){
		var ProUpbtn = document.querySelector(".ProUpbtn");
		var productUpForn = document.querySelector("#productUpForn");
		productUpForn.addEventListener("submit",function(e){
			e.preventDefault();

			ProUpbtn.innerHTML = loader;
			ProUpbtn.style.width = '100px';

			var url = "{{ route('users.productUpdate') }}";
			var data = new FormData(productUpForn)
			axios.post(url,data)
			.then(function(response){
				if (response.status == 200) {
					getProduct();
					ProUpModal.hide();
					Swal.fire("Updated","Data Updated Successfully","success");
					ProUpbtn.innerHTML = "Update";
				}else{
					getProduct();
					ProUpModal.hide();
					Swal.fire("Sorry","Data Updated Successfully","error");
					ProUpbtn.innerHTML = "Update";
				}
			})
			.catch(function(error){
				getProduct();
				ProUpModal.hide();
				Swal.fire("Sorry","Data Updated Successfully","error");
				ProUpbtn.innerHTML = "Update";
			})
		})

	}

	function ProductDelete(proDelId){
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't to Data Delete!",
		  icon: 'warning',
		  confirmButtonText: 'Deleted',
		  showCancelButton: true,
		  cancelButtonColor: '#d33'

		}).then((result) => {
		  if (result.isConfirmed) {
		   var url = "{{ route('users.productDelete') }}";
		   var data = {proDelId:proDelId}
		   axios.post(url,data)
		   .then(function(response){
		   	if (response.status == 200) {
		   	   getProduct();
		   	   Swal.fire('Deleted!','Product Data has been deleted.',
			      'success')
		   	}else{
		   		getProduct();
		   		Swal.fire("Sorry","Product Data Deleted Faild","error");
		   	}

		   })
		   .catch(function(error){
		 	  getProduct();
	   		  Swal.fire("Sorry","Product Data Deleted Faild","error");
		   })
		  }
		})
	}

	var fileImg = document.querySelector(".productImg");
	fileImg.addEventListener("change",function(e){
	    var creProPreImg = document.querySelector(".creProPreImg");
	    creProPreImg.src = URL.createObjectURL(e.target.files[0]);
	});

	var proUpImgPre = document.querySelector(".proUpImg");
	proUpImgPre.addEventListener("change",function(e){
	   var productUpImg = document.querySelector("#productUpImg");
	   productUpImg.src = URL.createObjectURL(e.target.files[0])
	})
</script>
@endsection