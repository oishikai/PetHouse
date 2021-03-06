@extends('layouts.base')

@section('head')
<!-- <script src="{{ asset('js/articleScript.js') }}" defer></script> -->
<link rel="stylesheet" href="{{ asset('css/conservationMessageStyle.css') }}">
@endsection

@section('content')
<ul class="breadcrumb">
    <li><a href="{{ route('home') }}">HOME</a></li>
    <li><a href="{{ route('myPage') }}">マイページTOP</a></li>
    <li>メッセージ一覧</li>
</ul>

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
        <h1>里親希望者からのお問い合わせ一覧</h1>
        <br>
        <br>
        <!--table-->
        <table>
            @if($messages != null)
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>メッセージ<br><span style="font-size:12px;">以下リンク先でメッセージ詳細ページに飛びます</span></th>
                        <th>着信日時</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($messages as $msg)
                        <tr>
                            <td class="icon">{{ $msg['fromName'] }} さん</td>
                            <td><a class="li-member"
                                    href="{{ route('messageDetail', ['id' => $msg['id']]) }}">内容を確認する</a>
                            </td>
                            <td><time
                                    datetime="2022-01-28">{{ $msg['created_at']->format('Y年m月d日') }}</time>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @else
                <h2>メッセージはありません</h2>
            @endif
        </table>

    </div>


</main-content>
@endsection
