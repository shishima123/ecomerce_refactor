@extends('templates.frontend.master')
@section('title','Electro - Home Page')
@section('content')
@include('templates.Admin.flash_message')
<!-- NEW PRODUCT -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">NEW PRODUCTS</h3>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-1">
                                @foreach ($new_products as $new_product)
                                <div class="product">
                                    <a href="{{ route('product',$new_product->id) }}"><div class="product-img">
                                        <img src="{{ asset($new_product->picture) }}" alt="">
                                        <div class="product-label">
                                            @if ($new_product->sale)
                                            <span class="sale">-{{ $new_product->sale }}%</span>
                                            @endif
                                            @if ($new_product->new)
                                            <span class="new">NEW</span>
                                            @endif
                                        </div>
                                    </div></a>

                                    <div class="product-body">
                                        <p class="product-category">{{ $new_product->category->name }}</p>
                                        <h3 class="product-name"><a href="#">{{ $new_product->name }}</a></h3>
                                        <h4 class="product-price">{{
                                            $new_product->price-$new_product->price*$new_product->sale/100 }}$ </h4>
                                        @if ($new_product->sale)
                                        <del class="product-old-price">{{ $new_product->price }}$</del>
                                        @else
                                        <br />
                                        @endif
                                        <div class="product-rating">
                                            @for ($i = 0; $i < $new_product->rating; $i++)
                                                <i class="fa fa-star"></i>
                                                @endfor
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                                    to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
                                                    to compare</span></button>
                                            <button class="quick-view"><a href="{{route('product',$new_product->id)}}"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                    view</span></a></button>
                                        </div>
                                    </div>

                                    <div class="add-to-cart">
                                        <a href="{{route('addToCart',$new_product->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endforeach
                                <!-- product -->
                            </div>
                            <div id="slick-nav-1" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /NEW PRODUCT -->

<!-- TOP SELLING -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">TOP SELLING</h3>
                </div>
            </div>
            <!-- Products tab & slick -->
            <div class="col-md-12">
                <div class="row">
                    <div class="products-tabs">
                        <!-- tab -->
                        <div id="tab2" class="tab-pane fade in active">
                            <div class="products-slick" data-nav="#slick-nav-2">
                                @foreach ($top_selling as $top_selling)
                                <div class="product">
                                    <a href="{{ route('product',$new_product->id) }}"><div class="product-img">
                                        <img src="{{ asset($top_selling->picture) }}" alt="">
                                        <div class="product-label">
                                            @if ($top_selling->sale)
                                            <span class="sale">-{{ $top_selling->sale }}%</span>
                                            @endif
                                            @if ($top_selling->new)
                                            <span class="new">NEW</span>
                                            @endif
                                        </div>
                                    </div></a>

                                    <div class="product-body">
                                        <p class="product-category">{{ $top_selling->category->name }}</p>
                                        <h3 class="product-name"><a href="#">{{ $top_selling->name }}</a></h3>
                                        <h4 class="product-price">{{
                                            $top_selling->price-$top_selling->price*$top_selling->sale/100 }}$ </h4>
                                        @if ($top_selling->sale)
                                        <del class="product-old-price">{{ $top_selling->price }}$</del>
                                        @else
                                        <br />
                                        @endif
                                        <div class="product-rating">
                                            @for ($i = 0; $i < $top_selling->rating; $i++)
                                                <i class="fa fa-star"></i>
                                                @endfor
                                        </div>
                                        <div class="product-btns">
                                            <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add
                                                    to wishlist</span></button>
                                            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add
                                                    to compare</span></button>
                                            <button class="quick-view"><a href="{{route('product',$top_selling->id)}}"><i class="fa fa-eye"></i><span class="tooltipp">quick
                                                    view</span></a></button>
                                        </div>
                                    </div>
                                    <div class="add-to-cart">
                                        <a href="{{route('addToCart',$top_selling->id)}}"><button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button></a>
                                    </div>
                                </div>
                                <!-- /product -->
                                @endforeach
                                <!-- product -->
                            </div>
                            <div id="slick-nav-2" class="products-slick-nav"></div>
                        </div>
                        <!-- /tab -->
                    </div>
                </div>
            </div>
            <!-- /Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /TOP SELLING -->
@endsection