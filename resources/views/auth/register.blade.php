@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h1>アカウント作成</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 mb-5">
    
                {!! Form::open(['route' => 'signup.post']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'ユーザー名') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'パスワード確認') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>
    
                    {!! Form::submit('作成', ['class' => 'btn btn-success btn-block']) !!}
                {!! Form::close() !!}
            </div>
            <div class="text-center col-sm-12 cancel">
                {!! link_to_route('cafes.index', 'キャンセル') !!}
            </div>
        </div>
    </div>
@endsection