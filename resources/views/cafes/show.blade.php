@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-6">
            <h2 class="cafe-name">{{ $cafe->cafe_name }}</h2>
        </div>
        <div class="col-6">
            <p>投稿者 :</p>
            <div class="col-6">
                <img src="{{ Storage::disk('s3')->url($cafe->user->icon) }}" alt="{{ $cafe->user->icon }}">
            </div>
            <div class="col-6">
                {!! link_to_route('users.show', $cafe->user->name, ['id' => $cafe->user->id]) !!}
            </div>
        </div>
    </div>
    
    <!-- Bootstrapのカルーセル -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($cafe->cafe_images as $key => $image)
                @if ($key == 0)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="active"></li>
                @else
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}"></li>
                @endif
            @endforeach
        </ol>
        <div class="carousel-inner">
            @foreach ($cafe->cafe_images as $key => $image)
                @if ($key == 0)
                    <div class="carousel-item active">
                        <img src="{{ Storage::disk('s3')->url($image->image) }}" class="d-block w-100" alt="{{ $image->image }}">
                    </div>
                @else
                    <div class="carousel-item">
                        <img src="{{ Storage::disk('s3')->url($image->image) }}" class="d-block w-100" alt="{{ $image->image }}">
                    </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    
    <div class="row">
        <div class="col-4">
            <h3>住所 :</h3>
        </div>
        <div class="col-8">
            <p>{{ $cafe->address }}</p>
            
            <!-- ここにGoogle Maps APIのコードを記述 -->
            
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <h3>設備 :</h3>
        </div>
        <div class="col-8">
            <table class="table table-bordered">
                <tr>
                    <th>Wi-Fi</th>
                    <td>{{ $cafe->wifi }}</td>
                </tr>
                <tr>
                    <th>コンセント</th>
                    <td>{{ $cafe->electrical_outlet }}</td>
                </tr>
                <tr>
                    <th>喫煙席</th>
                    <td>{{ $cafe->smoking_seat }}</td>
                </tr>
                <tr>
                    <th>駐車場</th>
                    <td>{{ $cafe->parking }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <h3>食事メニュー :</h3>
        </div>
        <div class="col-8">
            <p>{{ $cafe->meal_menu }}</p>
        </div>
    </div>
    
    <!-- ここに編集ページへのリンクを記述 -->
    
    <!-- ここにお気に入りボタンのコードを記述 -->
    
    <div class="text-center">
        {!! link_to_route('cafes.index', 'トップページへ戻る') !!}
    </div>
@endsection