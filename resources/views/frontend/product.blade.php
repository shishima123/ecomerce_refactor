@extends('templates.frontend.master')
@section('title')
{!! $product->name !!} - Electro Website
@endsection
@section('content')
@include('templates.Admin.flash_message')
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src="{{ asset($product->picture) }}" alt="">
					</div>
					@foreach ($product->image_products as $image_product)
					<div class="product-preview">
						<img src="{{ asset($image_product->path) }}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<div class="product-preview">
						<img src="{{ asset($product->picture) }}" alt="">
					</div>
					@foreach ($product->image_products as $image_product)
					<div class="product-preview">
						<img src="{{ asset($image_product->path) }}" alt="">
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-5">
				<div class="product-details">
					<h2 class="product-name">{{$product->name}}</h2>
					<div>
						<div class="product-rating">
							@for ($i = 0; $i < $product->rating; $i++)
								<i class="fa fa-star"></i>
								@endfor
						</div>
						<a class="review-link" href="#">{{ count($product->comment_ratings) }} Review(s)</a>
					</div>
					<div>
						<h4 class="product-price">{{ $product->price - $product->price * $product->sale/100 }}$ </h4>
						@if ($product->sale)
						<del class="product-old-price">{{ $product->price }}$</del>
						@else
						<br />
						@endif
						<span class="product-available">In Stock</span>
					</div>
					<p>{{$product->description}}</p>

					<div class="add-to-cart">
						<div class="qty-label">
							Qty
							<div class="input-number">
								<input type="number" id="qty" value="1" name="qty">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<div class="add-to-cart">
							<a href="{{route('addToCart',$product->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
									add to cart</button></a>
						</div>

						<ul class="product-btns">
							<li><a href="#"><i class="fa fa-heart-o"></i> add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-exchange"></i> add to compare</a></li>
						</ul>

						<ul class="product-links">
							<li>Category:</li>
							<li><a href="{{ route('store',$category->keyword) }}">{{ $category->name }}</a></li>
						</ul>

						<ul class="product-links">
							<li>Share:</li>
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-envelope"></i></a></li>
						</ul>

					</div>
				</div>
				<!-- /Product details -->
			</div>
			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li><a data-toggle="tab" href="#tab1">Description</a></li>
						<li class="active"><a data-toggle="tab" href="#tab2">Details</a></li>
						<li><a data-toggle="tab" href="#tab3">Reviews ({{ count($product->comment_ratings) }})</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									<p>{{ $product->description }}</p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12 text-center">
									<p>{!! $product->content !!}</p>
								</div>
							</div>
						</div>
						<!-- /tab2  -->

						<!-- tab3  -->
						<div id="tab3" class="tab-pane fade in">
							<div class="row">
								<!-- Rating -->
								<div class="col-md-3">
									<div id="rating">
										<div class="rating-avg">
											<span>{{ round($product->rating,1) }}</span>
											<div class="rating-stars">
												@for ($i=0;$i<round($product->rating,1);$i++)
													<i class="fa fa-star"></i>
													@endfor
											</div>
										</div>
										<ul class="rating">
											{{-- Star rating from 1->5 --}}
											@for ($i=1;$i<6;$i++) <li>
												<div class="rating-stars">
													{{-- show star --}}
													@for ($j=6;$j>1;$j--)
													@if ($j<=$i) <i class="fa fa-star-o"></i>
														@else
														<i class="fa fa-star"></i>
														@endif
														@endfor
												</div>

												@php $sum=0; @endphp {{--Set $sum=0--}}
												{{-- Calculate sum rating each star rating --}}
												@foreach ($comment_ratings as $key=>$rating)
												@if ($rating->pivot->rating == 6-$i)
												@php $sum++; @endphp
												@endif
												@endforeach
												<div class="rating-progress">
													{{-- Calculate % each star rating --}}
													@if ($comment_ratings->total() !=0 )
													<div style="width: {{ $sum/$comment_ratings->total()*100 }}%;"></div>
													@endif
												</div>
												<span class="sum">{{ $sum }}</span>
												</li>
												@endfor
										</ul>
									</div>
								</div>
								<!-- /Rating -->

								<!-- Reviews -->
								<div class="col-md-6">
									<div id="reviews">
										<ul class="reviews">
											@foreach ($comment_ratings as $key=>$comment_rating)
											<li>
												<div class="review-heading">
													<h5 class="name">{{ $comment_rating->name }}</h5>
													<p class="date">{{ $comment_rating->pivot->created_at->format('Y-m-d') }}</p>
													<div class="review-rating">
														@for ($i=0;$i<5;$i++) @if ($i < $comment_rating->pivot->rating)
															<i class="fa fa-star"></i>
															@else
															<i class="fa fa-star-o empty"></i>
															@endif
															@endfor
													</div>
												</div>
												<div class="review-body">
													<p>{{ $comment_rating->pivot->content }}</p>
												</div>
											</li>
											@endforeach
										</ul>
										@if ($comment_ratings->total())
										<ul class="reviews-pagination">
											<li><a href="{{ $comment_ratings->url(1) }}"><i class="fa fa-angle-left"></i></a></li>
											@for ($i=1;$i<=$comment_ratings->lastPage();$i++)
												<li class="page-item @if ($comment_ratings->currentPage()===$i) {{ 'active' }} @endif)">
													<a class="page-link" href="{{ $comment_ratings->url($i) }}">{{ $i }}</a></li>
												@endfor
												<li><a href="{{ $comment_ratings->url($comment_ratings->lastPage()) }}"><i class="fa fa-angle-right"></i></a></li>
										</ul>
										@else
										<ul class="reviews text-center text-muted">
											<p>There are currently no product reviews.</p>
											<p>Let others know your opinion and become the first to comment on this product.</p>
										</ul>
										@endif
									</div>
								</div>
								<!-- /Reviews -->
								@auth
								<!-- Review Form -->
								<div class="col-md-3">
									<div id="review-form">
										<form class="review-form" method="POST" action="{{ route('comment_rating',$product->id) }}">
											{{ csrf_field() }}
											{{ method_field("PUT") }}
											<textarea class="input" placeholder="Your Review" name="comment" id="txtComment"></textarea>
											<div class="input-rating">
												<span>Your Rating: </span>
												<div class="stars">
													<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
													<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
													<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
													<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
													<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
												</div>
											</div>
											<button class="primary-btn" type="submit" id="commentRating">Submit</button>
										</form>
									</div>
								</div>
								<!-- /Review Form -->
								@endauth
							</div>
						</div>
						<!-- /tab3  -->
					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<hr width="90%">
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title text-center">
					<h3 class="title">Related Products</h3>
				</div>
			</div>

			@foreach ($related_products as $related_product)
			<!-- product -->
			<div class="col-md-3 col-xs-6">
				<div class="product">
					<a href="{{ route('product',$related_product->id) }}">
						<div class="product-img">
							<img src="{{ asset($related_product->picture) }}" alt="{{ $related_product->name }}">
							<div class="product-label">
								@if ($related_product->sale)
								<span class="sale">-{{ $related_product->sale }}%</span>
								@endif
								@if ($related_product->sale)
								<span class="new">NEW</span>
								@endif
							</div>
						</div>
					</a>
					<div class="product-body">
						<p class="product-category">{{ $related_product->category->name }}</p>
						<h3 class="product-name"><a href="#">{{ $related_product->name }}</a></h3>
						<h4 class="product-price">{{
							$related_product->price-$related_product->price*$related_product->sale/100 }} </h4>
						@if ($related_product->sale)
						<del class="product-old-price">{{ $related_product->price }}</del>
						@else
						<br />
						@endif
						<div class="product-rating">
							@for ($i = 0; $i < $related_product->rating; $i++)
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
						<a href="{{route('addToCart',$related_product->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i>
								add to cart</button></a>
					</div>
				</div>
			</div>
			<!-- /product -->
			@endforeach

		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /Section -->
@endsection