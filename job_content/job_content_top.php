<?php

//登録情報一覧表示処理
$_SESSION = array();
$_POST = array();

//全件数
$con_all = count($arr['data']['id']);
//1ページ表示件数
$con_paging = 10;
//ページ数処理
$con_page = $con_all / $con_paging;
//ceilで小数点切り上げ
$con_page = ceil($con_page);
//現在のページ数処理
$pid = filter_var($_GET['pid']);
$page_no = intval($pid); //連想配列の数値型に注意
if( empty($page_no) || !is_numeric($page_no) || $page_no > $con_page){
$page_no = 1;
}

//前後のページ数表示設定
$npager = $page_no - 3;
$ppager = $page_no + 3;

$arr['data']['id'] = array_reverse($arr['data']['id']);
shuffle($arr['data']['id']);

for($i=0; $i < $con_all ; $i++){
//if( $page_no * $con_paging > $i && $i >= $page_no * $con_paging - $con_paging ){

if( !empty($arr['data']['id'][$i]['job']) ){
$jobcount = count($arr['data']['id'][$i]['job']);
for($d = 0; $d < $jobcount ; $d++){
$catime = $arr['data']['id'][$i]['job'][$d]['carr_time'];
$rtime = time();
$catime = strtotime('+1 day' , $catime);

//if($catime > $rtime){

//求人表示用に新たな配列へ入れる
$arr['data']['id'][$i]['job'][$d]['comp_name'] = $arr['data']['id'][$i]['corp']['comp_name'];
$arr['data']['id'][$i]['job'][$d]['comp_num'] = $arr['data']['id'][$i]['corp']['num'];
$arr['data']['id'][$i]['job'][$d]['job_num'] = $arr['data']['id'][$i]['corp']['num'].'j'.$d;
//var_dump($arr['data']['id'][$i]['job'][$d]['comp_num']);
//評価点計算処理
$comp_rate = $arr['data']['id'][$i]['corp']['review_avg'];
$rate = $comp_rate;
$arr['data']['id'][$i]['job'][$d]['review_avg'] = $rate;

$hyoji[] = $arr['data']['id'][$i]['job'][$d];

//}


}

}
//}
}

$hyojicount = count($hyoji);
//配列をシャッフルする
//shuffle($hyoji);

//ページ数処理
$con_page = $hyojicount / $con_paging;
//ceilで小数点切り上げ
$con_page = ceil($con_page);

$con_page = hsc($con_page);
$page_no = hsc($page_no);
$page_no = intval($page_no);

echo <<<EOF
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="./css/common.css" rel="stylesheet">
EOF;
if($page_no === 1){
echo '<title>求人・企業評判情報トップページ</title>';
}else{
echo '<title>求人・企業評判情報 | ページ'.$page_no.'</title>';
}
echo <<<EOF

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-light bg-primary">
<div class="container nav-logo-lead">
  <a class="navbar-brand text-white" href="#"><img src="/img/logo.png" alt="求人検索"></a>
  <span class="sub-title">求人と会社の評判を探しやすくする</span>
</div>
</nav>
EOF;

//if( $page_no === 1 ){
echo <<<EOF
<div class="hero-img mb-3">
<h1 class="h2 my-3">会社の評判や求人を検索してみよう</h1>
<p>
求人と会社の評判情報を検索して、ご自身にとっての働きやすい企業を探してみましょう
</p>
</div>
EOF;
//}

echo <<<EOF
<div class="container nav-position" id="gotop">
<div class="nav-position-list">
<ul class="nav nav-tabs mb-3">
  <li class="nav-item">
     <a href="#tab1" class="nav-link t1 active font-weight-bold" data-toggle="tab">求人検索</a>
  </li>
  <li class="nav-item">
     <a href="#tab2" class="nav-link font-weight-bold" data-toggle="tab">企業検索</a>
  </li>
  <li class="nav-item">
     <a href="#tab3" class="nav-link font-weight-bold" data-toggle="tab">社名検索</a>
  </li>
</ul>
</div>

<div class="tab-content">
  <div id="tab1" class="tab-pane fade show active">

<h2 class="h6"><label for="searchbox">求人特徴で検索</label></h2>

<form method="get" action="">
<div class="form-row">

<div class="form-group col-md-4">
    <h2 class="h6"><label for="carr_syok">職種で求人を検索</label></h2>
    <select class="form-control form-control-sm" name="job" id="carr_syok">
      <option value="">選択してください</option>
      <option value="営業職">営業系</option>
      <option value="販売・サービス職">販売・サービス系</option>
      <option value="事務職（一般・総務・人事・企画）">事務系 ＞ 一般・総務・人事系</option>
      <option value="事務職（経理・財務・労務・法務）">事務系 ＞ 経理・財務・労務・法務系</option>
      <option value="事務職（総合職）">事務系 ＞ 総合職</option>
      <option value="事務職（その他）">事務系 ＞ その他</option>
      <option value="経営・コンサル・管理職">経営・コンサル・管理系</option>
      <option value="デザイン・クリエイティブ職">デザイン・クリエイティブ系</option>
      <option value="技術職（IT・Web）">技術系 ＞ IT・Web系</option>
      <option value="技術職（建設）">技術系 ＞ 建設系</option>
      <option value="技術職（機械）">技術系 ＞ 機械系</option>
      <option value="技術職（電気・電子）">技術系 ＞ 電気・電子系</option>
      <option value="技術職（化学・食品・医薬）">技術系 ＞ 化学・食品・医薬系</option>
      <option value="技術職（製造・生産）">技術系 ＞ 製造・生産系</option>
      <option value="技術職（総合職）">技術系 ＞ 総合職</option>
      <option value="技術職（その他）">技術系 ＞ その他</option>
      <option value="その他の職種">その他職種</option>
</select>
</div>

<div class="form-group col-md-4">
   <h2 class="h6"><label for="carr_plc">勤務地で求人を検索</label></h2>
    <select class="form-control form-control-sm" name="place" id="carr_plc">
      <option value="">選択してください</option>
      <option value="全国エリア">全国エリア</option>
      <option value="東北エリア">東北エリア</option>
      <option value="関東エリア">関東エリア</option>
      <option value="中部エリア">中部エリア</option>
      <option value="関西エリア">関西エリア</option>
      <option value="中四国エリア">中四国エリア</option>
      <option value="九州エリア">九州エリア</option>
      <option value="北海道">北海道</option>
<option value="青森県">青森県</option>
<option value="岩手県">岩手県</option>
<option value="宮城県">宮城県</option>
<option value="秋田県">秋田県</option>
<option value="山形県">山形県</option>
<option value="福島県">福島県</option>
<option value="茨城県">茨城県</option>
<option value="栃木県">栃木県</option>
<option value="群馬県">群馬県</option>
<option value="埼玉県">埼玉県</option>
<option value="千葉県">千葉県</option>
<option value="東京都">東京都</option>
<option value="神奈川県">神奈川県</option>
<option value="新潟県">新潟県</option>
<option value="富山県">富山県</option>
<option value="石川県">石川県</option>
<option value="福井県">福井県</option>
<option value="山梨県">山梨県</option>
<option value="長野県">長野県</option>
<option value="岐阜県">岐阜県</option>
<option value="静岡県">静岡県</option>
<option value="愛知県">愛知県</option>
<option value="三重県">三重県</option>
<option value="滋賀県">滋賀県</option>
<option value="京都府">京都府</option>
<option value="大阪府">大阪府</option>
<option value="兵庫県">兵庫県</option>
<option value="奈良県">奈良県</option>
<option value="和歌山県">和歌山県</option>
<option value="鳥取県">鳥取県</option>
<option value="島根県">島根県</option>
<option value="岡山県">岡山県</option>
<option value="広島県">広島県</option>
<option value="山口県">山口県</option>
<option value="徳島県">徳島県</option>
<option value="香川県">香川県</option>
<option value="愛媛県">愛媛県</option>
<option value="高知県">高知県</option>
<option value="福岡県">福岡県</option>
<option value="佐賀県">佐賀県</option>
<option value="長崎県">長崎県</option>
<option value="熊本県">熊本県</option>
<option value="大分県">大分県</option>
<option value="宮崎県">宮崎県</option>
<option value="鹿児島県">鹿児島県</option>
<option value="沖縄県">沖縄県</option>
<option value="海外">海外</option>
    </select>
</div>

<div class="form-group col-md-4">
<h2 class="h6"><label for="carr_sal">給与金額で求人検索</label></h2>
<select class="form-control form-control-sm" name="money" id="carr_sal">
 <option value="">選択してください</option>
 <option value="月給15万円〜月給25万円未満">月給15万円〜月給25万円未満</option>
 <option value="月給25万円〜月給35万円未満">月給25万円〜月給35万円未満</option>
 <option value="月給35万円以上">月給35万円以上</option>
 <option value="年俸200万円〜年俸400万円未満">年俸200万円〜年俸400万円未満</option>
 <option value="年俸400万円〜年俸500万円未満">年俸400万円〜年俸500万円未満</option>
 <option value="年俸500万円以上">年俸500万円以上</option>
 <option value="時給800円〜時給1200円未満">時給800円〜時給1200円未満</option>
 <option value="時給1200円以上〜時給1500円未満">時給1200円以上〜時給1500円未満</option>
 <option value="時給1500円以上">時給1500円以上</option>
</select>
</div>
</div>


<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="cstyle" id="cstyle" value="正社員">
  <label class="form-check-label" for="cstyle">正社員</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="exp" id="mikeiken" value="未経験者歓迎">
  <label class="form-check-label" for="mikeiken">未経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="english" id="english" value="英語使用">
  <label class="form-check-label" for="english">英語使用</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="kisotu" id="kisotu" value="既卒・第2新卒歓迎">
  <label class="form-check-label" for="kisotu">既卒・第2新卒歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="aca" id="aca" value="学歴不問">
  <label class="form-check-label" for="aca">学歴不問</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="age" id="age" value="年齢不問">
  <label class="form-check-label" for="age">年齢不問</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="rimit" id="rimit" value="もうすぐ締切">
  <label class="form-check-label" for="rimit">もうすぐ締切</label>
</div>

</div>


<button type='submit' class="btn btn-sm btn-danger w-100 badge-pill p-2">求人検索</button>

</form>

 </div>

  <div id="tab2" class="tab-pane fade">

<form action="" method="get">
<h2 class="h6"><label for="searchbox">企業の特徴で検索</label></h2>
<div class="form-row">

<div class="form-group col-md-4">
<h2 class="h6"><label for="scale">企業規模</label></h2>
<select class="form-control form-control-sm" name="scale" id="scale">
 <option value="">選択してください</option>
 <option value="上場企業">上場企業</option>
 <option value="外資系企業">外資系企業</option>
 <option value="非上場大手">非上場大手</option>
 <option value="グループ企業">グループ企業</option>
 <option value="中小企業">中小企業</option>
</select>
</div>

<div class="form-group col-md-4">
<h2 class="h6"><label for="system">会社制度</label></h2>
<select class="form-control form-control-sm" name="system" id="system">
 <option value="">選択してください</option>
 <option value="正社員登用・無期転換">正社員登用・無期転換</option>
 <option value="退職金制度">退職金制度</option>
 <option value="転勤無し・地域限定">転勤無し・地域限定</option>
 <option value="在宅勤務">在宅勤務</option>
 <option value="産休・育休">産休育休</option>
</select>
</div>

<div class="form-group col-md-4">
<h2 class="h6"><label for="welfare">福利厚生</label></h2>
<select class="form-control form-control-sm" name="welfare" id="welfare">
 <option value="">選択してください</option>
 <option value="手当幾つか有り">手当幾つか有り</option>
 <option value="福利厚生幾つか有り">福利厚生幾つか有り</option>
 <option value="手当・福利厚生幾つか有り">手当・福利厚生幾つか有り</option>
 <option value="福利厚生有り">福利厚生有り</option>
 <option value="福利厚生良い">福利厚生良い</option>
</select>
</div>

</div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="kinzoku" id="kinzoku" value="勤続年数">
  <label class="form-check-label" for="kinzoku">勤続年数</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="risyok" id="risyok" value="離職率">
  <label class="form-check-label" for="risyok">離職率</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="bonus" id="bonus" value="賞与">
  <label class="form-check-label" for="bonus">賞与</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="paidh" id="paidh" value="有給休暇">
  <label class="form-check-label" for="paidh">有給休暇</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="income" id="income" value="平均年収">
  <label class="form-check-label" for="income">平均年収</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="public" id="public" value="大学職員・団体職員">
  <label class="form-check-label" for="public">大学職員・団体職員</label>
</div>

</div>

<button type='submit' class="btn btn-sm btn-primary w-100 badge-pill p-2">企業の特徴検索</button>

<div class="d-flex align-items-center">
<div class="mx-auto">
  <input class="form-check-input" type="checkbox" name="score" id="score" value="評判・評価スコア">
  <label class="form-check-label" for="score">評判スコア順</label>
</div>
</div>

</form>

  </div>

  <div id="tab3" class="tab-pane fade">

<form action="" method="get">
<h2 class="h6"><label for="searchbox">企業名で評判・求人検索</label></h2>
<div class="input-group mb-3">
<input type="text" name="jq" class="form-control form-control-sm" id="searchbox" placeholder="企業名を入力" readonly>
<div class="input-group-append">
<button type='submit' class="btn btn-sm btn-info border-right-1" >企業名検索</button>
</div>
</div>

</form>

</div>

<hr class="my-3">

<h2 class="h5 text-center">転職サイト【PR】</h2>
<div class="top-content mb-3">
<div class="content-item ci1"></div>
<div class="content-item ci2"></div>
<div class="content-item ci3"></div>
</div>

<h2 class="h5 text-center">企業評判サイト【PR】</h2>
<div class="top-content mb-3">
<div class="content-item ci4"></div>
<div class="content-item ci5"></div>
<div class="content-item ci6"></div>
</div>

<nav aria-label="パンくずリスト">
  <ul class="breadcrumb mb-1">
    <li class="breadcrumb-item"><a href="#">ホーム</a></li>
    <li class="breadcrumb-item">会社評判・求人情報検索一覧</li>
  </ul>
</nav>

<p class="text-right">ページ数：{$page_no}／{$con_page}</p>

EOF;

for($t = 0 ; $t < $hyojicount ; $t++){
if( $page_no * $con_paging > $t && $t >= $page_no * $con_paging - $con_paging ){

$hyojisyoku = postdata($hyoji[$t]['carr_syok']);
$hyojiplc = postdata($hyoji[$t]['carr_plc']);
$hyojisal = postdata($hyoji[$t]['carr_sal']);
$hyojiurl = urlencode($hyoji[$t]['carr_url']);
$hyojisty = postdata($hyoji[$t]['carr_sty']);
$hyojidata = date('Y年n月j日', $hyoji[$t]['carr_time'] );

$rtime = time();
$catime = $hyoji[$t]['carr_time'];
$bef_time = strtotime( '-2 day' , $catime );

if(!empty($hyoji[$t]['review_avg'])){
$comp_rate = ($hyoji[$t]['review_avg'] / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($hyoji[$t]['review_avg'])){
$comp_rate = "-";
$hyoji[$t]['review_avg'] = "-";
}


if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}


echo <<<EOF
<div class="card mb-3">
<div class="card-header clearfix">
<div class="row">
<div class="col-9">
<h2 class="d-inline h6 m-0 p-0">{$hyoji[$t]['comp_name']}</h2>
</div>
<div class="col-3">
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$hyojisty} </div>
</div>
</div>
</div>

<div class="card-body row">
<div class="col-md-9">
<p class="card-text mb-2"> 職種：{$hyojisyoku} </p>
<p class="card-text mb-2">勤務地： {$hyojiplc} </p>
<p class="card-text mb-0">給与： {$hyojisal} </p>
</div>
<div class="col-md-3">
<a href="?c={$hyoji[$t]['comp_num']}" class="btn btn-info mb-3 mt-3 mt-md-0 w-100" >企業情報</a>
<a href="?j={$hyoji[$t]['job_num']}" class="btn btn-danger mb-0 mt-3 mt-md-0 w-100" >採用情報</a>
</div>
</div>
<div class="card-footer  clearfix bg-white">
<p class="card-text float-right"><span class="mr-3 text-danger">{$htmlcatime_before}</span></p>
</div>
</div>
EOF;

}
}

//ページャー表示部分
echo <<<EOF
<nav aria-label="..." class="mt-3">
  <ul class="pagination justify-content-center">
EOF;

if($page_no > 1 ){
$p_prev = $page_no -1;
echo '<li class="page-item"><a href="?pid='.$p_prev.'" class="page-link">前のページへ</a></li>';
}

//前後ページ表示数調整処理
if( $npager <= 0 ){
$pneg = -$npager;
$ppager = $pneg + $ppager;
$npager = 1;
}

if($ppager >= $con_page){
$pneg = $ppager - $con_page;
$pneg = intval($pneg);
$npager = $npager - $pneg;
$ppager = $con_page;
}

for($i= $npager ; $i <= $ppager ; $i++){

if( $page_no === $i){
echo '<li class="page-item active"><span class="page-link">'.$i.'</span></li>';
} else {
echo '<li class="page-item"><a href="?pid='.$i.'" class="page-link">'.$i.'</a></li>';
}

}


if( $page_no < $con_page){
$p_next = $page_no + 1;
echo '<li class="page-item"><a href="?pid='.$p_next.'" class="page-link">次のページへ</a></li>';
}

echo <<<EOF
  </ul>
</nav>
EOF;


?>