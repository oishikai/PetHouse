@extends('layouts.base')

@section('head')
<script src="{{ asset('js/articleDetailScript.js') }}" defer></script>
<link href="{{ asset('css/articleDetailStyle.css') }}" rel="stylesheet">
@endsection

@section('content')
<?php
// dd($data);
?>
<div id="wrapper">
    <div class="back">
        <a href="javascript:history.back()">＜＜前のページに戻る</a>
    </div>
    <div class="Publication">
        <!-- <p>{{ $user['kanjiFamilyName'] }} {{ $user['kanjiFirstName'] }}
            さんの里親募集詳細</p> -->
        <p>募集ID：{{ $id }}</p>
        <?php
            $date = $data['created_at'];
            $date->format('Y-m-d');
            // dd($date->format('Y-m-d'));
        ?>
        <p>掲載日：{{ $date->format('Y年m月d日') }}</p>

        <!-- <p>
            <button type="submit" action="{{ route('favorite', ['id' => $id]) }}"  class="btn btn-btn-secondary">♥お気に入り</button>
        </p> -->
        @if($favJudge == false)
            <p>
                <a
                    href="{{ route('favorite', ['id' => $id]) }}">
                    <button type="button" class="btn btn-btn-secondary">♥お気に入り</button>
                </a>
            </p>
        @else
            <p>お気に入り登録済み</p>
        @endif
    </div>
    <div id="contents-container">
        <section id="title">
            <h2>{{ $data['title'] }}</h2>
            <p>♥お気に入り登録者 {{$favCount}} 人</p>
        </section>
        <section id="imgGallery">
            <div class="mein-frame">
                <img id="main-img"
                    src="https://pethouse1984.s3.ap-northeast-1.amazonaws.com/article/{{ $files[0] }}" alt="メイン写真">
            </div>
            <ul class="thumbspace">
                @for($i=0; $i < count($files); $i++)
                    <li>
                        <img class="thumbnails"
                            src="https://pethouse1984.s3.ap-northeast-1.amazonaws.com/article/{{ $files[$i] }}"
                            data-imagesrc="https://pethouse1984.s3.ap-northeast-1.amazonaws.com/article/{{ $files[$i] }}"
                            alt="写真4">
                    </li>
                @endfor
            </ul>
            <script type="text/javascript">
                var thumbs = document.querySelectorAll('.thumbnails');
                for (var i = 0; i < thumbs.length; i++) {
                    thumbs[i].onclick = function () {
                        document.getElementById('main-img').src = this.dataset.imagesrc;
                    };
                }

            </script>
            @if ( $data['gender'] == 'オス')
            <h2>{{ $data['name']}} くん  (♂) {{$data['age']}}</h2>
            @elseif( $data['gender'] == 'メス')
            <h2>{{ $data['name']}} ちゃん  (♀) {{$data['age']}}</h2>
            @else
            <h2>{{ $data['name']}} (性別不明) {{$data['age']}}</h2>
            @endif
        </section>
        <section id="information">
            <div class="menu">
                <label for="menu_bar01">
                    <h2>基本情報</h2>
                </label>
                <input type="checkbox" id="menu_bar01" />
                <ul id="links01">
                    <li>
                        <table>
                            <tr>
                                <th>状況</th>
                                <td>{{ $data['status'] }}</td>
                            </tr>
                            <tr>
                                <th>種類</th>
                                <td>{{ $data['species'] }}</td>
                            </tr>
                            <tr>
                                <th>サイズ</th>
                                <td>{{ $data['size'] }}</td>
                            </tr>
                        </table>
                    </li>
                </ul>
                <label for="menu_bar02">
                    <h2>詳細情報</h2>
                </label>
                <input type="checkbox" id="menu_bar02" />
                <ul id="links02">
                    <li>
                        <table>
                            <tr>
                                <th>ワクチン接種</th>
                                <td>{{ $data['vaccination'] }}</td>
                            </tr>
                            <tr>
                                <th>去勢／避妊</th>
                                <td>{{ $data['castration'] }}</td>
                            </tr>
                            <tr>
                                <th>健康状態</th>
                                <td>{{ $data['health'] }}</td>
                            </tr>
                        </table>
                    </li>
                </ul>
                <label for="menu_bar03">
                    <h2>その他</h2>
                </label>
                <input type="checkbox" id="menu_bar03" />
                <ul id="links03">
                    <li>
                        <table>
                            <tr>
                                <th>募集の経緯</th>
                                <td>{{ $data['background'] }}</td>
                            </tr>
                            <tr>
                                <th>性格や特徴</th>
                                <td>{{ $data['personality'] }}</td>
                            </tr>
                            <tr>
                                <th>その他備考</th>
                                @if ($data['remarks'] != null)
                                <td>{{ $data['remarks'] }}</td>
                                @else
                                <td>なし</td>
                                @endif
                            </tr>
                        </table>
                    </li>
                </ul>
                <label class="menu_ber04" for="menu_bar04">
                    <h2>条件・募集可能地域</h2>
                </label>
                <input type="checkbox" id="menu_bar04" />
                <ul id="links04">
                    <li>
                        <table>
                            <tr>
                                <th>
                                    <p>・単身者応募</p>
                                </th>
                                <td>{{ $data['singlePerson'] }}</td>
                            </tr>
                            <tr>
                                <th>
                                    <p>・高齢者応募(６５歳以上)</p>
                                </th>
                                <td>{{ $data['elderPerson'] }}</td>
                            </tr>
                            <tr>
                                <th>
                                    <p>・先住ペットがいる方</p>
                                </th>
                                <td>{{ $data['keeper'] }}</td>
                            </tr>
                            <tr>
                                <th>募集可能地域</th>
                                <td>{{ $quest['area']}}</td>
                            </tr>
                            <tr>
                                <th>引き渡し場所</th>
                                <td>{{ $data['transaction'] }}</td>
                            </tr>
                        </table>
                    </li>
                </ul>
                <label for="menu_bar05">
                    <h2>里親募集者情報</h2>
                </label>
                <input type="checkbox" id="menu_bar05" />
                <ul id="links05">
                    <li>
                        <table>
                            <tr>
                                <th>保護活動者<br>里親募集者名</th>
                                <td>{{ $writer['kanjiFamilyName']}} {{ $writer['kanjiFirstName']}}</td>
                            </tr>
                            <tr>
                                <th>会員種別</th>
                                <td>{{ $quest['conservationStatus']}}</td>
                            </tr>
                            <tr>
                                <th>団体・法人所在地<br>里親募集者住所</th>
                                <td>{{ $quest['address']}}</td>
                            </tr>
                        </table>
                    </li>
                </ul>
                @if ($user['status'] == '0')
                <div class="apply">
                    <h2><a href="/messageForm/{{$id}}/{{$user['id']}}">お申し込み</a></h2>
                </div>
                @endif
            </div>
        </section>
    </div>
</div>
@endsection
