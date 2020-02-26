@extends('templates.frontend.master')
@section('title')
@if ($category === '')
All Products - Electro Website
@elseif ($category->parentCategories)
{{ $category->parentCategories->name }} - Electro Website
@else
{{ $category->name }} - Electro Website
@endif
@endsection
@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb-tree">
					<li><a href="{{ asset(route('index')) }}">Home</a></li>
					<li><a href="{{ asset(route('store','all-products')) }}">All Categories</a></li>
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

<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3 clearfix visible-md visible-lg visible-xl">
				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Categories</h3>
					<div class="checkbox-filter">
						@foreach ($categories as $category)
						@if ($category->parent_id === 0)
						<div class="input-checkbox">
							<input type="checkbox" id="category-1">
							<label for="category-1">
								<span></span>
								{{ $category->name }}
								<small>({{ $category->products_count }})</small>
							</label>
						</div>
						@endif
						@endforeach
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Price</h3>
					<div class="price-filter">
						<div id="price-slider"></div>
						<div class="input-number price-min">
							<input id="price-min" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
						<span>-</span>
						<div class="input-number price-max">
							<input id="price-max" type="number">
							<span class="qty-up">+</span>
							<span class="qty-down">-</span>
						</div>
					</div>
				</div>
				<!-- /aside Widget -->

				<!-- aside Widget -->
				<div class="aside">
					<h3 class="aside-title">Brand</h3>
					<div class="checkbox-filter">
						@foreach ($categories as $category)
						@if ($category->parent_id !== 0)
						<div class="input-checkbox">
							<input type="checkbox" id="brand-1">
							<label for="brand-1">
								<span></span>
								{{ $category->name }}
								<small>({{ $category->products_count }})</small>
							</label>
						</div>
						@endif
						@endforeach
					</div>
				</div>
				<!-- /aside Widget -->
			</div>
			<!-- /ASIDE -->

			<!-- STORE -->
			<div id="store" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter">
					<div class="store-sort">
						<label>
							Sort By:
							<select class="input-select">
								<option value="0">Popular</option>
								<option value="1">Position</option>
							</select>
						</label>

						<label>
							Show:
							<select class="input-select">
								<option value="0">20</option>
								<option value="1">50</option>
							</select>
						</label>
					</div>
					<ul class="store-grid">
						<li class="active"><i class="fa fa-th"></i></li>
						<li><a href="#"><i class="fa fa-th-list"></i></a></li>
					</ul>
				</div>
				<!-- /store top filter -->

				<!-- store products -->
				<div class="row" id="areaProduct">
					@foreach ($products as $key=>$product)
					<!-- product -->
					<div class="col-md-4 col-xs-6">
						<div class="product">
							<a href="{{ route('product',$product->id) }}">
								<div class="product-img">
									<img src="{{ asset($product->picture) }}" alt="{{ $product->name }}">
									<div class="product-label">
										@if ($product->sale)
										<span class="sale">-{{ $product->sale }}%</span>
										@endif
										@if ($product->new)
										<span class="new">NEW</span>
										@endif
									</div>
								</div>
							</a>
							<div class="product-body">
								<p class="product-category">{{ $product->category->name }}</p>
								<h3 class="product-name"><a href="#">{{ $product->name }}</a></h3>
								<h4 class="product-price">{{
									$product->price-$product->price*$product->sale/100 }}$ </h4>
								@if ($product->sale)
								<del class="product-old-price">{{ $product->price }}$</del>
								@else
								<br />
								@endif
								<div class="product-rating">
									@for ($i = 0; $i < $product->rating; $i++)
										<i class="fa fa-star"></i>
										@endfor
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
											to wishlist</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
											to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick
											view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<div class="add-to-cart">
									<a href="{{route('addToCart',$product->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
											add to cart</button></a>
								</div>
							</div>
						</div>
						</div>
						<!-- /product -->
						@endforeach
					</div>
					<!-- /store products -->

					<!-- store bottom filter -->
					<div class="store-filter clearfix">
						<span class="store-qty">Showing 20-100 products</span>
						<ul class="store-pagination">
							<li class="first"><a href="{{ $products->url(1) }}"><i class="fa fa-angle-left"></i></a></li>
							@for ($i=1;$i<=$products->lastPage();$i++)
								<li class="page-item @if ($products->currentPage()===$i) {{ 'active' }} @endif">
									<a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
								@endfor
								<li class="last"><a href="{{ $products->url($products->lastPage()) }}"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
					<!-- /store bottom filter -->
				</div>
				<!-- /STORE -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	@endsection