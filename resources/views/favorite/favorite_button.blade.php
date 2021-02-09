@if (Auth::check())
    @if (Auth::user()->is_favorite($cafe->id))
        <div class="already-a-favorite">
            <button class="btn btn-light btn-sm" disabled>お気に入り済み</button>
        </div>
    @else
        {!! Form::open(['route' => ['favorites.favorite', $cafe->id], 'class' => "favorite-button"]) !!}
            {!! Form::button('<i class="fas fa-star"></i>　お気に入り', ['class' => "btn btn-outline-warning btn-sm", 'type' => 'submit']) !!}
        {!! Form::close() !!}
    @endif
@endif