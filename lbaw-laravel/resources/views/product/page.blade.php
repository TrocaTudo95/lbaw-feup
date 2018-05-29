@extends('layouts.app')

@section('content')
<ol class="p_breadcrumb breadcrumb">
    <li class="breadcrumb-item h6"><a href="/">Home</a></li>
    <li class="breadcrumb-item h6"><a href="catalog.html">Catalog</a></li>
    <li class="breadcrumb-item active h6">{{$product->name}}</li>
</ol>
<hr>

<div class="product-section">
	<div class="container-fluid product-page product" data-id="{{ $product->id }}">

	<div class="row">
		<div class="col-md-6 text-center">
			<img class="product-image" alt="product preview" src="/images/products/{{$product->pic}}" />

		<div class="row">
			<div class="col-md-12">
			<div class="rating-block">
				<h2 class="bold padding-bottom-7">{{round($product->score,2)}} <small>/ 5</small></h2>
				<button type="button" class="btn btn-primary btn-sm" aria-label="Left Align" disabled>
					<i class="fa fa-star"></i>
				</button>
				<button type="button" class="btn btn-primary btn-sm" aria-label="Left Align" disabled>
					<i class="fa fa-star"></i>
				</button>
				<button type="button" class="btn btn-primary btn-sm" data-id="{{ $product->id }}"aria-label="Left Align" disabled>
					<i class="fa fa-star"></i>
				</button>
				<button type="button" class="btn btn-primary btn-sm" data-id="{{ $product->id }}"ia-label="Left Align" disabled>
					<i class="fa fa-star"></i>
				</button>
				<button type="button" class="btn btn-dark btn-grey btn-sm" data-id="{{ $product->id }}" aria-label="Left Align" disabled>
					<i class="fa fa-star"></i>
				</button>
			</div>
			</div>
		</div>
		</div>
		<div class="col-md-6" id="description-box">
			<h4 class="text" id="product-name-details">{{$product->name}}</h4>
			<h3 class="text-success" id="price-tag">{{$product->price}} €</h3>

			<div class="row">
				<div class="col-md-11 product-specs">

					<div class="product-buttons" >

						@if(Auth::check())
								@if(Auth::user()->permissions == 'User')
								<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#buttons-modal">
									<i class="fa fa-shopping-cart"></i> Add to Cart
								</button>
								@if($product->favorited())
								<button id="fav" type="button" class="btn btn-outline-danger" value="remove">
									<i class="fa fa-trash"></i> Remove from Wishlist
								</button>
								@else
								<button id="fav" type="button" class="btn btn-outline-danger" value="add">
									<i class="fa fa-heart"></i> Add to Wishlist
								</button>
								@endif
								@endif



								@if(Auth::user()->permissions == 'Admin')
                                <form id="editProdutForm" action="{{route('editProduct', ['id' =>$product->id])}}">
                                    <button id="editProdut" type="submit" value="Edit" class="btn btn-outline-info"><i class="fa fa-edit"></i> Edit</button>
                                </form>

								<button id="btnDeleteProduct" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
									<i class="fa fa-trash"></i> Remove
								</button>
								@endif
						@endif

						@if(!Auth::check())
						<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#buttons-modal">
							<i class="fa fa-shopping-cart"></i> Add to Cart
						</button>
						<button id="fav" type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#buttons-modal">
							<i class="fa fa-heart"></i> Add to Wishlist
						</button>
						@endif

					</div>

					<p><span class="description-tag">Stock  </span><span style="margin-left:5px;"class="text-editable"> {{ $product->stock }}</span></p>
					<p><span class="description-tag">Description</span></p>
					{{$product->description}}
				</div>
			</div>
        <br><br><br><br>

		</div>
	</div>
</div>

<div class="modal fade" id="buttons-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="modal-cart">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Access Denied</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                You need to Sign In in order to access to the cart and wishlist section.<br>
                If you don't have an account you should register yourself.
            </div>
            <div class="modal-footer" id="cart-footer">
			<form action="{{ route('register') }}">
			{{ csrf_field() }}
			{{ method_field('GET') }}
			<button class="btn btn-dark" type="submit" style="padding-right=5em; padding-left=5em;"> Sign Up </button>
			</form>
            <button type="button" class="btn btn-success" data-dismiss="modal" style="padding-right=5em; padding-left=5em;"> OK </button>
            </div>
        </div>
        </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
			<div class="modal-header">
			  <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			<div class="modal-body">
				<p>
					Are you sure you want to delete?
				</p>
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			  <button type="button" class="btn btn-danger">Delete</button>
			</div>
		  </div>
		</div>
</div>

@include('product.reviews')
@endsection
