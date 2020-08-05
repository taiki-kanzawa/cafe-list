@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h2>カフェの投稿</h2>
    </div>
    <div class="row create-cafe">
        {!! Form::open(['route' => 'cafes.store', 'class' => 'col-sm-12', 'files' => 'true', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('cafe_name', '店名 :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::text('cafe_name', old('cafe_name'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('address', '住所 :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::text('address', old('address'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('wifi electrical_outlet smoking_seat parking', '設備 :') !!}
                </div>
                <div class="col-sm-7">
                    
                    @include('cafes.radio_button')
                    
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('meal_menu', '食事メニュー :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::select('meal_menu', ['' => '選択してください', 'あり' => 'あり', '軽食のみ' => '軽食のみ', 'なし' => 'なし']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('image', '画像ファイル（複数可）:') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::file('image[]', ['multiple' => 'true']) !!}
                </div>
            </div>
            <div class="text-center submit">
                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="text-center col-sm-12 cancel">
            {!! link_to_route('cafes.index', 'キャンセル') !!}
        </div>
    </div>
@endsection