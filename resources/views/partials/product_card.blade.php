@php
$wish_list = app('wishlist')->getContent();
$fav = true;
foreach ($wish_list as $item){
  if( $item->id == $product->id ){
    $fav = false;
    }
}

$carts = \Cart::getContent();
$in_box = true;
foreach ($carts as $item){
  if( $item->id == $product->id ){
    $in_box = false;
    }
}
@endphp


 <div class="product_item" style="height: 425px">
    @if ($product->discount != null)
        <div class="sale">
            {{$product->discount}} %
        </div>
    @endif
    @if ($fav)
    <button
        product-id="{{ $product->id }}"
        qty="1"
        class="favorite add-wishlist el-clickable">
    </button>
    @else
     <button
        product-id="{{ $product->id }}"
        qty="1"
        class="favorite remove-wishlist active el-clickable">
    </button>
    @endif
    <button class="zoom btn-modal-product" product-id="{{ $product->id }}" >
        <img alt="search" src="{{asset('images/icons/search_white.svg')}}">
    </button>
    <a href="{{url('product', $product->slug)}}" class="img">
        <img class="lazy horizContainer" alt="{{$product->name}}"
             src="@if($product->resized_image){{asset('storage/'.$product->resized_image)}}@else/images/default.jpg @endif">
    </a>
    <a href="{{url('product', $product->slug)}}">
        <h4 class="title">{{$product->name}}</h4>
    </a>
    <ul class="fact">
        <li><p>Производитель: {{$product->manufactor->name??'Не указано'}}</p> </li>
        <li><p>Коллекция: {{$product->collection??'Не указано'}}</p></li>
        <li><p>Размеры: {{$product->size->name??'Не указано'}}</p></li>
    </ul>
    <p class="has_product active">{{($product->quantity > 0)?'Есть':'Нет'}} в наличии</p>

    <div class="bottom">
        <div class="price_wrap">
           <h5 class="price">{{number_format($product->new_price, 0, "", " ")}}  тг.</h5>
			@if(!is_null($product->old_price) && $product->old_price != $product->new_price)
           <h5 class="old_price">{{ $product->old_price }} тг</h5>
			@endif
        </div>
        @if ($in_box)
        <button  class="btn-main box-btn add-cart el-clickable"
            product-id="{{ $product->id }}"
            qty="1">В корзину</button>
        @else
        <button class="btn-main box-btn remove-cart grey el-clickable"
            product-id="{{ $product->id }}"
            qty="1">В корзинe</button>
        @endif
        <button class="btn-main more btn-modal-product" product-id="{{ $product->id }}">Подробнее</button>
    </div>
</div>
