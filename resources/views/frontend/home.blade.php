@extends("frontend.layout.app")
@section("title","Home Page")
@section("content")
<div class="container">
	<marquee class="marquee"><label>All the pages have been completed. Only the home page has not been completed</label></marquee>
	<h1 style="font-size: 140px;">Multi-User Inventory Home Page...</h1>
	<span>(admin gmail::contact.alamin8@gmail.com)</span>
	<span>(Pass::12345)</span>

</div>
@endsection()
@section("script")
<script type="text/javascript">
	var marquee = document.querySelector("marquee");
	marquee.addEventListener("mouseover",function(){
		this.stop();
	});
	marquee.addEventListener("mouseout",function(){
		this.start();
	});

</script>
@endsection()