@extends('layouts.app')

@section('content')
    <div class="text-center mt-5 mb-5">
        <h2>プロフィール</h2>
    </div>
    <section>
        <div class="profile border-bottom">
            @if (!empty($user->icon))
                <div class="show-icon">
                    <img src="{{ Storage::disk('s3')->url($user->icon) }}" alt="{{ $user->icon }}">
                </div>
            @else
                <div class="no-icon">No images</div>
            @endif
            <div class="show-name">{{ $user->name }}</div>
            <div class="show-content">
                <p>{!! nl2br(e($user->content)) !!}</p>
            </div>
            <div class="edit-link">
                {!! link_to_route('users.edit', 'プロフィールの編集', ['id' => $user->id]) !!}
            </div>
        </div>
    </section>
    <ul class="nav nav-tabs nav-justified mb-3">
        <li class="nav-item"><a  href="#" class="nav-link　active">投稿リスト</a></li>
        <li class="nav-item"><a  href="#" class="nav-link">お気に入りリスト</a></li>
    </ul>
@endsection