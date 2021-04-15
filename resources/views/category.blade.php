@extends('layouts.app')
@push('seo_head')
    <title>{{$seo->title ?? "Купить ".(($title) ? $title : '')." в Алматы и Усть-Каменогорске цена, доставка | RioMebel.kz"}}</title>
    <meta name="description" content="{{ $seo->description ?? (($title) ? $title : '')." по лучшей цене ✈️ Быстрая доставка по Алматы и Усть-Каменогорску ➤ Гарантия качества. Интернет-магазин мебели №1 в Алматы и Усть-Каменогорске ✓ Звоните ☎: +7 705 722 0547" }}">
{{--    <meta name="keywords" content="{{$seo->keywords??setting('site.keyword') }}">--}}
@endpush
@section('content')
	<div class="container">
		@include('partials.breadcrumbs' , ['name' => $title , 'ancestors' => $ancestors??[]])
		<div class="row">
			<div class="col-12">
				@include('partials.tab_mobile_category')
			</div>
			<div class="col-12 col-sm-12 col-md-2">
				@include('partials.filter_collapse')
			</div>
			<div class="col-12 col-sm-12 col-md-10">
				@include('partials.filter')
                <div id="Resp">
                    @include('products')
                </div>
			</div>
		</div>
	</div>
@endsection
@section('after_jquery')
    <script type="text/javascript" src="{{ asset('js/rio/ajax.js') }}"></script>
@endsection
