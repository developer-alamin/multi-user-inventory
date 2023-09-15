@extends("users.layout.app")
@section("title","Users | Category")
@section("content")
<div class="categoryContentDiv">
	<div class="card">
		<div class="card-body">
			<div class="createCategoryRow d-flex">
				<h4>Create Category</h4>
				<button id="createCategoryBtn" class="btn create float-left">Create</button>
			</div>
			<hr>
			<div class="categoryDiv">
				<table id="categoryTable" class="table d-none table-bordered table-hover table-striped text-center">
					<thead class="thead">
						<tr>
							<th>Sr</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="categoryTbody">

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

{{-- create category modal  --}}
<div class="modal fade" id="createCategoryModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Create Category</h4>
			</div>
			<form id="creatCategoryForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<div class="col-10">
							<label>Category Name:</label>
							<input type="text" name="categoryName" class="categoryName form-control" placeholder="Pleae Category Name">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn creCatBtn successBtn btn-primary">Create</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- cateory update modal --}}
<div class="modal fade" id="categoryUpModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Catrgory Update</h4>
			</div>
			<form id="categoryUpForm">
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="catUpId" class="catUpId">
						<div class="col-10">
							<label>Category Name:</label>
							<input type="text" name="catUpName" class="form-control catUpName">
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
					<button type="submit" class="btn btn-outline-success successBtn catUpBtn">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section("script")
<script type="text/javascript">
	createCategory();
	getCategory();
	categoryUpdate();


	var creCateModals = document.querySelector("#createCategoryModal");
	var creCateModal = new mdb.Modal(creCateModals);

	 var creCateBtn = document.querySelector("#createCategoryBtn");
	  creCateBtn.addEventListener("click",function(e){
	  	e.preventDefault();
	  	creCateModal.show();
	 });

	function createCategory(){
		var creCateForm = document.querySelector("#creatCategoryForm");
		var creCateName = document.querySelector(".categoryName");
		var creCatebtn = document.querySelector(".creCatBtn");

		creCateForm.addEventListener("submit",function(e){
			e.preventDefault();
			if (creCateName.value !== "") {
				creCatebtn.innerHTML = loader;
				creCatebtn.style.width = "100px";


				var url = "{{ route('users.createCategory') }}";
				var data = new FormData(creCateForm);
				axios.post(url,data)
				.then(function(response){
					if (response.status == 200) {
						getCategory()
						creCateName.value = "";
						creCateModal.hide();
						Swal.fire('Success!','Category Create SuccessFully','success');
						creCatebtn.innerHTML = "Create";
					}else{
						getCategory()
						creCateName.value = "";
						creCateModal.hide();
						Swal.fire('Sorry!','Category Create Faild',
						  'error');
						creCatebtn.innerHTML = "Create";
					}

				})
				.catch(function(error){
					getCategory()
					creCateName.value = "";
					creCateModal.hide();
					Swal.fire('Sorry!','Category Create Faild',
					  'error');
					creCatebtn.innerHTML = "Create";
				})
			}else{
				toastr.error('Please Category Name');
			}


		});
	}
	var categoryUpModal = document.querySelector("#categoryUpModal");
	var cateUpModal = new mdb.Modal(categoryUpModal);

	function getCategory(){
		var categoryTable = document.querySelector("#categoryTable");
		var cateTbody = document.querySelector(".categoryTbody");
		var url = "{{ route('users.getCategory') }}";

		axios.get(url)
		.then(function(response){
			if (response.status == 200) {
				addClass(".loaderDiv","d-none")
				removeClass("#categoryTable","d-none");
				$("#categoryTable").DataTable().destroy()
				cateTbody.innerHTML = "";
				var categoryJson = response.data
				categoryJson.forEach(function(item,i){
					var id = "<td>"+item.id+"</td>";
					var name = "<td>"+item.name+"</td>";
					var action = "<td class='actionTd'><button data-edit="+item.id+" class='btn catEditBtn editBtn'>Edit</button> <button data-delete="+item.id+" class='btn cateDelete deleteBtn'>Delete</button></td>";
					var createTr = document.createElement("tr");
					createTr.innerHTML = id+name+action;
					cateTbody.appendChild(createTr)

				});

				var catEditBtn = document.querySelectorAll(".catEditBtn");
				catEditBtn.forEach(function(item){
					item.addEventListener("click",function(){
						var catShowid = item.getAttribute("data-edit");
						cateUpModal.show();
						catgoryShow(catShowid)
					});
				});

				var cateDelete = document.querySelectorAll(".cateDelete");
				cateDelete.forEach(function(item){
					item.addEventListener("click",function(){
						var catDeleteid = item.getAttribute("data-delete");
						categoryDelete(catDeleteid)
					});
				});

			$("#categoryTable").DataTable({
			  order : [0,'desc'],
	          pageLength : 5,
	          lengthMenu: [5, 10, 20,50,100]
			});

			}else{
				addClass(".loaderDiv","d-none")
				removeClass(".noDataFoundDiv","d-none");
			}

		})
		.catch(function(error){
			addClass(".loaderDiv","d-none")
			removeClass(".noDataFoundDiv","d-none")
		})
	}

	function catgoryShow(catShowid){
		var url = "{{ route('users.categoryShow') }}";
		var data = {catShowid:catShowid}
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				var catUpJson = response.data;
				addClass(".UploaderDiv","d-none");
				element(".catUpId",catUpJson.id)
				element(".catUpName",catUpJson.name)

			}else{
				addClass(".UploaderDiv","d-none")
				removeClass(".noDataFoundDiv","d-none")
			}

		})
		.catch(function(error){
			addClass(".UploaderDiv","d-none")
			removeClass(".noDataFoundDiv","d-none")
		})
	}

	function categoryUpdate(){
		var catUpForm = document.querySelector("#categoryUpForm");
		var catUpBtn = document.querySelector(".catUpBtn");

		catUpForm.addEventListener("submit",function(e){
			e.preventDefault();
			catUpBtn.innerHTML = loader;
			catUpBtn.style.width = '100px';

			var url = "{{ route('users.categoryUpdate') }}";
			var data = new FormData(catUpForm);
			axios.post(url,data)
			.then(function(response){
				if (response.status == 200) {
					getCategory();
					cateUpModal.hide();
					Swal.fire("Updated!","Category Updated","success");
					catUpBtn.innerHTML = "Create";
				}else{
					getCategory();
					cateUpModal.hide();
					Swal.fire("Sorry!","Category Updated Faild","error");
					catUpBtn.innerHTML = "Create";
				}

			})
			.catch(function(){
				getCategory();
				cateUpModal.hide();
				Swal.fire("Sorry!","Category Updated Faild","error");
				catUpBtn.innerHTML = "Create";
			})
		})
	}

	function categoryDelete(catDeleteid){
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't to Data Delete!",
		  icon: 'warning',
		  confirmButtonText: 'Deleted',
		  showCancelButton: true,
		  cancelButtonColor: '#d33'

		}).then((result) => {
		  if (result.isConfirmed) {
		   var url = "{{ route('users.categoryDelete') }}";
		   var data = {catDeleteid:catDeleteid}
		   axios.post(url,data)
		   .then(function(response){
		   	if (response.status == 200) {
		   	  getCategory()
		   	   Swal.fire(
			      'Deleted!',
			      'Category Data has been deleted.',
			      'success'
			    )
		   	}else{
		   		getCategory()
		   		Swal.fire({
				  icon: "error",
				  text: "Category Data Deleted Faild"
				});
		   	}

		   })
		   .catch(function(error){
		 	 getCategory()
	   			Swal.fire({
				  icon: "error",
				  text: "Category Data Deleted Faild"
			   });
		   })
		  }
		})
	}
</script>
@endsection