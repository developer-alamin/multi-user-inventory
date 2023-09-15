@extends("users.layout.app")
@section("title","User | Report")
@section("content")
<div class="reportContentPage">
	<div class="row">
		<div class="col-5">
			<div class="card">
				<div class="card-body">
					<div class="reportHeading">
						<h4>Sales Report</h4>
					</div>
					<hr>
					<div class="reportForm">
						<form id="reportFormId">
							<div class="form-group">
								<div class="col-11 m-auto">
									<label>Date From :</label>
									<input type="text" name="fromData" class="form-control fromData" placeholder="mm/dd/yyyy">
								</div>
								<div class="col-11 m-auto pt-2">
									<label>Date To :</label>
									<input type="text" name="toDate" class="form-control toDate" placeholder="mm/dd/yyyy">
								</div>
								<div class="col-8 reportBtnDiv m-auto pt-2">
									<button type="submit" class="btn form-control create reportBtn">Generate Report</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade ReportModalPdf" id="ReportModalPdf">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<form id="reportPdfForm">
				<div class="modal-header">
					<h4 class="modal-title">Invoice Report</h4>
				</div>
				<hr>
				<div class="modal-body">

					<div class="InvSummTable">
						<h5>Summary</h5>
						<table class="table table-bordered">
							<thead class="thead">
								<tr>
									<th>Report</th>
									<th>Date</th>
									<th>Total</th>
									<th>Discount</th>
									<th>Vat</th>
									<th>Payable</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th class="SumReport"></th>
									<th class="SumDate"></th>
									<th class="SumTotal"></th>
									<th class="SumDiscount"></th>
									<th class="SumVat"></th>
									<th class="SumPayable"></th>
								</tr>
							</tbody>
						</table>
					</div>
					<hr>
					<div class="ReportDetailsDiv">
						<h5>Details</h5>
						<table class="table table-bordered table-hover table-striped">
							<thead class="thead">
								<tr>
									<th>Customer</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Total</th>
									<th>Discount</th>
									<th>Vat</th>
									<th>Payable</th>
								</tr>
							</thead>
							<tbody class="reDetailTbody">
							</tbody>
						</table>
					</div>
				</div>
				<div class="UploaderDiv d-none">
					<img src="{{ asset("img/loader.gif") }}" alt="">
				</div>
				<div class="UpNotfoundDiv d-none">
				    <img src="{{ asset("img/no data.png") }}" alt="">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn cencel" data-mdb-dismiss="modal">Close</button>
					<button class="btn create ReportPdfBtn">Report PDF</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@endsection
@section("script")
<script type="text/javascript">
	$( function() {
	    $(".fromData,.toDate").datepicker({
	    	showAnim:'slideDown',
	    	showButtonPanel: true,
	    	dateFormat:"dd-mm-yy",
	      }
	    );
	  });
	reportForm();
	ReportPdfDown();
	var ReportModalPdf = document.querySelector("#ReportModalPdf");
	var ReportModal = new mdb.Modal(ReportModalPdf);

	function reportForm(){
	    var fromDate = document.querySelector(".fromData");
	    var toDate = document.querySelector(".toDate");
	    var reportForm = document.querySelector("#reportFormId");
	    var reportBtn = document.querySelector(".reportBtn");
	   var reDetailTbody = document.querySelector(".reDetailTbody");

	    reportForm.addEventListener("submit",function(e){
	        e.preventDefault();
	        var url = "{{ route('users.reportGena') }}";
	        var data = new FormData(reportForm)
	        if (fromDate.value == "") {
	           toastr.error("Please Date From")
	        }else if (toDate.value == "") {
	            toastr.error("Please Date To")
	        }else{
	            reportBtn.innerHTML = loaderSpen;
	            axios.post(url,data)
	            .then(function(response){
	               if (response.status == 200) {
	                 reportBtn.innerHTML = "Generate Report";
	                 reportForm.reset();
	                 addClass(".UploaderDiv","d-none");

	                reDetailTbody.innerHTML = ""
	                  ReportModal.show();
	                  html(".SumReport","Sales Report")
	                  html(".SumDate",response.data.date)
	                  html(".SumTotal",response.data.ReportTotal)
	                  html(".SumDiscount",response.data.ReDiscount)
	                  html(".SumVat",response.data.ReportVat)
	                  html(".SumPayable",response.data.RepPayable)
	                  var reportDetails = response.data.reportDetails;
	                  reportDetails.forEach( function(item) {
	                     var customer = "<th>"+item.name+"</th>";
	                     var phone = "<th>"+item.phone+"</th>";
	                     var email = "<th>"+item.email+"</th>";
	                     var total = "<th>"+item.total+"</th>";
	                     var discount = "<th>"+item.discount+"</th>";
	                     var vat = "<th>"+item.vat+"</th>";
	                     var payable = "<th>"+item.payable+"</th>";
	                    var createTr = document.createElement("tr");
	                    createTr.innerHTML = customer+phone+email+total+discount+vat+payable;
	                     reDetailTbody.appendChild(createTr)
	                  });

	               }else {
	                    reportBtn.innerHTML = "Generate Report";
	                    addClass(".UploaderDiv","d-none");
	                    removeClass(".UpNotfoundDiv","d-none")
	               }
	            })
	            .catch(function(error){
	                 reportBtn.innerHTML = "Generate Report";
	                addClass(".UploaderDiv","d-none");
	                removeClass(".UpNotfoundDiv","d-none")
	            })
	        }
	    })
	}


	function ReportPdfDown(){
	   var reportPdfForm = document.querySelector("#reportPdfForm");
	    reportPdfForm.addEventListener("submit",function(e){
	        e.preventDefault();
	       html2pdf().from(reportPdfForm).save();
	    })
	}
</script>
@endsection