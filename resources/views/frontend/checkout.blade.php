@extends('templates.frontend.master')
@section('title','Checkout')
@section('content')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Checkout</h3>
				<ul class="breadcrumb-tree">
					<li><a href="{{ route('index') }}">Home</a></li>
					<li class="active">Checkout</li>
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
			<div class="col-md-2"></div>
			<!-- Order Details -->
			<form action="{{ route('postCheckout') }}" method="POST">
				{{ csrf_field() }}
				<div class="col-md-8 order-details center-block">
					<div class="section-title text-center">
						<h3 class="title">Your Order</h3>
					</div>
					<table class="table table-hover">
						<thead id="theadItemCart">
							<tr>
								<th><strong>PRODUCT</strong></th>
								<th><strong style="margin-left: 25px;">IMAGE</strong></th>
								<th></th>
								<th><strong>TOTAL</strong></th>
							</tr>
						</thead>
						<tbody id="tbodyItemCart">
							<?php $sum=0?>
							@foreach ($cart_detail->products as $item)
							<tr id="tr{{ $item->id }}">
								<td>{{ $item->pivot->qty }}x {{ $item->name }}</td>
								<td style="width:110px"><img src="{{ asset($item->picture) }}" style="width:100px"></td>
								<td>
									<div class="qty-label">
										Qty
										<div class="input-number" style="width:60px;margin-bottom: 17px;">
											<input type="number" id="qty" value="1" name="qty">
											<span class="qty-up">+</span>
											<span class="qty-down">-</span>
										</div>
										<button class="btn btn-danger delItemCart" id={{ $item->id }} type="button">Delete</button>
									</div>
								</td>
								@if ($item->sale)
								<td>
									<div>{{ $item->price - $item->price*$item->sale/100 }} <span>$</span>
									</div>
								</td>
								<?php $sum += (($item->price - $item->price*$item->sale/100)*$item->pivot->qty);?>
								@else
								<td>
									<div>{{ $item->price }} <span>$</span>
									</div>
								</td>
								<?php $sum += ($item->price*$item->pivot->qty);?>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
					<hr>
					<div class="order-summary">
						<div class="order-col">
							<div>Shiping</div>
							<div><strong>FREE</strong></div>
						</div>
						<div class="order-col">
							<h3>TOTAL</h3>
							<div><strong class="order-total" value="{{ $sum }}">{{ $sum }}</strong></div>
						</div>
					</div>
					<button type="submit" class="primary-btn order-submit btn-block">Order Now</button>
				</div>
			</form>
			<!-- /Order Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->
@endsection