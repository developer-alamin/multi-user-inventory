<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title")</title>

	 {{-- MDB  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/mdb.min.css") }}">
	{{-- bootstrap css  --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap.min.css") }}">
	{{-- toastr cdn  --}}
	<link rel="stylesheet" href="{{ asset("css/toastr.min.css") }}">
	{{-- sweetalert2 cdn --}}
	<link rel="stylesheet" href="{{ asset("css/sweetalert2.min.css") }}">
	{{-- dataTables cdn --}}
	<link rel="stylesheet" href="{{ asset("css/dataTables.min.css") }}">
	<link rel="stylesheet" href="{{ asset("css/jquery-ui.css") }}">
	{{-- style css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/styles.css") }}">
	{{-- admin css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/admin.css") }}">
	{{-- loader css --}}
	<link rel="stylesheet" type="text/css" href="{{ asset("css/loader.css") }}">
</head>
<body class="sb-nav-fixed">

                     @includeif('users.layout.menu')
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
 	<script type="text/javascript" src="{{ asset("js/jquery-ui.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/dataTables.min.js") }}"></script>
 	<script type="text/javascript" src="{{ asset("js/dataTables.bootstrap5.min.js") }}"></script>
 	 <script type="text/javascript" src="{{ asset('assets/demo/Chart.min.js') }}"></script>
 	@yield('chartScript')
    <script type="text/javascript" src="{{asset('assets/demo/chart-area-demo.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/demo/chart-bar-demo.js')}}"></script>

	<script type="text/javascript" src="{{ asset("js/toastr.min.js") }}"></script>
	<script type="text/javascript" src="https://use.fontawesome.com/releases/v6.3.0/js/all.js"></script>
	<script src="{{ asset("js/scripts.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/html2pdf.bundle.min.js") }}" type="text/javascript"></script>
	<script src="{{ asset("js/admin.js") }}" type="text/javascript"></script>
	@yield("script")
</body>
</html>