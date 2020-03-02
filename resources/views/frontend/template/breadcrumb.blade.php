<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="{{ asset(route('index')) }}">Home</a></li>
					<li><a href="{{ asset(route('store')) }}">All Categories</a></li>
					@if (!empty($category))
					@if ($category->parentCategories)
					<li><a href="{{ asset(route('store',$category->parentCategories->keyword)) }}">{{
							$category->parentCategories->name }}</a></li>
					@endif
					<li class="active">{{ $category->name }} ({{ $products->total() }} Results)</li>
					@endif
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->