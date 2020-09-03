@if (Auth::check())
    @if (Auth::user()->is_favorite($cafe->id))
        <button class="btn btn-light btn-sm" disabled>お気に入り済み</button>
    @else
        {!! Form::open(['route' => ['favorites.favorite', $cafe->id]]) !!}
            {!! Form::button('<i class="fas fa-star"></i>　お気に入り', ['class' => "btn btn-outline-warning btn-sm", 'type' => 'submit']) !!}
        {!! Form::close() !!}
    @endif
@endif