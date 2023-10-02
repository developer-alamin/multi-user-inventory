@extends("users.layout.app")
@section("title","Admin Dashboard")
@section("content")
<div class="dashboardContent">
	<div class="row">
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/images.jpeg') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $customer }}</b>
					<p>Customer</p>
				</div>
			</div>
		</div>
			<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/category.png') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $category }}</b>
					<p>Category</p>
				</div>
			</div>
		</div>
			<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/brand.avif') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $brand }}</b>
					<p>Brand</p>
				</div>
			</div>
		</div>
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/product.png') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $product }}</b>
					<p>Product</p>
				</div>
			</div>
		</div>
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/taka.png') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $sales }}</b>
					<p>Sales</p>
				</div>
			</div>
		</div>
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/invoice.jpeg') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $invoice }}</b>
					<p>invoice</p>
				</div>
			</div>
		</div>
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/total.jpg') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $invTotalTaka }}</b>
					<p>Total Collection</p>
				</div>
			</div>
		</div>
		<div class="col-10 m-auto col-sm-9 col-md-4 col-lg-3 col-xl-3">
			<div class="card flex-row">
				<img src="{{ asset('img/vat.png') }}" class='dashCardImg' alt="">
				<div class="card-body">
					<b>{{ $vat }}</b>
					<p>Vat Collection</p>
				</div>
			</div>
		</div>

	</div>
	  <br>
   <div class="chartDiv">
      <div class="row">
         <div class="col-xl-6">
            <div class="card mb-4">
               <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>Area Chart of Sales
               </div>
               <div class="card-body">
                  <canvas id="myAreaChart" width="100%" height="40"></canvas>
               </div>
            </div>
         </div>
         <div class="col-xl-6">
            <div class="card mb-4">
               <div class="card-header">
                  <i class="fas fa-chart-bar me-1"></i> Bar Chart Of Invoice
               </div>
               <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="40"></canvas>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section("chartScript")
<script type="text/javascript">
  var _ySalesDayKey = JSON.parse('{!! json_encode($salesDayKey) !!}');
  var _xSalesDayCount = JSON.parse('{!! json_encode($salesDayCount); !!}');

 var _yInvDayKey = JSON.parse('{!! json_encode($InvDayKey) !!}');
  var _xInvDayCount = JSON.parse('{!! json_encode($InvDayCount); !!}');


</script>
@endsection