@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="text-center mt-5 mb-5 pb-5 border-bottom">
            <h2 class="cafe-name">{{ $cafe->cafe_name }}</h2>
        </div>
    </div>
    
    <!-- Bootstrapのカルーセル -->
    <div class="karuseru">
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
                            <img src="{{ Storage::disk('s3')->url($image->image) }}" class="carousel-image" alt="{{ $image->image }}">
                        </div>
                    @else
                        <div class="carousel-item">
                            <img src="{{ Storage::disk('s3')->url($image->image) }}" class="carousel-image" alt="{{ $image->image }}">
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
    </div>
    
    <!-- カフェの詳細 -->
    <div class="container details">
        <div class="row">
            <div class="col-4 text-center">
                <p class="show-address">住所 :</p>
            </div>
            <div class="col-8">
                <p class="show-address">{{ $cafe->address }}</p>
            </div>
        </div>
        <div class="row facility">
            <div class="col-4 text-center">
                <p class="facility">設備 :</p>
            </div>
            <div class="col-6">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>
                            <span class="bg-info text-white facility">
                                <i class="fas fa-wifi"></i>
                            </span>
                            Wi-Fi
                        </th>
                        <td>{{ $cafe->wifi }}</td>
                    </tr>
                    <tr>
                        <th>
                            <span class="bg-warning text-white facility">
                                <i class="fas fa-plug"></i>
                            </span>
                            コンセント
                        </th>
                        <td>{{ $cafe->electrical_outlet }}</td>
                    </tr>
                    <tr>
                        <th>
                            <span class="bg-success text-white facility">
                                <i class="fas fa-smoking"></i>
                            </span>
                            喫煙席
                        </th>
                        <td>{{ $cafe->smoking_seat }}</td>
                    </tr>
                    <tr>
                        <th>
                            <span class="bg-primary text-white facility">
                                <i class="fas fa-parking"></i>
                            </span>
                            駐車場
                        </th>
                        <td>{{ $cafe->parking }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row meal-menu">
            <div class="col-4 text-center">
                <p class="meal-menu">食事メニュー :</p>
            </div>
            <div class="col-8">
                <p>{{ $cafe->meal_menu }}</p>
            </div>
        </div>
    </div>
    
    <div class="container contributor-area">
        <span class="contributor">
            <p>投稿者 :</p>
        </span>
        <span class="contributor-icon">
            @if (!empty($cafe->user->icon))
                <img src="{{ Storage::disk('s3')->url($cafe->user->icon) }}" alt="{{ $cafe->user->icon }}">
            @else
                <div class="contributor-no-icon">No images</div>
            @endif
        </span>
        <span class="contributor-name">
            {!! link_to_route('users.show', $cafe->user->name, ['id' => $cafe->user->id]) !!}
        </span>
    </div>
    
    @if (Auth::id() != $cafe->user_id)
        <div class="text-center">
            @include('favorite.favorite_button', ['cafe' => $cafe])
        </div>
    @endif
    
    <div class="text-center back-to-toppage">
        {!! link_to_route('cafes.index', 'トップページへ戻る') !!}
    </div>
@endsection