<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ $token->user->name }}</title>
	<link rel="icon" href="{{ $token->user->photo }}">
	<style type="text/css">
		div.box {
			text-align:center;
		    background: white;
		    border: 1px solid #bfb8b8;
		    padding-top: 71px;
		    padding-bottom: 71px;
		    padding-left: 45px;
		    padding-right: 45px;
		    border-radius: 5px;
		    color: blue;
		    box-shadow: inset 0px 0px 12px 2px #5e25b9;
		    width:400px;
		    margin:auto;
		}
	</style>
</head>
<body>
	<div class="box">
		<h1>Wellcome, {{ $token->user->name }}</h1>
		<h2>Alamin Your OTP : {{ $token->token }}</h2>
	</div>
</body>
</html>