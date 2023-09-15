@extends("users.layout.app")
@section("title","Admin | Customer")
@section("content")
<div class="customerContentDiv">
	<div class="card">
		<div class="card-body">
			<div class="customerRow">
				<h4>Customer</h4>
				<button id="createCustomerBtn" class="btn create float-left">Create</button>
			</div>
			<hr class="jumbotron-hr">
			<div class="customerTbDiv">
				<table id="customerTable" class="table d-none table-bordered table-hover table-striped ">
					<thead class="thead">
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="customerTbody">

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

{{-- customer add modal start form here --}}
<div class="modal fade" id="customerAddModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Customer</h4>
			</div>
			<form id="CreatecustomForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<div class="col-10">
							<label>Name:</label>
							<input type="text" name="customerName" placeholder="Customer Name" class="form-control customerName">
						</div>
						<div class="col-10">
							<label>Email:</label>
							<input type="email" name="customerEmail" placeholder="Customer Email" class="form-control customerEmail">
						</div>
						<div class="col-10">
							<label>Phone:</label>
							<input type="number" name="customerPhone" placeholder="Customer Phone" class="form-control customerPhone">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn successBtn createCustomerBtn btn-outline-primary">Create</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- customer add modal end form here --}}

{{-- customer update modal start form here --}}
<div class="modal fade" id="customerUpModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Customer Update</h4>
			</div>
			<form id="customerUpForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="customerUpId" class="customerUpId">
						<div class="col-10">
							<label>Name:</label>
							<input type="text" name="custoUpName" class="form-control custoUpName">
						</div>
						<div class="col-10">
							<label>Email:</label>
							<input type="email" name="custoUpEmail" class="form-control custoUpEmail">
						</div>
						<div class="col-10">
							<label>Phone:</label>
							<input type="text" name="custoUpPhone" class="form-control custoUpPhone">
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
					<button type="submit" class="btn btn-outline-success successBtn customUpBtn">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- customer update modal end form here --}}



@endsection
@section("script")
<script type="text/javascript">
	createCusForm();
	getCustomerData();
	customerUpdate()

	var CreateCusModal = document.querySelector("#customerAddModal");
	var modal = new mdb.Modal(CreateCusModal);

	var createCustomerBtn = document.querySelector("#createCustomerBtn");
	createCustomerBtn.addEventListener("click",function(){
		modal.show();
	});

	function createCusForm(){
		var formID = document.querySelector("#CreatecustomForm");


		formID.addEventListener("submit",function(e){
			e.preventDefault();
			var CusName = document.querySelector(".customerName");
		var CusEmail = document.querySelector(".customerEmail");
		var CusPhone = document.querySelector(".customerPhone");
		var cusBtn = document.querySelector(".createCustomerBtn");

			if (CusName.value == "") {
				toastr.error('Please Customer Name');
			}else if(CusEmail.value == ""){
				toastr.error('Please Customer Email');
			}else if(CusPhone.value == ""){
				toastr.error('Please Customer Phone');
			}else{
				cusBtn.innerHTML = loader;
				cusBtn.style.width = '100px';

				var url = "{{ route('users.createCustomer') }}";
				var Data = new FormData(formID);

				axios.post(url,Data)
				.then(function (response) {
					if (response.status == 200) {
						getCustomerData()
						modal.hide();
						Swal.fire("Success","Customer Create Successfully","success")
						cusBtn.innerHTML = 'Create';
						formID.reset();
					}else{
						getCustomerData()
						modal.hide();
						Swal.fire("Sorry","Customer Add Faild","eror");
						cusBtn.innerHTML = 'Create';
						formID.reset();
					}
				 })
				 .catch(function (error) {
				 	getCustomerData()
				 	modal.hide();
				   Swal.fire("Sorry","Customer Add Faild","eror");
				   cusBtn.innerHTML = 'Create';
				   formID.reset();
				 });
			}
		})
	}

	var customerUpmodal = document.querySelector("#customerUpModal")
	var custoUpModal = new mdb.Modal(customerUpmodal);


	function getCustomerData() {
		var loaderDiv = document.querySelector(".loaderDiv");
		var customerTbody = document.querySelector(".customerTbody");

		var url = "{{ route('users.GetCustomer') }}";
		axios.get(url)
		.then(function(response){
		if (response.status == 200) {
			addClass(".loaderDiv","d-none");
			removeClass("#customerTable","d-none");


			$('#customerTable').DataTable().destroy();
			customerTbody.innerHTML = "";
			var customerJsonData = response.data;
			customerJsonData.forEach(function(item,i){
				var id = "<td>"+item.id+"</td>";
				var name = "<td>"+item.name+"</td>";
				var email = "<td>"+item.email+"</td>";
				var phone = "<td>"+item.phone+"</td>";
				var action = "<td class='actionTd'><button data-edit="+item.id+" class='btn editBtn'>Edit</button> <button data-delete="+item.id+" class='btn deleteBtn'>Delete</button></td>";
				var createTr = document.createElement("tr");
				createTr.innerHTML = id+name+email+phone+action;
				customerTbody.appendChild(createTr);
			});

			var editBtn = document.querySelectorAll(".editBtn");
			editBtn.forEach(function(item,i){
				item.addEventListener("click",function(){
				  var ShowId = item.getAttribute("data-edit");
				  custoUpModal.show();
				  customerShow(ShowId)
				})
			});

			var deleteBtn = document.querySelectorAll(".deleteBtn");
			deleteBtn.forEach(function(item,i){
				item.addEventListener("click",function(){
					var deleteId = item.getAttribute("data-delete");
					customerDelete(deleteId)
				})

			})


			$("#customerTable").DataTable({
	          order : [0,'desc'],
	          pageLength : 5,
	          lengthMenu: [5, 10, 20,50,100]
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

	function customerShow(ShowId){
		var url = "{{ route('users.CustomerShow') }}";
		var data = {ShowId:ShowId}
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				addClass(".UploaderDiv","d-none")
				var custShowData = response.data;

				element(".customerUpId",custShowData.id);
				element(".custoUpName",custShowData.name);
				element(".custoUpEmail",custShowData.email);
				element(".custoUpPhone",custShowData.phone);

			}else{
				addClass(".UploaderDiv","d-none");
				removeClass(".UpNotfoundDiv","d-none")
			}
		})
		.catch(function(error){
			addClass(".UploaderDiv","d-none");
			removeClass(".UpNotfoundDiv","d-none")
		})
	}

	function customerUpdate(){
		var cusUpForm = document.querySelector("#customerUpForm");
		var customUpBtn = document.querySelector(".customUpBtn");

		cusUpForm.addEventListener("submit",function(e){
			e.preventDefault();

			customUpBtn.innerHTML = loader;
			customUpBtn.style.width = "100px";

			var url = "{{ route('users.customerUPdate') }}";
			var data = new FormData(cusUpForm)

			axios.post(url,data)
			.then(function(response){
				if (response.status == 200) {
					getCustomerData();
					custoUpModal.hide();
					Swal.fire("Updated","Customer Update Successfully","success");
					customUpBtn.innerHTML = "Update";
				}else{
					getCustomerData();
					custoUpModal.hide();
					 Swal.fire({
					  icon: "error",
					  text: "Customer Updated Faild"
					});
					customUpBtn.innerHTML = "Update";
				}

			})
			.catch(function(error){
				getCustomerData();
				custoUpModal.hide();
				Swal.fire({
				  icon: "error",
				  text: "Customer Updated Faild"
				});
				customUpBtn.innerHTML = "Update";
			})
		})
	}

	function customerDelete(deleteId){
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't to Data Delete!",
		  icon: 'warning',
		  confirmButtonText: 'Deleted',
		  showCancelButton: true,
		  cancelButtonColor: '#d33'

		}).then((result) => {
		  if (result.isConfirmed) {
		   var url = "{{ route('users.CustomerDelete') }}";
		   var data = {deleteId:deleteId}
		   axios.post(url,data)
		   .then(function(response){
		   	if (response.status == 200) {
		   	   getCustomerData();
		   	   Swal.fire(
			      'Deleted!',
			      'Customer Data has been deleted.',
			      'success'
			    )
		   	}else{
		   		getCustomerData();
		   		Swal.fire({
				  icon: "error",
				  text: "Customer Data Deleted Faild"
				});
		   	}

		   })
		   .catch(function(error){
		 	  getCustomerData();
	   			Swal.fire({
				  icon: "error",
				  text: "Customer Data Deleted Faild"
			   });
		   })
		  }
		})
	}


</script>
@endsection