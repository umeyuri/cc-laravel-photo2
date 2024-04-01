<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        .header_nav {
            display: flex;
            list-style: none;
            padding-left: 0;
        }
        .header_nav li {
            margin-right: 30px;
        }
        .error {
            color: red;
        }
        .success {
            color: green;
        }
        .delete {
            display: inline;
        }
        .post {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    @yield('header')
    
    @foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    @endforeach

    @if (session()->has('success'))
        <p class="success">{{ session()->get('success')}}</p>
    @endif

    @yield('content')
    {{-- <header></header>
    <main></main>
    <footer></footer> --}}
</body>
</html>