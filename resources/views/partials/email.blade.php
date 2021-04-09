<p>Имя: {{ $data['name'] }}</p>
<p>Телефон: {{ $data['phone'] }}</p>
@if($data['file']??'')
<p>Фотка: <br>
	<img alt="photo" src="{{ $message->embed(storage_path($data['file'])) }}">
</p>
    @endif
