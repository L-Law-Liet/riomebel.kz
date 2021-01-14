@isset($seo->text)
    <div class="container">
        <p>
            {!!$seo->text??''!!}
        </p>
    </div>
@endisset
