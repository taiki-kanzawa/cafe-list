@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h2>プロフィール編集</h2>
    </div>
    <div class="row">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'col-sm-12', 'files' => 'true']) !!}
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('icon', 'アイコン :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::file('icon') !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('name', 'ユーザー名 :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3 text-center">
                    {!! Form::label('content', '自己紹介 :') !!}
                </div>
                <div class="col-sm-7">
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '7']) !!} 
                </div>
            </div>
            <div class="text-center">
                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
    <div class="row">
        <div class="text-center col-sm-12">
        {!! link_to_route('users.show', 'キャンセル', ['id' => Auth::id()]) !!}
        </div>
    </div>
@endsection