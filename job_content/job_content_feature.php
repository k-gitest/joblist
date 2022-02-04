<?php

$_SESSION = array();
$_POST = array();

$args = array(
  'scale'  => "",
  'system'  => "",
  'welfare'  => "",
  'kinzoku'  => "",
  'risyok'  => "",
  'bonus'  => "",
  'paidh'  => "",
  'income'  => "",
  'public'  => "",
  'score'  => ""
);

$pa_name = filter_input_array(INPUT_GET,$args);

foreach($pa_name as $key => $val){
$pgname .= $key.'='.$val.'&';
}

$getscale = filter_var($_GET['scale']);
if(!empty($getscale)){
$searchkey[]  = $getscale;
$stitle[] = $getscale;
}

$getsystem = filter_var($_GET['system']);
if(!empty($getsystem)){
$searchkey[]  = $getsystem;
$stitle[] = $getsystem;
}

$getwelfare = filter_var($_GET['welfare']);
if(!empty($getwelfare)){
$searchkey[]  = $getwelfare;
$stitle[] = $getwelfare;
}

$getkinzoku = filter_var($_GET['kinzoku']);
if(!empty($getkinzoku)){
$searchkey[]  = $getkinzoku;
$stitle[] = $getkinzoku;
}

$getrisyok = filter_var($_GET['risyok']);
if(!empty($getrisyok)){
$searchkey[]  = $getrisyok;
$stitle[] = $getrisyok;
}

$getbonus = filter_var($_GET['bonus']);
if(!empty($getbonus)){
$searchkey[]  = $getbonus;
$stitle[] = $getbonus;
}

$getpaidh = filter_var($_GET['paidh']);
if(!empty($getpaidh)){
$searchkey[]  = $getpaidh;
$stitle[] = $getpaidh;
}

$getincome = filter_var($_GET['income']);
if(!empty($getincome)){
$stitle[] = $getincome;
$getincome = "万円";
$searchkey[]  = $getincome;
}

$getpub = filter_var($_GET['public']);
if(!empty($getpub)){
$stitle[] = $getpub;
$getpub = "公社・官公庁・自治体・団体・教育機関";
$searchkey[]  = $getpub;
}

$getplace = filter_var($_GET['place']);

if(!empty($getplace)){
if($getplace === '東北エリア'){
$g_place[] = "青森県";
$g_place[] = "岩手県";
$g_place[] = "宮城県";
$g_place[] = "秋田県";
$g_place[] = "山形県";
$g_place[] = "福島県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
} elseif($getplace === '関東エリア'){
$g_place[] = "茨城県";
$g_place[] = "栃木県";
$g_place[] = "群馬県";
$g_place[] = "埼玉県";
$g_place[] = "千葉県";
$g_place[] = "東京都";
$g_place[] = "神奈川県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
}elseif($getplace === '中部エリア'){
$g_place[] = "新潟県";
$g_place[] = "富山県";
$g_place[] = "石川県";
$g_place[] = "福井県";
$g_place[] = "山梨県";
$g_place[] = "長野県";
$g_place[] = "岐阜県";
$g_place[] = "静岡県";
$g_place[] = "愛知県";
$g_place[] = "三重県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
}elseif($getplace === '関西エリア'){
$g_place[] = "京都府";
$g_place[] = "大阪府";
$g_place[] = "兵庫県";
$g_place[] = "奈良県";
$g_place[] = "滋賀県";
$g_place[] = "和歌山県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
}elseif($getplace === '中四国エリア'){
$g_place[] = "鳥取県";
$g_place[] = "島根県";
$g_place[] = "岡山県";
$g_place[] = "広島県";
$g_place[] = "山口県";
$g_place[] = "徳島県";
$g_place[] = "香川県";
$g_place[] = "愛媛県";
$g_place[] = "高知県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
}elseif($getplace === '九州エリア'){
$g_place[] = "福岡県";
$g_place[] = "佐賀県";
$g_place[] = "長崎県";
$g_place[] = "熊本県";
$g_place[] = "大分県";
$g_place[] = "宮崎県";
$g_place[] = "鹿児島県";
$searchkey[] = $g_place;
$stitle[] = $getplace;
}else{
$searchkey[] = $getplace;
$stitle[] = $getplace;
}
}

$getmoney = filter_var($_GET['money']);
if(!empty($getmoney)){
if($getmoney === '月給15万円〜月給25万円未満' ){
$g_money[] = '月給15万円以上';
$g_money[] = '月給20万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '月給25万円〜月給35万円未満'){
$g_money[] = '月給25万円以上';
$g_money[] = '月給30万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
} elseif($getmoney === '月給35万円以上'){
$g_money[] = '月給35万円以上';
$g_money[] = '月給40万円以上';
$g_money[] = '月給50万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '年俸200万円〜年俸400万円未満'){
$g_money[] = '年俸200万円以上';
$g_money[] = '年俸300万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '年俸400万円〜年俸500万円未満'){
$g_money[] = '年俸400万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '年俸500万円以上'){
$g_money[] = '年俸500万円以上';
$g_money[] = '年俸800万円以上';
$g_money[] = '年俸1000万円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '時給800円〜時給1200円未満'){
$g_money[] = '時給800円以上';
$g_money[] = '時給1000円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '時給1200円以上〜時給1500円未満'){
$g_money[] = '時給1200円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}elseif($getmoney === '時給1500円以上'){
$g_money[] = '時給1500円以上';
$g_money[] = '時給2000円以上';
$searchkey[] = $g_money;
$stitle[] = $getmoney;
}else{
$searchkey[] = $getmoney;
$stitle[] = $getmoney;
}
}


$arcont = count($arr['data']['id']);
$rjtime = time();
for($d=0;$d < $arcont;$d++ ){

$jobc = count($arr['data']['id'][$d]['job']);
for( $t = 0; $t < $jobc ; $t++ ){

//if( $rjtime < $arr['data']['id'][$d]['job'][$t]['carr_time'] ){
$ab = $arr['data']['id'][$d]['corp']['comp_fukuri'];
$cd = $arr['data']['id'][$d]['corp']['comp_yukyu'];
$ef  = $arr['data']['id'][$d]['corp']['comp_syouyo'];
$gh = $arr['data']['id'][$d]['corp']['comp_kinzoku'];
$ij   = $arr['data']['id'][$d]['corp']['comp_risyoku'];
$kl   = $arr['data']['id'][$d]['corp']['comp_gyo'];

$arr['data']['id'][$d]['corp']['comp_fukuri'] = [];
$arr['data']['id'][$d]['corp']['comp_fukuri'][] = $ab;
$arr['data']['id'][$d]['corp']['comp_yukyu'] = [];
$arr['data']['id'][$d]['corp']['comp_yukyu'][] = $cd;
$arr['data']['id'][$d]['corp']['comp_syouyo'] = [];
$arr['data']['id'][$d]['corp']['comp_syouyo'][] = $ef;
$arr['data']['id'][$d]['corp']['comp_kinzoku'] = [];
$arr['data']['id'][$d]['corp']['comp_kinzoku'][] = $gh;
$arr['data']['id'][$d]['corp']['comp_risyoku'] = [];
$arr['data']['id'][$d]['corp']['comp_risyoku'][] = $ij;
$arr['data']['id'][$d]['corp']['comp_gyo'] = [];
$arr['data']['id'][$d]['corp']['comp_gyo'][] = $kl;
$sarr[] = $arr['data']['id'][$d]['corp'];
break 1;
//}

}

}



if(!empty($searchkey)){
$searchkey_title = postdata_title($stitle);
$scount = count($searchkey);

foreach($sarr as $key => $val ){
$ck =0;

if(is_array($val)){
foreach($val as $key2 => $val2){
if(is_array($val2)){
foreach($val2 as $key3 => $val3){

if( !is_array($val3) ){
for($r=0;$r < $scount ; $r++){
$sk = $searchkey[$r];
if(!empty($sk) && !is_array($sk) ){

if(strstr($val3,$sk)){
$ck++;
if( $ck === $scount ){
$sarr2[] = $sarr[$key];
$schk = 1;
break 3;
}

}

}elseif(!empty($sk) && is_array($sk)){
$skc = count($sk);
for($v=0;$v<$skc;$v++ ){
$skey = $sk[$v];

if(strstr($val3,$skey)){
$ck++;
if( $ck === $scount ){
$sarr2[] = $sarr[$key];
$schk = 1;
break 3;
}

}

}

}

}

}//


}
}
}
}

}


}


//全件数
$con_all = count($sarr2);
//1ページ表示件数
$con_paging = 10;
//ページ数処理
$con_page = $con_all / $con_paging;
$con_page = ceil($con_page); //ceilで小数点切り上げ

//現在のページ数処理
$pid = filter_var($_GET['pid']);
$page_no = intval($pid); //連想配列の数値型に注意
if( empty($page_no)  || !is_numeric($page_no) || $page_no > $con_page){
$page_no = 1;
}

$page_no = hsc($page_no);
$page_no = intval($page_no);

//前後のページ数表示設定
$npager = $page_no - 3;
$ppager = $page_no + 3;

if($schk === 1){

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
echo '<title>'.$searchkey_title.'の企業情報一覧トップページ</title>';
}else{
echo '<title>'.$searchkey_title.'の企業情報一覧 | ページ'.$page_no.'</title>';
}
echo <<<EOF
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</head>
<body>
<nav class="navbar navbar-light bg-primary mb-3">
<div class="container nav-logo-lead">
  <a class="navbar-brand text-white" href="#"><img src="/img/logo.png" alt="求人検索"></a>
  <span class="sub-title">求人と会社の評判を探しやすくする</span>
</div>
</nav>

<div class="container" id="gotop">
<nav aria-label="パンくずリスト">
  <ul class="breadcrumb mb-1">
    <li class="breadcrumb-item"><a href="#">ホーム</a></li>
    <li class="breadcrumb-item">{$searchkey_title}の企業情報一覧</li>
  </ul>
</nav>
<h1 class="h3">{$searchkey_title}<span class="h6">の企業情報一覧</span></h1>
<p class="text-right mb-0">{$searchkey_title}を含む企業の検索ヒット数：{$con_all}件</p>
<p class="text-right">{$searchkey_title}を含む企業のページ数：{$page_no}／{$con_page}ページ</p>
EOF;

$sacont = count($sarr2);
$sarr2 = array_reverse($sarr2);

$getscore = filter_var($_GET['score']);
if(!empty($getscore)){
for($r=0;$r<$sacont;$r++){
if(empty($sarr2[$r]['review_avg'])){
$sarr2[$r]['review_avg'] = 0;
}

}

array_multisort( array_column( $sarr2, "review_avg" ), SORT_DESC, $sarr2 ) ;
}


for($t = 0 ; $t < $sacont ; $t++){
if( $page_no * $con_paging > $t && $t >= $page_no * $con_paging - $con_paging ){



$hyojisyoku = postdata($sarr2[$t]['carr_syok']);
$hyojiplc = postdata($sarr2[$t]['carr_plc']);
$hyojisal = postdata($sarr2[$t]['carr_sal']);
$hyojiurl = urlencode($sarr2[$t]['carr_url']);
$hyojisty = postdata($sarr2[$t]['carr_sty']);
$hyojiapp = $sarr2[$t]['carr_app'];
$htmlcatime_before = postdata($sarr2[$t]['rimit']);

$hyojidata = date('Y年n月j日', $sarr2[$t]['carr_time'] );

if(!empty($sarr2[$t]['review_avg'])){
$comp_rate = ($sarr2[$t]['review_avg'] / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($sarr2[$t]['review_avg'])){
$comp_rate = "-";
$sarr2[$t]['review_avg'] = "-";
}


echo <<<EOF
<div class="card mb-3">
<div class="card-header clearfix"><h2 class="d-inline h6 m-0 p-0">{$sarr2[$t]['comp_name']}</h2>
</div>

<div class="card-body row">
<div class="col-md-9">
<div class="h6 mb-2" style="color:#ff5500;">評判スコア：{$sarr2[$t]['review_avg']} </div>
<p class="card-text mb-0">会社概要：{$sarr2[$t]['comp_info']} </p>
</div>
<div class="col-md-3">
<a href="?c={$sarr2[$t]['num']}" class="btn btn-info mb-0 mt-3 mt-md-0 w-100" >企業情報</a>
</div>
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
echo '<li class="page-item"><a href="?pid='.$p_prev.'&'.$pgname.'" class="page-link">前のページへ</a></li>';
}

$range = 3;
$ppager = 0;
if ($page_no - $range < 1) {
  $ppager = $range - $page_no + 1;
}
 
$npager = 0;
if ($page_no + $range > $con_page) {
  $npager = $page_no + $range - $con_page;
}

for($i = $range + $npager; $i > 0; $i--){
if( $page_no - $i < 1  ){
continue;
}
$pn = $page_no -$i;
echo '<li class="page-item"><a href="?pid='.$pn.'&'.$pgname.'" class="page-link">'.$pn.'</a></li>';
}

echo '<li class="page-item active"><span class="page-link">'.$page_no.'</span></li>';

for( $i = 1; $i <= $range + $ppager; $i++ ){
if($page_no + $i > $con_page){
break;
}
$pn = $page_no + $i;
echo '<li class="page-item"><a href="?pid='.$pn.'&'.$pgname.'" class="page-link">'.$pn.'</a></li>';

}

if( $page_no < $con_page){
$p_next = $page_no + 1;
echo '<li class="page-item"><a href="?pid='.$p_next.'&'.$pgname.'" class="page-link">次のページへ</a></li>';
}


echo <<<EOF
  </ul>
</nav>
EOF;


} elseif($schk !== 1){

echo <<<EOF
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
   <title>未登録の求人｜未登録の企業</title>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-light bg-primary mb-3">
<div class="container nav-logo-lead">
  <a class="navbar-brand text-white" href="#"><img src="/img/logo.png" alt="求人検索"></a>
  <span class="sub-title">求人と会社の評判を探しやすくする</span>
</div>
</nav>

<div class="container"  id="gotop">
検索した企業名・求人は現在登録されておりません。<br />

EOF;
}


?>