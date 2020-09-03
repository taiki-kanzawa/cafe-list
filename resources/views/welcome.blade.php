@extends('layouts.app')

@section('content')
    <!-- カフェを投稿するためのボタン -->
    <div class="row">
        <div class="text-center col-12">
            @if (Auth::check())
                {!! link_to_route('cafes.create', 'カフェを投稿', [], ['class' => 'btn btn-primary col-3']) !!}
            @else
                {!! link_to_route('login', 'カフェを投稿', [], ['class' => 'btn btn-primary col-3']) !!}
            @endif
        </div>
    </div>
    
    <!-- 見出し -->
    <div class="text-center mt-5 mb-5">
        <h2 class="pb-5 border-bottom">一覧</h2>
    </div>
    
    <!-- カフェの一覧表示 -->
    @if (count($cafes) > 0)
        @foreach ($cafes as $cafe)
            <div class="container">
                <div class="row mt-5 pb-5 border-bottom">
                    <div class="col-sm-6">
                        <img src="{{ Storage::disk('s3')->url($cafe->first_image()->image) }}" alt="{{ $cafe->first_image()->image }}" class="image">
                    </div>
                    <div class="text-center col-sm-6 cafe-info">
                        {!! link_to_route('cafes.show', $cafe->cafe_name, ['id' => $cafe->id]) !!}
                        <p class="address">{{ $cafe->address }}</p>
                        @if (Auth::id() != $cafe->user_id)
                            @include('favorite.favorite_button', ['cafe' => $cafe])
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
@endsection