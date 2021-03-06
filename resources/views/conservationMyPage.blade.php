@extends('layouts.base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/conservationMyPageStyle.css') }}">
@endsection

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ route('home') }}">HOME</a></li>
    <li>保護活動者マイページTOP</li>
</ul>



<!--content-->
<main-content>

    <!-----side----->
    <aside>
        <nav class="sideBox">
            <div class="menu-title">メニュー</div>
            <ul>
                <li><a href="{{ route('myPage') }}">マイページTOP</a></li>
                <li><a href="{{ route('articleList') }}">登録ペット一覧</a></li>
                <li><a href="{{ route('article') }}">ペット新規登録</a></li>
                <li><a href="{{ route('message') }}">里親希望者からの<br>メッセージ</a></li>
                <li><a href="{{ route('questionnaire') }}">プロフィール<br>登録・変更</a></li>
            </ul>
    </aside>

    <!--main content-->
    <div class="MP-main">
        <h1>～ようこそ {{ $user['kanjiFamilyName'] }}
            {{ $user['kanjiFirstName'] }} 様～</h1>
        <p class="article">里親希望者とのやり取りや記事の掲載ページ情報に保護活動者様の情報を提供していただきます。</p>
        <p class="article">以下のリンクからプロ―フィールの登録をお願いいたします。</p>
        <h2>必ず募集記事を投稿される前にご回答ください。</h2>
        <br>
        <div class="linkbtn">
            <a href="{{ route('questionnaire') }}">アンケートの登録・変更ページへ向かう</a>
        </div>

        <br>
        <br>
        <br>
        <p class="article">ご質問・わからないことがございましたら、</p>
        <p class="article">▼こちらからご確認ください。</p>
        <br>

        <div class="linkbtn">
            <a href="{{ route('faq') }}">よくある質問</a>
        </div>

        <br>
        <br>
        <br>
        <p class="article">他の機能につきましては、左の【メニュー】一覧からご確認ください。</p>
        <br>
        <br>
        <br>

        <h2 class="notice">メッセージ</h2><br>
    
        <br>
        <div class="linkbtn">
            <a href="{{ route('message') }}">里親希望者からのメッセージ一覧 ページへ向かう</a>
        </div>
        <br>
        <br>
        <br>
        <br>

        <div class="linkbtn">
            <a href="{{ route('articleList') }}">登録ペット一覧 ページへ向かう</a>
        </div>

    </div>

</main-content>
@endsection
