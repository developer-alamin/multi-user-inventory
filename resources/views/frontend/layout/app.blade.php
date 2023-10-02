<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title")</title>

    {{-- bootstrap css  --}}
    <link rel="stylesheet" type="text/css" href="{{ asset("css/bootstrap.min.css") }}">
    {{-- sweetalert2 cdn --}}
  <link rel="stylesheet" href="{{ asset("css/sweetalert2.min.css") }}">

    {{-- toastr cdn  --}}
    <link rel="stylesheet" href="{{ asset("css/toastr.min.css")}}">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/frontend.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/progress.css") }}">
     <link rel="stylesheet" type="text/css" href="{{ asset("css/toastrustom.css") }}">
</head>
<body>

  <div class="ProgressContent d-none">
    <div class="progress-bar">
      <div class="progress-bar-value"></div>
    </div>
  </div>
  <div class="fullScreenDiv d-none"></div>

  @includeif("frontend.layout.header")
	@yield("content")

	<script type="text/javascript" src="{{ asset("js/jquery.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("js/popper.min.js") }}"></script>
     <!-- MDB -->
    {{-- <script type="text/javascript" src="{{ asset("js/mdb.min.js") }}"></script> --}}

 	<script type="text/javascript" src="{{ asset("js/bootstrap.bundle.min.js") }}" ></script>
   <script type="text/javascript" src="{{ asset("js/axios.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("js/sweetalert2.all.min.js") }}"></script>

    <script type="text/javascript" src="{{ asset("js/toastr.min.js") }}"></script>
    <script src=" {{asset("js/frontend.js")}}" type="text/javascript"></script>

    @yield("script")
    <script type="text/javascript">
      $(document).ready(function(){
        $(".alert").fadeTo(2000, 500).slideUp(500,function(){
            $(".alert").slideUp(500);
        });
      });
    </script>
</body>
</html>