@extends('layouts.app')

@section('content')
    <div class="container">
        
        <!-- 見出し -->
        <div class="text-center mt-5 mb-5">
            <h1>一覧</h1>
        </div>
        
        <!-- 検索フォーム -->
        <div class="form-group text-center mt-5 mb-5">
            {!! Form::open(['route' => 'cafes.index', 'method' => 'get', 'class' => 'input-group']) !!}
                {!! Form::text('keyword', old('keyword'), ['class' => 'form-control search-from']) !!}
                <div class="input-group-append">
                    {!! Form::submit('検索', ['class' => 'btn btn-success']) !!}
                </div>
            {!! Form::close() !!}
        </div>
        
        <!-- カフェを投稿するためのボタン -->
        <div class="text-center mb-5 pb-5 border-bottom">
            @if (Auth::check())
                {!! link_to_route('cafes.create', 'カフェを投稿', [], ['class' => 'btn btn-success col-3']) !!}
            @else
                {!! link_to_route('login', 'カフェを投稿', [], ['class' => 'btn btn-success col-3']) !!}
            @endif
        </div>
        
        <!-- カフェの一覧表示 -->
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
                        @if (Auth::id() != $cafe->user_id)
                            @include('favorite.favorite_button', ['cafe' => $cafe])
                        @endif
                    </div>
                </div>
            @endforeach
            
            <div class="pagination">
                {{ $cafes->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="text-center">
                <p class="search-not-found">検索条件に一致するカフェが見つかりませんでした</p>
            </div>
        @endif
        
    </div>
@endsection