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
//$page_no = filter_var($_GET['pid'] ?? 1);

$page_no = 1;

$page_no = intval($page_no);//連想配列の数値型に注意
if( empty($page_no)  || !is_numeric($page_no) || $page_no > $con_page){
$page_no = 1;
}

$page_no = hsc($page_no);
$page_no = intval($page_no);

//前後のページ数表示設定
$npager = $page_no - 3;
$ppager = $page_no + 3;

$arr['data']['id'] = array_reverse($arr['data']['id']);
shuffle($arr['data']['id']);

for($i=0; $i < $con_all ; $i++){

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
}

$hyojicount = count($hyoji);
//配列をシャッフルする
shuffle($hyoji);

//ページ数処理
$con_page = $hyojicount / $con_paging;
//ceilで小数点切り上げ
$con_page = ceil($con_page);

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
echo '<title>求人・企業評判情報一覧トップページ</title>';
}else{
echo '<title>求人・企業評判情報一覧 | ページ'.$page_no.'</title>';
}
echo <<< EOF
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
    <li class="breadcrumb-item">会社評判・求人情報検索一覧</li>
  </ul>
</nav>
<h1 class="h3">会社評判・求人情報<span class="h6">の検索一覧</span></h3>
<p class="text-right">検索設定なし</p>
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
$hyojiapp = $hyoji[$t]['carr_app'];

$rtime = time();
$catime = $hyoji[$t]['carr_time'];
$bef_time = strtotime( '-2 day' , $catime );

if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}

if(!empty($hyoji[$t]['review_avg'])){
$comp_rate = ($hyoji[$t]['review_avg'] / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($hyoji[$t]['review_avg'])){
$comp_rate = "-";
$hyoji[$t]['review_avg'] = "-";
}

echo <<<EOF
<div class="card mb-3">
<div class="card-header clearfix"><h2 class="d-inline h6 m-0 p-0">{$hyoji[$t]['comp_name']}</h2>
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$hyojisty} </div>
{$hyojisyoku}
</div>

<div class="card-body row">
<div class="col-md-9">
<p class="card-text mb-2">仕事内容：{$hyojiapp} </p>
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
echo '<li class="page-item"><a href="?pid='.$p_prev.'&job=&place=&money=" class="page-link">前のページへ</a></li>';
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
echo '<li class="page-item"><a href="?pid='.$i.'&job=&place=&money=" class="page-link">'.$i.'</a></li>';
}

}


if( $page_no < $con_page){
$p_next = $page_no + 1;
echo '<li class="page-item"><a href="?pid='.$p_next.'&job=&place=&money=" class="page-link">次のページへ</a></li>';
}

echo <<<EOF
  </ul>
</nav>
EOF;

?>