@extends("admin.layout.app")
@section("title","Admin | Users")
@section("content")
<div class="adminUserPage">
	<div class="card">
		<div class="card-body">
			<div class="userTitle">
				<h3>Users Info</h3>
			</div>
			<hr>
			<div class="userTable">
				<table id="adUsersTb" class="table table-bordered d-none table-hover table-striped">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Shop Name</th>
							<th>Village</th>
							<th>Status</th>
							<th>Photo</th>
							<th>Action </th>
						</tr>
					</thead>
					<tbody class="adminUserTbody">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


{{--start loader  --}}
<div class="loaderDiv">
	<img src="{{ asset("img/loader.gif") }}" alt="">
</div>
<div class="noDataFoundDiv d-none">
    <img src="{{ asset("img/no data.png") }}" alt="">
</div>
{{--end loader  --}}

{{-- admin users modal show --}}
<div class="modal fade" id="adUserModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Users Status Update..</h4>
			</div>
			<form id="AdUserUpForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="upId" id="upId">
						<div class="col-12">
							<label>Status:</label>
							<select name="userStatus" class="form-select" id="userStatus">
								<option value="1">Approved</option>
								<option value="0">Pandding</option>
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
					<button type="submit" class="btn adUserUpBtn create">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- admin users modal show --}}


@endsection()
@section("script")
<script type="text/javascript">
	getUserInfo();
	adUserUpdate()

	var adUserModal = document.querySelector("#adUserModal");
	var adUserModal = new bootstrap.Modal(adUserModal);

	function getUserInfo() {
		var userTbody = document.querySelector(".adminUserTbody");
		var url = "{{ route("admin.usersInfo") }}";
		axios.get(url)
		.then(function(response){
			if (response.status == 200) {
				addClass(".loaderDiv","d-none");
				removeClass("#adUsersTb","d-none")
				$("#adUsersTb").DataTable().destroy();
				userTbody.innerHTML = "";
				var userInfoJson = response.data;
				var i = 1;
				userInfoJson.forEach( function(item) {
					var sr = "<td>"+i++ +"</td>";
					var name = "<td>"+item.name +"</td>";
					var email = "<td>"+item.email +"</td>";
					var phone = "<td>"+item.phone +"</td>";
					var shop = "<td>"+item.shop +"</td>";
					var village = "<td>"+item.village +"</td>";
					var photo = "<td><img src="+item.photo+"></td>";
					if (item.status == 0) {
						var status = "<td><p class='pandding'>Pandding</p></td>";
					}else{
						var status = "<td><p class='approved'>Approved</p></td>";
					}

					var action = "<td><button data-edit="+item.id+" class='btn editBtn'>Edit</button> <button data-delete="+item.id+" class='btn deleteBtn'>Delete</button></td>";
					var tr = document.createElement("tr");
					tr.innerHTML = sr+name+email+phone+shop+village+status+photo+action;
					userTbody.appendChild(tr)
				});

				var editBtn = document.querySelectorAll(".editBtn");
				editBtn.forEach(function(item){
					item.addEventListener("click",function(){
						var id = item.getAttribute("data-edit");
						adminUserShow(id)
						adUserModal.show();
					})
				});

				var deleteBtn = document.querySelectorAll(".deleteBtn");
				deleteBtn.forEach(function(item){
					item.addEventListener("click",function(){
						var deleteId = item.getAttribute("data-delete");
						adUserDel(deleteId);
					})
				});


				$("#adUsersTb").DataTable({
					order:[0,"desc"],
					pageLenght:[5],
					lengthMenu:[5,10,25,50,100]
				});
			}else{
				addClass(".loaderDiv","d-none");
				removeClass(".noDataFoundDiv","d-none")
			}

		})
		.catch(function(error){
			addClass(".loaderDiv","d-none");
			removeClass(".noDataFoundDiv","d-none");
		})
	}

	function adminUserShow(id){
		var url = "{{ route('admin.usersShow') }}";
		var data = {id:id};
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				addClass(".UploaderDiv","d-none");
				var userResJs = response.data;
				element("#upId",userResJs.id);
				element("#userStatus",userResJs.status);
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

	function adUserUpdate(){
		var url = "{{ route('admin.adUserUpdate') }}";
		var adUserUpBtn = document.querySelector(".adUserUpBtn");
		var AdUserUpForm = document.querySelector("#AdUserUpForm");
		AdUserUpForm.addEventListener("submit",function(e){
			e.preventDefault();
			adUserUpBtn.innerHTML = loader;
			adUserUpBtn.style.width = '100px';

			var data = new FormData(AdUserUpForm);
			axios.post(url,data)
			.then(function(response){
				adUserUpBtn.innerHTML = "Update";
				if (response.status == 200) {
					Swal.fire("Updated","Updated Success","success");
					getUserInfo();
					adUserModal.hide();
				}else{
					adUserUpBtn.innerHTML = "Update";
					Swal.fire("Sorry","Updated Success","error");
					getUserInfo();
					adUserModal.hide();
				}
			})
			.catch(function(error){
				adUserUpBtn.innerHTML = "Update";
				Swal.fire("Sorry","Updated Success","error");
				getUserInfo();
				adUserModal.hide();
			})
		});
	}

	function adUserDel(id){
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't to Data Delete!",
      icon: 'warning',
      confirmButtonText: 'Deleted',
      showCancelButton: true,
      cancelButtonColor: '#d33'

    }).then((result) => {
      if (result.isConfirmed) {
        var url = "{{ route('admin.usersDel') }}";
        axios.post(url,{id:id})
        .then(function(response){
            if (response.status == 200) {
               getUserInfo();
               Swal.fire("Deleted","Deleted Success","success");
            }else{
               getUserInfo();
               Swal.fire("Sorry","Deleted Faild","error");
            }
        })
        .catch(function(errror){
            getUserInfo();
            Swal.fire("Sorry","Deleted Faild","error");
        })
      }
    })
}
</script>
@endsection()