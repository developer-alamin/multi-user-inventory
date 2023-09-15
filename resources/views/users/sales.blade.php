@extends("users.layout.app")
@section("title","User | Sales")
@section("content")
<div class="salesContentPageDiv">
	<div class="row mb-2">
		<div class="col-6 salesCustomerCol">

			<div class="card">
				<div class="card-body">
					<table id="salCusTable" class="table table-bordered table-hover table-striped">
						<thead class="thead">
							<tr>
								<th>Customer</th>
								<th>Phone</th>
								<th>Pick</th>
							</tr>
						</thead>
						<tbody class="pickCusTbody">


						</tbody>
					</table>
					<div class="UploaderDiv">
						<img src="{{ asset("img/loader.gif") }}" alt="">
					</div>
					<div class="UpNotfoundDiv d-none">
					    <img src="{{ asset("img/no data.png") }}" alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="col-6 salesProductCol">
			<div class="card">
				<div class="card-body">
					<table id="salProTable" class="table table-bordered table-hover table-striped">
						<thead class="thead">
							<tr>
								<th>Photo</th>
								<th>Name</th>
								<th>Pick</th>
							</tr>
						</thead>
						<tbody class="salProShowTbody">

						</tbody>
					</table>
					<div class="UploaderDiv salProLoader">
						<img src="{{ asset("img/loader.gif") }}" alt="">
					</div>
					<div class="UpNotfoundDiv salProNotFound d-none">
					   <img src="{{ asset("img/no data.png") }}" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>
   <div class="card salesCard">
      <div class="card-body">
         <div class="row salesHeadingRow">
            <div class="col-9">
               <h6>Billed To</h6>
               <div class="customerInfoDiv">
               	<table class="table">
               		<thead>
               			<tr>
               				<th>Name:</th>
               				<th><input type="text" name="SalCusName" class="SalCusName" disabled="true"></th>
               				<th>Email:</th>
               				<th><input type="email" name="SalCusEmail" disabled="true" class="SalCusEmail"></th>
               				<th>Phone:</th>
               				<th><input type="number" name="SalCusPhone" disabled="true" class="SalCusPhone"></th>
               			</tr>
               		</thead>
               	</table>
               </div>
            </div>
            <div class="col-3">
            	<h6>Inventory</h6>
            	<table class="table">
            		<thead>
            			<tr>
            				<th>Invoice</th>
            				<th>Date: {{ date('d-m-y') }}</th>
            			</tr>
            		</thead>
            	</table>
            </div>
         </div>
         <hr>
         <form id="CreSalesForm">
         	@csrf
            <div class="salesProductTableDiv">
            	<input type="hidden" name="salCusPickId" class="salCusPickId">
               <table class="table ">
                  <thead class="thead">
                     <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Total</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody class="salProTbody" name="tbody">

                  </tbody>
               </table>
            </div>
            <hr>
            <div class="salesTakDiv">
            	<table class="table">
            		<thead class="thead">
            			<tr>
            				<th>Total : <span class="totalTakaSpan"></span></th>
            				<th>Payable : <span class="payableSpan"></span></th>
            				<th class="vatTh" data-vat="5">Vat (5%) : <span class="vatCollectSpan"></span></th>
            				<th>Save : <span class="saveSpan"></span></th>
            				<th class="discountTh">Discount :<input type="number" name="disInput" class="disInput" placeholder="Discount Taka"></th>
            			</tr>
            		</thead>
            		<input type="hidden" name="HiddInToTaka" class="HiddInToTaka">
            		<input type="hidden" name="inputTotalTaka" class="inputTotalTaka">
            		<input type="hidden" name="HiddInPayTaka" class="HiddInPayTaka">
            		<input type="hidden" name="inputPayTaka" class="inputPayTaka">
            		<input type="hidden" name="InputVatTaka" class="InputVatTaka">
            		<input type="hidden" name="InputDisTaka" class="InputDisTaka">
            	</table>
            </div>
            <button type="submit" class="btn create">Confirm</button>
         </form>
      </div>
   </div>
</div>


{{-- modal product show for qty sum --}}
<div class="modal fade" id="quantitySumProModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Product</h4>
			</div>
			<form id="InvAddProForm">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<input type="hidden" name="invAddProId" class="invAddProId">
						<div class="col-10">
							<label>Product Name:</label>
							<input type="text" name="InvaddProName" class="form-control InvaddProName">
						</div>
						<div class="col-10">
							<label>Product Rate:</label>
							<input type="number" name="InvaddProRate" class="form-control InvaddProRate">
						</div>
						<div class="col-10">
							<label>Product Quantity:</label>
							<input type="number" name="InvaddProQty" class="form-control InvaddProQty" placeholder="Product Quantity">
						</div>
					</div>
				</div>
				<div class="UploaderDiv InvAddPLoader">
					<img src="{{ asset("img/loader.gif") }}" alt="">
				</div>
				<div class="UpNotfoundDiv InvAddPNFound d-none">
				    <img src="{{ asset("img/no data.png") }}" alt="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
					<button type="submit" class="btn btn-outline-success successBtn InvAddProBtn">Save</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section("script")
<script type="text/javascript">
	salPickCusShow()
	CreateSalesForm();
	salProductShow();
	InvAddProduct();
	dsicount();

function salPickCusShow() {
   var salCusTable = document.querySelector("#salCusTable");
   var pickCusTbody = document.querySelector(".pickCusTbody");
   var url = "{{ route('users.GetCustomer') }}";
   axios.get(url)
      .then(function(response) {
         if (response.status == 200) {
            addClass(".UploaderDiv", "d-none")
            $("#salCusTable").DataTable().destroy();
            pickCusTbody.innerHTML = "";
            var salCusJson = response.data;
            salCusJson.forEach(function(item, i) {
               var name = "<td>" + item.name + "</td>";
               var phone = "<td>" + item.phone + "</td>";
               var pick = "<td><button data-id=" + item.id + " class='btn create salPickCusBtn'>Add</button></td>";
               var createTr = document.createElement("tr");
               createTr.innerHTML = name + phone + pick;
               pickCusTbody.appendChild(createTr)
            });
            var salPickCusBtn = document.querySelectorAll(".salPickCusBtn");
            salPickCusBtn.forEach(function(item, i) {
               item.addEventListener("click", function() {
                  var CusPickId = item.getAttribute("data-id");
                  item.innerHTML = loaderSpen;
                  customerPick(CusPickId, item)
               })
            })
            $("#salCusTable").DataTable({
               order: [0, "desc"],
               pageLength: 2,
               lengthMenu: [2, 3, 5]
            });
         } else {
            addClass(".UploaderDiv", "d-none");
            removeClass(".UpNotfoundDiv", "d-none")
         }
      })
      .catch(function(error) {
         addClass(".UploaderDiv", "d-none");
         removeClass(".UpNotfoundDiv", "d-none")
      })
}

function customerPick(CusPickId, item) {
   var url = "{{ route('users.customerPick') }}";
   axios.post(url, {CusPickId: CusPickId})
      .then(function(response) {
         if (response.status == 200) {
            item.innerHTML = "Add";
            var cusPickJson = response.data;
            element(".salCusPickId", cusPickJson.id);
            element(".SalCusName", cusPickJson.name);
            element(".SalCusEmail", cusPickJson.email);
            element(".SalCusPhone", cusPickJson.phone);
         } else {
            item.innerHTML = "Faild";
            setTimeout(() => {
               item.innerHTML = "Add";
            }, 3000)
         }
      })
      .catch(function(error) {
         item.innerHTML = "Faild";
         setTimeout(() => {
            item.innerHTML = "Add";
         }, 3000)
      })
}
var qtyProSum = document.querySelector("#quantitySumProModal");
var qtyProSumModal = new mdb.Modal(qtyProSum)

function salProductShow() {
   var salProShowTbody = document.querySelector(".salProShowTbody");
   var url = "{{ route('users.salProductShow') }}";
   axios.get(url)
      .then(function(response) {
         if (response.status == 200) {
            addClass(".salProLoader", "d-none")
            $("#salProTable").DataTable().destroy();
            salProShowTbody.innerHTML = "";
            var salProJson = response.data;
            salProJson.forEach(function(item) {
               var img = "<td><img src=" + item.photo + " style='width: 30px;height: 30px;'></td>";
               var nameRate = "<td>" + item.name + "(<span>" + item.rate + "</span>)</td>";
               var pick = "<td><button data-id=" + item.id + " class='btn create ProductPickBtn'>Add</button></td>";
               var createTr = document.createElement("tr");
               createTr.innerHTML = img + nameRate + pick;
               salProShowTbody.appendChild(createTr);
            });
            var ProPickBtn = document.querySelectorAll(".ProductPickBtn");
            ProPickBtn.forEach(function(item) {
               item.addEventListener("click", function() {
                  qtyProSumModal.show();
                  var InvAddProId = item.getAttribute("data-id");
                  InvAddProShow(InvAddProId);
               })
            })
            $("#salProTable").DataTable({
               order: [0, "desc"],
               pageLength: 2,
               lengthMenu: [2, 3, 5]
            });
         } else {
            addClass(".salProLoader", "d-none")
            removeClass(".salProNotFound", "d-none")
         }
      })
      .catch(function(error) {
         addClass(".salProLoader", "d-none")
         removeClass(".salProNotFound", "d-none")
      })
}

function InvAddProShow(InvAddProId) {
   var url = "{{ route('users.invAddProShow') }}";
   axios.post(url, {
         InvAddProId: InvAddProId
      })
      .then(function(response) {
         if (response.status == 200) {
            var invAddProJson = response.data;
            addClass(".InvAddPLoader", "d-none");
            element(".invAddProId", invAddProJson.id);
            element(".InvaddProName", invAddProJson.name);
            element(".InvaddProRate", invAddProJson.rate);
         } else {
            addClass(".InvAddPLoader", "d-none");
            removeClass(".InvAddPNFound", "d-none");
         }
      })
      .catch(function(error) {
         addClass(".InvAddPLoader", "d-none");
         removeClass(".InvAddPNFound", "d-none");
      })
}

function InvAddProduct() {
   var InvAddProForm = document.querySelector("#InvAddProForm");
   var InvAddProBtn = document.querySelector(".InvAddProBtn");
   var salProTbody = document.querySelector(".salProTbody");
   var InvAddProQty = document.querySelector(".InvaddProQty");
   InvAddProForm.addEventListener("submit", function(e) {
      e.preventDefault();
      if (InvAddProQty.value == "") {
         toastr.error("Please Quantity")
      } else {
         InvAddProBtn.innerHTML = loader;
         InvAddProBtn.style.width = '100px';
         var url = "{{ route('users.InvProductAdd') }}";
         var data = new FormData(InvAddProForm)
         axios.post(url, data)
            .then(function(response) {
               if (response.status == 200) {
                  InvAddProQty.value = "";
                  InvAddProBtn.innerHTML = "Save";
                  qtyProSumModal.hide();
                  var InvJsonApeend = response.data;
                  var RateParseInt = parseInt(InvJsonApeend.InvaddProRate);
                  var QtyParseInt = parseInt(InvJsonApeend.InvaddProQty);
                  var totalQtyRate = QtyParseInt * RateParseInt;
                  var id = "<td><input type='number' name='InvAddid[]' value="+InvJsonApeend.invAddProId+"></td>";

                  var name = "<td><input type='text' name='name[]' value=" + InvJsonApeend.InvaddProName + "></td>";
                  var Qty = "<td><input type='number' name='qty[]' value=" + QtyParseInt + "></td>";
                  var rate = "<td><input type='number' name='rate[]' value=" + RateParseInt + "></td>";
                  var total = "<td><input type='number' name='total[]' value=" + totalQtyRate + " class='total'></td>";
                  var action = " <td ><button data-total=" + totalQtyRate + " class='btn btn-outline-danger removeEle deleteBtn'>Remove</button></td>";
                  var createTr = document.createElement("tr");
                  createTr.classList.add("trRow");
                  createTr.innerHTML = id+name + Qty + rate + total + action;
                  salProTbody.appendChild(createTr);

                  function TotalAmount() {
                     var salProTbodyTr = document.querySelectorAll(".total");
                     var vat = 0;
                     var Totalamount = 0;
                     var discount = 0;
                     for (var i = 0; i < salProTbodyTr.length; i++) {
                        var vatSpan = document.querySelector(".vatTh");
                        var vatData = vatSpan.getAttribute("data-vat");
                        var trs = salProTbodyTr[i].getAttribute("value");
                        Totalamount = Number(Totalamount) + Number(trs);
                        vat = Totalamount / 100 * vatData;
                        vat = Math.round(vat);
                     }
                     html(".vatCollectSpan", vat);
                     element(".InputVatTaka", vat);
                     html(".totalTakaSpan", Totalamount);
                     element(".inputTotalTaka", Totalamount);
                     element(".HiddInToTaka", Totalamount);
                     var payableTaka = Number(Totalamount) + Number(vat);
                     html(".payableSpan", payableTaka);
                     element(".inputPayTaka", payableTaka);
                     element(".HiddInPayTaka", payableTaka);
                     html(".saveSpan", 0)
                     element(".InputDisTaka", 0);
                     element(".disInput", "")
                  }
                  TotalAmount()
                  var removeEle = document.querySelectorAll(".removeEle");
                  removeEle.forEach(function(item) {
                     item.addEventListener("click", function() {
                        var parent = item.parentElement;
                        var lastParent = parent.parentElement;
                        lastParent.remove();
                        TotalAmount();
                     })
                  });
               } else {
                  InvAddProBtn.innerHTML = "Save";
                  qtyProSumModal.hide();
               }
            })
            .catch(function(error) {
               InvAddProBtn.innerHTML = "Save";
               qtyProSumModal.hide();
            })
      }
   })
}

function dsicount() {
   var disInput = document.querySelector(".disInput");
   disInput.addEventListener("input", function() {
      var HiddInPayTaka = document.querySelector(".HiddInPayTaka");
      var HiInTotalTaka = document.querySelector(".HiddInToTaka");
      var HiInPayTakaNum = Number(HiddInPayTaka.value);
      var HiInTotalTakaNum = Number(HiInTotalTaka.value)
      var disInputNum = Number(disInput.value);
      var TotalTakaDisR = HiInTotalTakaNum - disInputNum;
      var PayTakaDisR = HiInPayTakaNum - disInputNum;
      html(".saveSpan", disInputNum)
      element(".InputDisTaka", disInputNum);
      html(".totalTakaSpan", TotalTakaDisR);
      element(".inputTotalTaka", TotalTakaDisR);
      html(".payableSpan", PayTakaDisR);
      element(".inputPayTaka", PayTakaDisR);
   })
}

function CreateSalesForm() {
   var CreSalesForm = document.querySelector("#CreSalesForm");
   CreSalesForm.addEventListener("submit", function(e) {
      e.preventDefault();
      var SalCustomer = document.querySelector(".salCusPickId");
      var salProTbody = document.querySelectorAll(".salProTbody tr");

      if (SalCustomer.value == "") {
         toastr.error("please Customer Select")
      }else if(salProTbody.length === 0){
         toastr.error("please Product Pick")
      }else{
          var url = "{{ route('users.createSales') }}";
          var data = new FormData(CreSalesForm)
          axios.post(url, data)
          .then(function(response) {
              if (response.status == 200) {
                  window.open('/users/invoicePage', "_self");
               } else {
                  Swal.fire("Sorry", "Your Sales Faild", "error")
               }
            })
            .catch(function(error) {
               Swal.fire("Sorry", "Your Sales Faild", "error")
            });
        }
   })
}


</script>
@endsection