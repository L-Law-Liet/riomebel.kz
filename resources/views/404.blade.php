@extends('layouts.app')
@section('content')
	<div class="success_wrap">
		<div class="content error">
			<img src="/images/icons/404.svg" alt="error">
			<span class="title">Упс... А такой страницы у нас нет!</span>
			<a href="{{route('welcome')}}" class="btn-main">Вернуться на главную</a>
		</div>
	</div>
@endsection
