<ul class="nav nav-tabs nav-justified mb-3">
    <li class="nav-item"><a  href="{{ route('users.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/' . $user->id) ? 'active' : '' }}">投稿リスト <span class="badge badge-secondary">{{ $count_cafes }}</span></a></li>
    <li class="nav-item"><a  href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::is('users/*/favorites') ? 'active' : '' }}">お気に入りリスト <span class="badge badge-secondary">{{ $count_favorites }}</span></a></li>
</ul>