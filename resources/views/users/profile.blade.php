<div class="text-center mt-5 mb-5">
    <h2>プロフィール</h2>
</div>
<section>
    <div class="profile">
        @if (!empty($user->icon))
            <div class="show-icon">
                <img src="{{ Storage::disk('s3')->url($user->icon) }}" alt="{{ $user->icon }}">
            </div>
        @else
            <div class="no-icon">No images</div>
        @endif
        
        <div class="show-name">{{ $user->name }}</div>
        
        @if (!empty($user->content))
            <div class="show-content">
                <p>{!! nl2br(e($user->content)) !!}</p>
            </div>
        @endif
        
        @if (Auth::id() == $user->id)
            <div class="edit-link mb-5">
                {!! link_to_route('users.edit', 'プロフィールの編集', ['id' => $user->id]) !!}
            </div>
        @endif
    </div>
</section>