@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h2>プロフィール編集</h2>
    </div>
    <div class="container">
        <div class="row">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'col-sm-12', 'files' => 'true']) !!}
                <div class="form-group row">
                    <div class="col-sm-2 offset-sm-1 text-center">
                        {!! Form::label('icon', 'アイコン :') !!}
                    </div>
                    <div class="col-sm-7">
                        {!! Form::file('icon') !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 offset-sm-1 text-center">
                        {!! Form::label('name', 'ユーザー名 :') !!}
                    </div>
                    <div class="col-sm-7">
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 offset-sm-1 text-center">
                        {!! Form::label('content', '自己紹介 :') !!}
                    </div>
                    <div class="col-sm-7">
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '7']) !!} 
                    </div>
                </div>
                <div class="col-sm-6 offset-sm-3">
                    <div class="text-center">
                        {!! Form::submit('更新', ['class' => 'btn btn-success btn-block']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="text-center mt-5 cancel">
        {!! link_to_route('users.show', 'キャンセル', ['id' => Auth::id()]) !!}
    </div>
@endsection