@extends("users.layout.app")
@section("title","User | Invoice")
@section("content")
<div class="invoceContentDiv">
	<div class="card">
		<div class="card-body">
			<div class="ionvoiceHeader ">
				<h4>invoice Data</h4>
				<a href="{{ route("users.salesPage") }}" class="btn create">Create Sales</a>
			</div>
			<hr>
			<div class="invoiceTableDiv">
				<table id="invoiceTable" class="table table-bordered table-hover table-striped d-none invoiceTable">
					<thead class="thead">
						<tr>
							<th>Sr No</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Total</th>
							<th>Vat</th>
							<th>Discount</th>
							<th>Payable</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody class="invoiceTbody">

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


{{-- invoice view modal show html start form here --}}
<div class="modal fade" id="InvViewModal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Invoice</h4>
			</div>
			<div id="InvpdfContent">
				<div class="modal-body">
				<div class="InvBilledDiv">
					<div class="billedColDiv">
						<h5>Billed To</h5>
						<div class="invNameDiv">
							<span class="h6">Name: </span><span class="invName"></span>
						</div>
						<div class="InvEmailDiv">
							<span class="h6">Email: </span><span class="InvEmail"></span>
						</div>
						<div class="InvPhoneDiv">
							<span class="h6">Phone: </span><span class="InvPhone"></span>
						</div>
					</div>
					<div class="InvColDiv">
						<h5>invoice</h5>
						<div class="InvDateDiv">
							<span class="h6">Date: </span><span class="InvDate"></span>
						</div>
					</div>
				</div>
				<hr>
				<div class="InvSalesTableInfo">
					<table class="table table-bordered table-hover">
						<thead class="thead">
							<tr>
								<th>Sr</th>
								<th>Name</th>
		                        <th>Qty</th>
		                        <th>Rate</th>
		                        <th>Total</th>
							</tr>
						</thead>
						<tbody class="InvSalesTbody">

						</tbody>
					</table>
				</div>
				<hr>
				<div class="invAmountInfo">
					<div class="InvtotalDiv">
						<span class="h6">Total: </span><span class="InvTotal">327</span>
					</div>
					<div class="InvVatDiv">
						<span class="h6">Vat: </span><span class="InvVat">327</span>
					</div>
					<div class="InvDisDiv">
						<span class="h6">Discount: </span><span class="InvDis">327</span>
					</div>
					<div class="InvPayableDiv">
						<span class="h6">Payable: </span><span class="InvPayable">327</span>
					</div>
				</div>
			</div>
			<hr>
			<div class="UploaderDiv">
				<img src="{{ asset("img/loader.gif") }}" alt="">
			</div>
			<div class="UpNotfoundDiv d-none">
			   <img src="{{ asset("img/no data.png") }}" alt="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-danger cencel" data-mdb-dismiss="modal">Cencel</button>
				<button type="submit" class="btn InvPrintBtn create btn-primary">Print</button>
			</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- invoice view modal show html end form here --}}

@endsection

@section("script")
<script type="text/javascript">
	invoiceAllData();
	var InvViewModalE = document.querySelector("#InvViewModal");
	var InvViewModal = new mdb.Modal(InvViewModalE);

	var Invpdf = document.querySelector("#InvpdfContent")
	var InvPrintBtn = document.querySelector(".InvPrintBtn");

	InvPrintBtn.addEventListener("click",function(){
		html2pdf().from(Invpdf).save();
	})

	function invoiceAllData(){
		var invoiceTable = document.querySelector("#invoiceTable");
		var invoiceTbody = document.querySelector(".invoiceTbody");
		var url = "{{ route('users.InvoiceAll') }}";
		axios.get(url)
		.then(function(response){
			if (response.status == 200) {
				addClass(".loaderDiv","d-none")
				removeClass(".invoiceTable","d-none");

				$("#invoiceTable").DataTable().destroy();
				invoiceTbody.innerHTML = "";
				var i = 1;
				var invoiceJson = response.data;
				invoiceJson.forEach( function(item) {
					var id = "<td>"+ i++ +"</td>";
					var name = "<td>"+item.name+"</td>";
					var phone = "<td>"+item.phone+"</td>";
					var total = "<td>"+item.total+"</td>";
					var vat = "<td>"+item.vat+"</td>";
					var discount = "<td>"+item.discount+"</td>";
					var payable = "<td>"+item.payable+"</td>";
					var action = "<td class='actionTd'><button data-view='"+item.id+"' class='btn invView viewBtn'><i class=' fas fa-eye'></i></button> <button data-delete='"+item.id+"' class='btn deleteBtn InvDelete'><i class='fas fa-trash'></i></button></td>";
					var cteateTr = document.createElement("tr");
					cteateTr.innerHTML = id+name+phone+total+vat+discount+payable+action;
					invoiceTbody.appendChild(cteateTr)
				});
				var invView = document.querySelectorAll(".invView");
				invView.forEach(function(item){
					item.addEventListener("click",function(){
						var viewId = item.getAttribute("data-view")
						invoiceViewShow(viewId)
						InvViewModal.show();
					});
				});
				var InvDelete = document.querySelectorAll(".InvDelete");
				InvDelete.forEach( function(item) {
					item.addEventListener("click",function(){
						var InvDelId = item.getAttribute("data-delete");
						InvSalsDelete(InvDelId);
					})
				});

				$("#invoiceTable").DataTable({
					order:[0,"desc"],
					pageLength : 5,
					lengthMenu:[5,10,20,50,100]
				});
			}else{
				addClass(".loaderDiv","d-none")
				addClass(".invoiceTable","d-none")
				removeClass(".noDataFoundDiv","d-none")
			}
		})
		.catch(function(error){
			addClass(".loaderDiv","d-none")
			addClass(".invoiceTable","d-none")
			removeClass(".noDataFoundDiv","d-none")
		})
	}


	function invoiceViewShow(viewId){
		var InvSalesTbody = document.querySelector(".InvSalesTbody");
		var url = "{{ route('users.InvoiceViewShow') }}";
		var data = {viewId:viewId}
		axios.post(url,data)
		.then(function(response){
			if (response.status == 200) {
				addClass(".UploaderDiv","d-none")
				InvSalesTbody.innerHTML = "";
				var InvViewJson = response.data.invoiceView;
				html(".invName",InvViewJson.name);
				html(".InvEmail",InvViewJson.email);
				html(".InvPhone",InvViewJson.phone);
				html(".InvDate",InvViewJson.date);
				html(".InvTotal",InvViewJson.total);
				html(".InvVat",InvViewJson.vat);
				html(".InvDis",InvViewJson.discount);
				html(".InvPayable",InvViewJson.payable);
				var salesViewJson = response.data.salesView;
				var i = 1;
				salesViewJson.forEach( function(item) {
					 var id = "<td>"+i++ +"</td>";
				     var name = "<td>"+item.name+"</td>";
	                  var Qty = "<td>"+item.quantity+"</td>";
	                  var rate = "<td>"+item.rate+"</td>";
	                  var total = "<td>"+item.total+"</td>";
					 var createTr = document.createElement("tr");
					 createTr.innerHTML = id+name+Qty+rate+total;
					 InvSalesTbody.appendChild(createTr);
				});
			}else{
				addClass(".UploaderDiv","d-none")
				removeClass(".UpNotfoundDiv","d-none")
			}
		})
		.catch(function(error){
			addClass(".UploaderDiv","d-none")
			removeClass(".UpNotfoundDiv","d-none")
		})
	}
	function InvSalsDelete(InvDelId){
		Swal.fire({
		  title: 'Are you sure?',
		  text: "You won't to Data Delete!",
		  icon: 'warning',
		  confirmButtonText: 'Deleted',
		  showCancelButton: true,
		  cancelButtonColor: '#d33'
		}).then((result) => {
		  if (result.isConfirmed) {
		   var url = "{{ route('users.invoiceDelete') }}";
		   var data = {InvDelId:InvDelId}
		   axios.post(url,data)
		   .then(function(response){
		   	if (response.status == 200) {
		   	 Swal.fire("Deleted","Invoice Deleted","success");
		   	 invoiceAllData();
		   	}else{
		   		Swal.fire("Sorry","Invoice Deleted Faild","error");
		   		invoiceAllData();
		   	}
		   })
		   .catch(function(error){
		 	 Swal.fire("Sorry","Invoice Deleted Faild","error");
		 	 invoiceAllData();
		   })
		  }
		})
	}
</script>
@endsection