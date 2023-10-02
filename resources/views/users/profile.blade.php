@extends("users.layout.app")
@section("title","User | Profile")
@section("content")
<div class="profileContent">
	<div class="row">
		<div class="col-10 m-auto">
			<div class="card">
				<div class="card-body ">
					<div class="proCardHeading">
						<h5> Profile Of <span>{{ $userData->name }}</span></h5>
						<img src="{{ asset( $userData->photo) }}" alt="">
					</div>
					<hr>
					<div class="userInfo">
						<div class="row">
							<div class="col-4">
								<label>Name:</label>
								<input type="text" disabled class="form-control" value="{{ $userData->name }}">
							</div>
							<div class="col-4">
								<label>Email:</label>
								<input type="email"class="form-control" disabled value="{{ $userData->email }}">
							</div>
							<div class="col-4">
								<label>Phone:</label>
								<input type="number" class="form-control" disabled value="{{ $userData->phone }}">
							</div>
							<div class="col-4">
								<label>Shop Name:</label>
								<input type="text" class="form-control" disabled value="{{ $userData->shop }}">
							</div>
							<div class="col-4">
								<label>Village:</label>
								<input type="text" disabled class="form-control" value="{{ $userData->village }}">
							</div>

						</div>
						<div class="row">
							<div class="col-4 mt-2">
								<button data-id="{{ $userData->id }}" type="submit" class="btn create userProBtn form-control">Update</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{-- user profile update modal show --}}
<div class="modal fade" id="userUpModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header profileMH">
				<h4 class="modal-title">Profile Update</h4>
				<img src="" alt="" class="userImgUpPre">
			</div>
			<form id="userProUpForm" enctype="multipart/form-data">
				@csrf
				<div class="modal-body">
					<input type="hidden" name="userUpId" class="userUpId">
					<input type="hidden" name="userUpImg" class="userUpImg">

					<div class="row">
						<div class="col-4">
							<label>Image:</label>
							<input type="file" name="userUpFile" class="userUpFile form-control">
						</div>
						<div class="col-4">
							<label>Name:</label>
							<input type="text" name="userUpName" class="userUpName form-control" value="">
						</div>

						<div class="col-4">
							<label>Email:</label>
							<input type="email" name="userUpEmail" class="userUpEmail form-control" value="">
						</div>
						<div class="col-4">
							<label>Phone:</label>
							<input type="number" name="userUpPhone" class="userUpPhone form-control" value="">
						</div>
						<div class="col-4">
							<label>Shop Name:</label>
							<input type="text" name="userUpShop" class="userUpShop form-control" value="">
						</div>
						<div class="col-4">
							<label>Village:</label>
							<input type="text" name="userUpVillage" class="userUpVillage form-control" value="">
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
					<button type="submit" class="btn  create userProUpBtn">Update</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- user profile update modal show --}}

@endsection
@section("script")
<script type="text/javascript">
 profileShow();
 userImgPre();
 userProUpdate();
var userUpModal = document.querySelector("#userUpModal");
var userModal = new mdb.Modal(userUpModal);


function userImgPre(){
    var userUpFile = document.querySelector(".userUpFile");
    var userImgUpPre = document.querySelector(".userImgUpPre");
    userUpFile.addEventListener("change",function(e){
        userImgUpPre.src = URL.createObjectURL(e.target.files[0]);
    });
}

function profileShow(){
    var userProBtn = document.querySelector(".userProBtn");
    userProBtn.addEventListener("click",function(e){
        e.preventDefault();
        var profileId = userProBtn.getAttribute("data-id");
        userModal.show();
        var url = "{{ route('users.profileShow') }}";
        axios.post(url,{id:profileId})
        .then(function(response){
           if (response.status == 200) {
            addClass(".UploaderDiv","d-none")
            var userJsonData = response.data;
            element(".userUpImg",userJsonData.photo);
            element(".userUpId",userJsonData.id);
            img(".userImgUpPre", userJsonData.photo);
            element(".userUpName",userJsonData.name);
            element(".userUpEmail",userJsonData.email);
            element(".userUpPhone",userJsonData.phone);
            element(".userUpShop",userJsonData.shop);
            element(".userUpVillage",userJsonData.village);
           }else{
             addClass(".UploaderDiv","d-none")
             removeClass(".UpNotfoundDiv","d-none")
           }
        })
        .catch(function(error){
            addClass(".UploaderDiv","d-none")
            removeClass(".UpNotfoundDiv","d-none")
        })
    });
}

function userProUpdate(){

   var userProUpForm = document.querySelector("#userProUpForm");
   userProUpForm.addEventListener("submit",function(e){
        e.preventDefault();

        html(".userProUpBtn",loaderSpen)

        var url = "{{ route('users.profileUpdate') }}";
        var data = new FormData(userProUpForm);
        axios.post(url,data)
        .then(function(response){
            if (response.status == 200) {
                userModal.hide();
                location.reload();
            }
        })
        .catch(function(error){
            userModal.hide();
            location.reload();
        })
   });
}
</script>
@endsection