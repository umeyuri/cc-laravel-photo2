<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <style>
        .inside{
            text-decoration:none;
            color:rgba(0, 0, 0, 1);
        }

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
        .post_body {
            width: 200px;
        }
        .post_body_img {
            /* border: solid 0.5px #777777;
            border-radius: 20px; */
            height: 100%;
        }
        .post_body_img img{
            width: 100%;
            /* height: 100%; */
            border: solid 0.1px #777777;
            border-radius: 20px;
        }
        .container {
            display: grid;
            width: 800px;
            height: 300px;
            grid-template-columns:  1fr 1fr 1fr 1fr;
            grid-template-rows: 1fr 1fr 1fr 1fr;
            gap: 10px 20px;
        }
/* 投稿一覧 */
    img {
        display: block;
        max-width: 100%;
        max-height: 100%;
        width: 100%;
        border-radius: 10px;
      }

      @media screen and (max-device-width: 320px) {
        .grid {
          column-count: 1;
          column-gap: 1rem;
        }
      }

      @media screen and (min-device-width: 321px) and (max-device-width: 768px) {
        .grid {
          column-count: 2;
          column-gap: 1rem;
        }
      }

      @media screen and (min-device-width: 769px) and (max-device-width: 1024px) {
        .grid {
          column-count: 3;
          column-gap: 1rem;
        }
      }

      @media screen and (min-width: 1025px) {
        .grid {
          column-count: 4;
          column-gap: 1rem;
        }
      }
      .grid-item {
        position: relative;
        height: 100%;
        width: 100%;
        margin-bottom: 1rem;
      }
      .grid-item:hover .overlay {
        opacity: 1;
        cursor: pointer;
      }
      .grid-item:hover .save {
        opacity: 1;
        cursor: pointer;
      }
      .grid-item:hover .link {
        opacity: 1;
        cursor: pointer;
      }
      .grid-item:hover .link input{
        opacity: 1;
        cursor: pointer;
      }
      .grid-item:hover .share {
        opacity: 1;
        cursor: pointer;
      }
      .grid-item:hover .menu {
        opacity: 1;
        cursor: pointer;
      }
      .save {
        position: absolute;
        z-index: 2;
        top: 0.5rem;
        right: 0.5rem;
        height: 1rem;
        width: 3rem;
        opacity: 0;
        background-color: rgba(255, 255, 255, 0.829);
        padding: 1rem;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .link {
        position: absolute;
        z-index: 2;
        bottom: 0.5rem;
        left: 0.5rem;
        height: 0.3rem;
        width: 1.5rem;
        opacity: 0;
        background-color: rgba(255, 255, 255, 0.929);
        padding: 1rem;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .link input {
        border: none;
        opacity: 0;
        background-color: rgba(255, 255, 250, 0.129);
      }
      .link form {
        background-color: rgba(255, 255, 250, 0.129);
      }
      .share {
        position: absolute;
        z-index: 2;
        bottom: 0.5rem;
        right: 0.5rem;
        height: 1rem;
        width: 4rem;
        opacity: 0;
        background-color: rgba(255, 255, 255, 0.829);
        padding: 1rem;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .menu {
        position: absolute;
        z-index: 2;
        bottom: 0.5rem;
        right: 0.5rem;
        height: 1rem;
        width: 2rem;
        opacity: 0;
        background-color: rgba(255, 255, 255, 0.829);
        padding: 1rem;
        border-radius: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .overlay {
        position: absolute;
        z-index: 1;
        top:0;
        left:0;
        opacity: 0;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
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