@extends("admin.layout.app")
@section("title","Admin | Dashboard")
@section("content")
<div class="adminDashContent">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">All Users</h5>
                    <h6 class="card-title">{{ $users }}</h6>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Users Approved</h5>
                    <h6 class="card-title">{{ $approved }}</h6>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Users Panding</h5>
                   <h6 class="card-title">{{ $padding }}</h6>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row chartRow">
        <div class="col-6">
            <div class="card mb-4">
               <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>Area Chart of Users
               </div>
               <div class="card-body">
                  <canvas id="myAreaChart" width="100%" height="40"></canvas>
               </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mb-4">
               <div class="card-header">
                  <i class="fas fa-chart-area me-1"></i>Area Chart of Users
               </div>
               <div class="card-body">
                  <canvas id="myBarChart" width="100%" height="40"></canvas>
               </div>
            </div>
        </div>

    </div>
</div>
@endsection()
@section("chartScript")
<script type="text/javascript">

</script>
@endsection()