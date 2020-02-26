@extends('templates.frontend.master')
@section('title','Electro')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title text-center">
				<br>
				<br>
				<br>
				<h1>You Must Login First To Buy This Product</h1>
				<br>
				<br>
				<br>
				<a href="{{ route('index') }}"><button class="btn btn-secondary" style="width:150px;margin-right:100px;font-weight:bold;"><i class="fa fa-reply"></i> Back</button>
				<a href="{{ route('getLogin') }}"><button class="btn btn-info" style="width:150px;margin-left:100px;font-weight:bold;">Login <i class="fa fa-user"></i></button></a>
			</div>
		</div>
	</div>
</div>
@endsection