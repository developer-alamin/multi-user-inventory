<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title")</title>
	<link rel="icon" href="{{ asset("img/alamin.jpg") }}">
	 {{-- MDB  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/mdb.min.css") }}">
	{{-- bootstrap css  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap.min.css") }}">
	{{-- sweetalert2 cdn --}}
	<link rel="stylesheet" href="{{ asset("css/sweetalert2.min.css") }}">
	{{-- dataTables cdn --}}
	<link rel="stylesheet" href="{{ asset("css/dataTables.min.css") }}">
	{{-- admin css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/admin.css") }}">
	<link rel="stylesheet" type="text/css" href="{{ asset("css/styles.css") }}">
	{{-- loader css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/loader.css") }}">
</head>
<body>


                     @includeif('admin.layout.menu')
                   @yield('content')
                </div>
             </main>
          </div>
       </div>


     <script type="text/javascript" src="{{ asset("js/jquery.min.js") }}"></script>
     <!-- MDB -->
    <script type="text/javascript" src="{{ asset("js/mdb.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/bootstrap.bundle.min.js") }}" ></script>
 	<script type="text/javascript" src="{{ asset("js/popper.min.js") }}"></script>

 	<script type="text/javascript" src="{{ asset("js/axios.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/dataTables.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/dataTables.bootstrap5.min.js") }}"></script>
 	 <script type="text/javascript" src="{{ asset('assets/demo/Chart.min.js') }}"></script>
 	@yield('chartScript')
    <script type="text/javascript" src="{{asset('assets/demo/adminChartArea.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/demo/adminChartBar.js')}}"></script>
	<script type="text/javascript" src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
	<script src="{{ asset("js/scripts.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/admin.js") }}" type="text/javascript"></script>
	@yield("script")
</body>
</html>