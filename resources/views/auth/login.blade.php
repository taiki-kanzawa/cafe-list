@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h1>ログイン</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
    
                {!! Form::open(['route' => 'login.post']) !!}
                    <div class="form-group">
                        {!! Form::label('email', 'メールアドレス') !!}
                        {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                    </div>
    
                    <div class="form-group">
                        {!! Form::label('password', 'パスワード') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
    
                    {!! Form::submit('ログイン', ['class' => 'btn btn-success btn-block']) !!}
                {!! Form::close() !!}
    
                <div class="text-center mt-5 mb-5">
                    <p class="mt-2">{!! link_to_route('signup.get', 'アカウントをお持ちでない方はこちら') !!}</p>
                </div>
            </div>
        </div>
    </div>
@endsection