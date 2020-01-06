<header class="mb-4">
    <nav class="navbar navbar-expand navbar-dark" style="background-color:#7b5544">
        <div class="container">
            <a class="navbar-brand" href="/">Cafelist</a>
            <div class="navbar-nav mr-auto"></div>
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">ゲスト</a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item"><a href="#">ログイン</a></li>
                        <li class="dropdown-item">{!! link_to_route('signup.get', 'アカウント登録', [], ['class' => '']) !!}</li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>