<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background: #8591b5;
            font-family: 'Rubik', sans-serif;
        }

        .login-form {
            background: #fff;
            width: 500px;
            margin: 65px auto;
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            border-radius: 4px;
            box-shadow: 0 2px 25px rgba(0, 0, 0, 0.2);
        }

        .login-form h1 {
            padding: 35px 35px 0 35px;
            font-weight: 300;
        }

        .login-form .content {
            padding: 35px;
            text-align: center;
        }

        .login-form .input-field {
            padding: 12px 5px;
        }

        .login-form .input-field input {
            font-size: 16px;
            display: block;
            font-family: 'Rubik', sans-serif;
            width: 100%;
            padding: 10px 1px;
            border: 0;
            border-bottom: 1px solid #747474;
            outline: none;
            -webkit-transition: all .2s;
            transition: all .2s;
        }

        .login-form .input-field input::-webkit-input-placeholder {
            text-transform: uppercase;
        }

        .login-form .input-field input::-moz-placeholder {
            text-transform: uppercase;
        }

        .login-form .input-field input:-ms-input-placeholder {
            text-transform: uppercase;
        }

        .login-form .input-field input::-ms-input-placeholder {
            text-transform: uppercase;
        }

        .login-form .input-field input::placeholder {
            text-transform: uppercase;
        }

        .login-form .input-field input:focus {
            border-color: #222;
        }

        .login-form a.link {
            text-decoration: none;
            color: #747474;
            letter-spacing: 0.2px;
            text-transform: uppercase;
            display: inline-block;
            margin-top: 20px;
        }

        .login-form .action {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            flex-direction: row;
        }

        .login-form .action button {
            width: 100%;
            border: none;
            padding: 18px;
            font-family: 'Rubik', sans-serif;
            cursor: pointer;
            text-transform: uppercase;
            background: #e8e9ec;
            color: #777;
            border-bottom-left-radius: 4px;
            border-bottom-right-radius: 0;
            letter-spacing: 0.2px;
            outline: 0;
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .login-form .action button:hover {
            background: #d8d8d8;
        }

        .login-form .action button:nth-child(1) {
            background: #2d3b55;
            color: #fff;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 4px;
        }

        .login-form .action button:nth-child(1):hover {
            background: #3c4d6d;
        }
    </style>
</head>

<body>

    <div class="login-form">
        <form action="{{ route('prosesLogin') }}" method="post">
            @csrf
            <center style="margin-top: 10px">
                <img src="{{ asset('assets') }}/img/logo.jpg" width="50%" alt="">
            </center>

            <h3 style="text-align: center">KOPERASI HARUM MANIS</h3>
            <h1 style="text-align: center">Login</h1>
            <div class="content">
                @if (Session::get('error'))
                    <p style="color:red; font-style: italic">Username / Password salah ! </p>
                @endif
                <div class="input-field">
                    <input type="text" placeholder="Username" name="username" autofocus autocomplete="nope">
                </div>
                <div class="input-field">
                    <input type="password" placeholder="Password" name="password" autocomplete="new-password">
                </div>

            </div>
            <div class="action">

                <button type="submit">Sign in</button>
            </div>
        </form>
    </div>

    <div style="margin: 14px 15px">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"
            type="2e91b3b8b3ff50258cd1ea43-text/javascript"></script>

        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-7089100907045419"
            data-ad-slot="8749784419" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script type="2e91b3b8b3ff50258cd1ea43-text/javascript">
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </div>
    <script src="./script.js" type="2e91b3b8b3ff50258cd1ea43-text/javascript"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-80520768-2"
        type="2e91b3b8b3ff50258cd1ea43-text/javascript"></script>
    <script type="2e91b3b8b3ff50258cd1ea43-text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-80520768-2');
    </script>

    <script src="/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js"
        data-cf-settings="2e91b3b8b3ff50258cd1ea43-|49" defer=""></script>
</body>

</html>
