@extends('templates.frontend.master')
@section('title','Search')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="section-title">
				<h3 class="title">Total Search(es): {{ $products->total() }}</h3>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="products-tabs">

					<!-- search products -->
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
									<a href="{{route('addToCart',$product->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
											add to cart</button></a>
								</div>
							</div>
						</div>
						<!-- /product -->
						@endforeach
					</div>
					<!-- /search products -->
					@if ($products->total())
					<!-- search bottom filter -->
					<div class="store-filter clearfix">
						<ul class="store-pagination">
							<li class="first"><a href="{{ $products->url(1) }}"><i class="fa fa-angle-left"></i></a></li>
							@for ($i=1;$i<=$products->lastPage();$i++)
								<li class="page-item @if ($products->currentPage()===$i) {{ 'active' }} @endif">
									<a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a></li>
								@endfor
								<li class="last"><a href="{{ $products->url($products->lastPage()) }}"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
					<!-- /search bottom filter -->
					@else
					<div class="text-center">
						<h1>No search result.</h1>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection