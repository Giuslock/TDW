@extends('layouts.master')

@section('title', 'Cart')

@section('content')

	@if($products->count())
		<div class="shopping-cart section">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<!-- Shopping Summery -->
						<table class="table shopping-summery">
							<thead>
								<tr class="main-hading">
									<th>PRODUCT</th>
									<th>NAME</th>
									<th class="text-center">UNIT PRICE</th>
									<th class="text-center">QUANTITY</th>
									<th class="text-center">TOTAL</th>
									<th class="text-center"><i class="ti-trash remove-icon" style="color: white"></i></th>
								</tr>
							</thead>
							<tbody>
								@foreach($products as $product)
								<tr>
									<td class="image" data-title="No"><img src="{{ $product->getFirstMediaUrl() }}" alt="#"></td>
									<td class="product-des" data-title="Description">
										<p class="product-name"><a href="/products/{{ $product->id }}">{{ $product->name }}</a></p>
										<p class="product-des">{{ $product->description }}</p>
									</td>
									<td class="price" data-title="Price"><span>{{ $product->price }}€ </span></td>

									<td class="qty" data-title="Qty">
										<div class="input-group">


											<form action="{{ route('carts.products.update', ['cart' => Auth::user()->cart->id, 'product' => $product->id]) }}" method="POST">
												@csrf
												@method('PUT')
												<div class="button minus">

														<input hidden type="text" value="1" class="btn btn-primary btn-number" name="minus">

														<button class="btn btn-primary btn-number" type="submit">
															<i class="ti-minus"></i>
														</button>
												</div>
											</form>


											<input type="text" name="quantity" class="input-number"  data-min="1" data-max="100" value="{{ $product->pivot->quantity }}">

											<form action="{{ route('carts.products.update', ['cart' => Auth::user()->cart->id, 'product' => $product->id]) }}" method="post">
												@csrf
												@method('PUT')
												<div class="button plus">

													<input hidden type="text" value="1" class="btn btn-primary btn-number" name="plus">

													<button class="btn btn-primary btn-number" type="submit">
														<i class="ti-plus"></i>
													</button>

												</div>

											</form>

										</div>
									</td>


									<td class="total-amount" data-title="Total"><span>{{ $product->pivot->quantity * $product->price }}€</span></td>

									<td class="action" data-title="Remove">
										<form action= "{{ route('carts.products.destroy', ['cart'=>Auth::user()->cart->id,'product'=>$product->id]) }}" method="POST">

											@csrf
											@method('DELETE')
											<button class="btn" style="background-color:#f7941d">
												<i class="ti-trash remove-icon" style="color: white" ></i>
											</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<!--/ End Shopping Summery -->
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<!-- Total Amount -->
						<div class="total-amount">
							<div class="row">

								<div class="col-lg-8 col-md-5 col-12">
									<div class="left">
										<div class="coupon">

										</div>
									</div>
								</div>

									<div class="col-lg-4 col-md-7 col-12">
										<div class="right">
											<ul>
												<li>Cart Subtotal<span>{{ $total }}€</span></li>
												@if($total > 100)
													<li>Shipping<span>Free</span></li>
													<li class="last">You Pay<span>{{ $total }}€</span></li>
												@else
													<li>Shipping<span>10</span></li>
													<li class="last">You Pay<span>{{ $total + 10 }}€</span></li>
												@endif
											</ul>
											<div class="button5">
												<a href="/checkout" class="btn">Checkout</a>
												<a href="/" class="btn">Continue shopping</a>
											</div>
										</div>
									</div>

							</div>

						</div>

						<!--/ End Total Amount -->
					</div>
				</div>
			</div>
		</div>

	@else

		<div class="row">
			<div class="col-12" style="height: 400px; display:flex; align-items: center; justify-content:center; flex-direction: column;">
				<p style="margin-bottom: 50px">You cart is empty</p>
				<a class="btn" href="{{ route('home.index') }}" style="color: white">
					Buy something
				</a>
			</div>

		</div>
	@endif

@endsection
