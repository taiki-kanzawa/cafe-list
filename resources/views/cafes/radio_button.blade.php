<?php
    $facilities = ['wifi' => 'Wi-Fi', 'electrical_outlet' => 'コンセント', 'smoking_seat' => '喫煙席', 'parking' => '駐車場'];
?>

@foreach ($facilities as $facility => $label)
    <div class="row radio-btn">
        <div class="col-sm-4">
            {!! Form::label($facility, $label . ' :') !!}
        </div>
        <div class="col-sm-4">
            {!! Form::radio($facility, 'あり') !!} あり
        </div>
        <div class="col-sm-4">
            {!! Form::radio($facility, 'なし') !!} なし
        </div>
    </div>
@endforeach