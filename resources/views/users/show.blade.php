@extends('layouts.app')

@section('content')
    <div class="container">
        @include('users.profile', ['user' => $user])
        @include('users.navtabs', ['user' => $user])
        
        <!-- 投稿したカフェの一覧表示 -->
        @if (count($cafes) > 0)
            @foreach ($cafes as $cafe)
                <div class="row mb-5 pb-5 border-bottom">
                    <div class="col-lg-6 image-area">
                        <img src="{{ Storage::disk('s3')->url($cafe->first_image()->image) }}" alt="{{ $cafe->first_image()->image }}" class="image">
                    </div>
                    <div class="text-center col-lg-6 cafe-info">
                        {!! link_to_route('cafes.show', $cafe->cafe_name, ['id' => $cafe->id]) !!}
                        <p class="address">{{ $cafe->address }}</p>
                        @include('cafes.facility', ['cafe' => $cafe])
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection