@extends("users.layout.app")
@section("title","User | Brand")
@section("content")
<div class="brandContentDiv">
	<div class="card">
		<div class="card-body">
			<div class="createBrandRow d-flex">
				<h4>Create Brand</h4>
				<button id="createBrandBtn" class="btn create float-left">Create</button>
			</div>
			<hr>
			<div class="BrandTdTopDiv">
				<table id="brandTable" class="table table-bordered table-hover table-striped text-center d-none">
					<thead class="thead">
						<tr>
							<th>Sr</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="brandTbody">

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

{{-- create brand modal show --}}
<div class="modal fade" id="CreateBrandModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create Brand</h4>
			</div>
			<form id="createBrandForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<div class="col-10">
							<label>Brand Name:</label>
							<input type="text" name="brandName" class="form-control brandName" placeholder="Plase Brand Name">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn creBraFormBtn successBtn btn-primary">Create</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- brand update modal show --}}
<div class="modal fade" id="brandUpModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Brand Update</h4>
			</div>
			<form id="brandFormid">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="brandUpid" class="brandUpid">
						<div class="col-10">
							<label>Brand Name:</label>
							<input type="text" name="brandUpName" class="form-control brandUpName">
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
					<button type="submit" class="btn btn-outline-success successBtn braUpBtn">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section("script")
<script type="text/javascript" >
	createBrandForm();
	getBrand();
	brandUpdate();

	var creBrandMds = document.querySelector("#CreateBrandModal");
	var creBrandModal = new mdb.Modal(creBrandMds);

	var creBrandBtn = document.querySelector("#createBrandBtn");
	creBrandBtn.addEventListener("click",function(){
		creBrandModal.show();
	});

	function createBrandForm(){
		var brandName = document.querySelector(".brandName");
		var creBraFormBtn = document.querySelector(".creBraFormBtn");
		var creBrandForm = document.querySelector("#createBrandForm");

		creBrandForm.addEventListener("submit",function(e){
			e.preventDefault();
			if (brandName.value !== "") {
				creBraFormBtn.innerHTML = loader;
				creBraFormBtn.style.width = '100px';

				var url = "{{ route('users.createBrand') }}";
				var data = new FormData(creBrandForm);
				axios.post(url,data)
				.then(function(response){
					if (response.status == 200) {
						getBrand()
						creBrandModal.hide();
						brandName.value = "";
						Swal.fire("Success","Brand Create Successfully","success");
						creBraFormBtn.innerHTML = "Create";
					}else{
						getBrand()
						creBrandModal.hide();
						brandName.value = "";
						Swal.fire("Sorry","Brand Create Faild","error");
						creBraFormBtn.innerHTML = "Create";
					}
				})
				.catch(function(error){
					getBrand()
					creBrandModal.hide();
					brandName.value = "";
					Swal.fire("Sorry","Brand Create Faild","error");
					creBraFormBtn.innerHTML = "Create";
				})

			}else{
				toastr.error("Please Brand Name!")
			}

		})
	}
	var brandUpModal = document.querySelector("#brandUpModal");
	var brandUpMd = new mdb.Modal(brandUpModal);

	function getBrand(){
		var url = "{{ route('users.getBrand') }}";
		axios.get(url)
		.then(function(response){
			if (response.status == 200) {
				var brandTable = document.querySelector("#brandTable");
				var brandTbody = document.querySelector(".brandTbody");
				addClass(".loaderDiv","d-none");
				removeClass("#brandTable","d-none");

				$("#brandTable").DataTable().destroy();
				brandTbody.innerHTML = "";

				var getBrandJson = response.data;
				getBrandJson.forEach(function(item,i){
					var id = "<td>"+i+"</td>";
					var name = "<td>"+item.name+"</td>";
					var action = "<td class='actionTd'><button data-edit="+item.id+" class='btn btn-outline-success editBtn'>Edit</button> <button data-delete="+item.id+" class='btn btn-outline-danger deleteBtn'>Delete</button></td>"
					var createTr = document.createElement("tr");
					createTr.innerHTML = id+name+action;
					brandTbody.appendChild(createTr)
				});

				var editBtn = document.querySelectorAll(".editBtn");
				editBtn.forEach(function(item){
					item.addEventListener("click",function(){
						var braShowid = item.getAttribute("data-edit");
						brandShowData(braShowid)
						brandUpMd.show();
					})

				});

				var deleteBtn = document.querySelectorAll(".deleteBtn");
				deleteBtn.forEach(function(item){
					item.addEventListener("click",function(){
						var deleteId = item.getAttribute("data-delete");
						brandDelete(deleteId);
					})
				})

				$("#brandTable").DataTable({
					order:[0,"desc"],
					pageLength : 5,
					lengthMenu:[5,10,20,50,100]
				});


			}else{
				addClass(".loaderDiv","d-none");
				removeClass(".noDataFoundDiv","d-none");
			}

		})
		.catch(function(){
			addClass(".loaderDiv","d-none");
			removeClass(".noDataFoundDiv","d-none");
		})

	}

	function brandShowData(braShowid){
		var url = "{{ route('users.brandShow') }}";
		var data = {braShowid:braShowid}
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				addClass(".UploaderDiv","d-none");
				var braShowJson = response.data;
				element(".brandUpid",braShowJson.id)
				element(".brandUpName",braShowJson.name)

			}else{
				addClass(".UploaderDiv","d-none");
				removeClass(".UpNotfoundDiv","d-none");
			}

		})
		.catch(function(error){
			addClass(".UploaderDiv","d-none");
			removeClass(".UpNotfoundDiv","d-none");
		})
	}

	function brandUpdate(){
		var braUpBtn = document.querySelector(".braUpBtn");
		var brandFormid = document.querySelector("#brandFormid");
		brandFormid.addEventListener("submit",function(e){
			e.preventDefault();

			braUpBtn.innerHTML = loader;
			braUpBtn.style.width = '100px';

			var url = "{{ route('users.brandUpdate') }}";
			var data = new FormData(brandFormid);
			axios.post(url,data)
			.then(function(response){
				if (response.status == 200) {
					getBrand();
					brandUpMd.hide();
					Swal.fire("Updated","Brand Updated Successfully","success")
					braUpBtn.innerHTML = "Update";
				}else{
					getBrand();
					brandUpMd.hide();
					Swal.fire("Updated","Brand Updated Faild","error")
					braUpBtn.innerHTML = "Update";
				}
			})
			.catch(function(error){
				getBrand();
				brandUpMd.hide();
				Swal.fire("Updated","Brand Updated Faild","error")
				braUpBtn.innerHTML = "Update";
			})
		})
	}

	function brandDelete(deleteId){
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't to Data Delete!",
		  icon: 'warning',
		  confirmButtonText: 'Deleted',
		  showCancelButton: true,
		  cancelButtonColor: '#d33'

		}).then((result) => {
		  if (result.isConfirmed) {
		   var url = "{{ route('users.brandDelete') }}";
		   var data = {deleteId:deleteId}
		   axios.post(url,data)
		   .then(function(response){
		   	if (response.status == 200) {
		   	   getBrand();
		   	   Swal.fire('Deleted!','Brand Data has been deleted.','success')
		   	}else{
		   		getCustomerData();
		   		Swal.fire("Sorry","Brand Data Deleted Faild","error");
		   	}

		   })
		   .catch(function(error){
		 	  getCustomerData();
		   	  Swal.fire("Sorry","Brand Data Deleted Faild","error");
		   })
		  }
		})
	}


</script>
@endsection