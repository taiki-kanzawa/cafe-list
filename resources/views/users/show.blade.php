@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h2>プロフィール</h2>
    </div>
    <div class="profile border-bottom">
        @if (!empty($user->icon))
            <div class="show-icon">
                <img src="/storage/users_icon/{{ $user->icon }}" alt="{{ $user->icon }}">
            </div>
        @else
            <div class="no-icon">画像なし</div>
        @endif
        <div class="show-name">{{ $user->name }}</div>
        <div class="show-content">
            <p>{!! nl2br(e($user->content)) !!}</p>
        </div>
        <div class="edit-link">
            {!! link_to_route('users.edit', 'プロフィールの編集', ['id' => $user->id]) !!}
        </div>
    </div>
    <ul class="nav nav-tabs nav-justified mb-3">
        <li class="nav-item"><a  href="#" class="nav-link　active">投稿リスト</a></li>
        <li class="nav-item"><a  href="#" class="nav-link">お気に入りリスト</a></li>
    </ul>
@endsection