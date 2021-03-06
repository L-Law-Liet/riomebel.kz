	<p class="title">Ваша корзина</p>
	@if ($carts->count() > 0)
	<ul class="products">
		@foreach ($carts as $item)
		<li class="item">
			<div class="img">
				<img  alt="{{$item->name}}" src="@if($item->associatedModel->image) /storage/{{$item->associatedModel->image}} @else/images/default.jpg @endif">
			</div>
			<span class="text">
				<p class="name">
					{{$item->name}}
				</p>
				<p class="price">
					{{number_format($item->price, 0, "", " ")}} тг.
				</p>
			</span>
			<button class="delete remove-cart" product-id="{{ $item->id }}">
				<img alt="close" src="/images/icons/close.svg">
			</button>
		</li>
		@endforeach
	</ul>
	<div class="total">
		<p>Итог:</p>
		<p class="total-box">{{number_format(\Cart::getSubTotal(), 0, "", " ")}} тг.</p>
	</div>
	@else
        <p class="h3 text-muted text-center">
             Корзина пустая
        </p>
    @endif
    @if ($carts->count() > 0)
	<a href="{{ route('checkout') }}" class="btn-main">
		Оформить заказ
	</a>
	<a href="{{ route('box') }}" class="btn-main grey">
		Перейти в корзину
	</a>
	@endif
