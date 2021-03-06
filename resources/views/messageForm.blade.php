@extends('layouts.base')

@section('head')
<link rel="stylesheet" href="{{ asset('css/messageFormStyle.css') }}">
@if( $user['status'] == '0')
    <link rel="stylesheet" href="{{ asset('css/fosterMyPageStyle.css') }}">
@else
    <link rel="stylesheet" href="{{ asset('css/conservationMyPageStyle.css') }}">
@endif
@endsection

@section('content')
<main-content>
    <!-----side----->
    @if( $user['status'] == '1')
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
    @else
        <aside>
            <nav class="MP-sideBox">
                <div class="menu-title">メニュー</div>
                <ul>
                    <li><a href="{{ route('myPage') }}">マイページTOP</a></li>
                    <li><a href="{{ route('articleFavorite') }}">お気に入り一覧</a></li>
                    <li><a href="{{ route('message') }}">保護活動者からの<br>メッセージ</a></li>
                    <li><a href="{{ route('questionnaire') }}">アンケート登録・変更</a></li>
                </ul>
        </aside>
    @endif
    <!--main content-->
    <div class="MP-main" style='height: 550px;'>
        <div class="messageform">
            <form method="POST" action="/sendMessage">
                @csrf
                <h1>MESSAGE</h1>
                @if( $user['status'] == '0')
                    該当の記事を投稿した保護活動者にメッセージを送信します
                    <table>
                        <tr>
                            <th><label>該当の記事</label></th>
                            <td><input type="text" class="text" size="45"
                                    value="{{ $data['title'] }}" name='title' disabled /></td>
                        </tr>
                        <tr>
                            <th><label>件名</label></th>
                            <td><input type="text" class="text" size="45" name='subject' /></td>
                        </tr>

                        <tr>
                            <th><label>メッセージ</label></th>
                            <td><textarea cols="60" rows="5" name="comments" id="comments"></textarea></td>
                        </tr>
                        <input type="text" class="text" size="45" value="{{ $id }}" name='articleId'
                            style='display: none;'>

                        <input type="text" class="text" size="45" value="{{ $data['user_id'] }}"
                            name='toUserId' style='display: none;'>
                        <input type="text" class="text" size="45" value="{{ $user['id'] }}"
                            name='fromUserId' style='display: none;'>

                        <input type="text" class="text" size="45"
                            value="{{ $user['kanjiFamilyName'] }}{{ $user['kanjiFirstName'] }}"
                            name='fromName' style='display: none;'>
                        <input type="text" class="text" size="45" value="{{ $myData['age'] }}"
                            name='fromAge' style='display: none;'>
                        <input type="text" class="text" size="45"
                            value="{{ $myData['gender'] }}" name='fromGender'
                            style='display: none;'>
                    </table>
                @else
                    該当の記事に対しての送信者に返信をします
                    <table>
                        <tr>
                            <th><label>該当の記事</label></th>
                            <td><input type="text" class="text" size="45"
                                    value="{{ $data['title'] }}" name='title' disabled /></td>
                        </tr>
                        <tr>
                            <th><label>宛先</label></th>
                            <td><input type="text" class="text" size="45"
                                    value="{{ $msg['fromName'] }} 様" name='title' disabled /></td>
                        </tr>
                        <tr>
                            <th><label>件名</label></th>
                            <td><input type="text" class="text" size="45" value="Re: {{$msg['subject']}}" name='subject' /></td>
                        </tr>

                        <tr>
                            <th><label>メッセージ</label></th>
                            <td><textarea cols="60" rows="5" name="comments" id="comments"></textarea></td>
                        </tr>
                        <input type="text" class="text" size="45" value="{{ $id }}" name='articleId'
                            style='display: none;'>

                        <input type="text" class="text" size="45" value="{{ $msg['fromId'] }}"
                            name='toUserId' style='display: none;'>
                        <input type="text" class="text" size="45" value="{{ $user['id'] }}"
                            name='fromUserId' style='display: none;'>

                    </table>
                @endif
                <input type="submit" class="submit" value="送信する" />
            </form>
        </div>
    </div>



</main-content>
<!--/main-content-->

@endsection
