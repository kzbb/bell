<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BELL</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <!-- BELL css -->
    <link href="{{ asset('css/bell.css') }}?<?php echo date('Ymd-Hi'); ?>" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('js/bell.js') }}?<?php echo date('Ymd-Hi'); ?>"></script>

</head>

<body class="container" style="color: rgb(60,60,60)">

<div class="d-flex align-items-end justify-content-center" style="height: 24rem">
    <div id="call-btn" class="btn-stand-by">
        <div class="h-100 d-flex align-items-center flex-column justify-content-center">
            <h1 style="color: rgba(100,180,200,0.4);text-shadow: 1px 1px 1px rgb(255,240,245), 0 0 rgb(200,210,215);">BELL</h1>

            <div class="d-flex align-items-start justify-content-center">
                @if (Route::has('login'))
                    <div class="row justify-content-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" style="text-decoration: none">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="col p-3" style="text-decoration: none">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="col p-3"
                                   style="text-decoration: none">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>


<div class="row mt-3">
    <div class="col"></div>
    <div class="col-auto">
        <h3 class="mb-3">使い方</h3>
        <ol>
            <li>管理画面で呼び鈴を作成します</li>
            <li>端末（スマホ）で、QRコードを読み取ると、ボタンが表示されます</li>
            <li>ボタンを押すと、呼び出し中として管理画面に表示されます</li>
            <li>再びボタンを押すと、呼び出し状態が解除されます</li>
        </ol>
    </div>
    <div class="col"></div>
</div>
<footer class="text-center"><a href="https://github.com/kzbb/bell" style="text-decoration: none">GitHub</a></footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

</body>
</html>
