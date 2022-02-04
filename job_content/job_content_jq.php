<?php

$getjq = filter_var( $_GET['jq']);
$idcont = count($arr['data']['id']);

for($y=0;$y<$idcont;$y++){

if(strstr($arr['data']['id'][$y]['corp']['comp_name'] , $getjq )){

$arjcont = count($arr['data']['id'][$y]['job']);
for($b=0;$b<$arjcont;$b++){

$catime = $arr['data']['id'][$y]['job'][$b]['carr_time'];
$rtime = time();
$catime = strtotime('+1 day' , $catime);
if($catime > $rtime){
$arr['data']['id'][$y]['job'][$b]['comp_name'] = $arr['data']['id'][$y]['corp']['comp_name'];
$arr['data']['id'][$y]['job'][$b]['comp_num'] = $arr['data']['id'][$y]['corp']['num'];
$arr['data']['id'][$y]['job'][$b]['job_num'] = $arr['data']['id'][$y]['corp']['num'].'j'.$b;
$arr['data']['id'][$y]['job'][$b]['review_avg'] = $arr['data']['id'][$y]['corp']['review_avg'];

$comparr[] = $arr['data']['id'][$y]['job'][$b];
$schk = 1;
}

}


}

}

//var_dump($comparr);

//全件数
$con_all = count($comparr);
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
echo '<title>'.$getjq.'の求人・会社情報一覧トップページ</title>';
}else{
echo '<title>'.$getjq.'の求人・会社情報一覧 | ページ'.$page_no.'</title>';
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

<div class="container"  id="gotop">
<nav aria-label="パンくずリスト">
  <ul class="breadcrumb mb-1">
    <li class="breadcrumb-item"><a href="#">ホーム</a></li>
    <li class="breadcrumb-item">{$getjq}の求人・会社評判情報一覧</li>
  </ul>
</nav>
<h1 class="h3">{$getjq}<span class="h6">の求人・会社評判情報一覧</span></h1>
<p class="text-right mb-0">{$getjq}を含む会社の検索ヒット数：{$con_all}件</p>
<p class="text-right">{$getjq}を含む会社のページ数：{$page_no}／{$con_page}ページ</p>
EOF;

$sacont = count($comparr);

for($t = 0 ; $t < $sacont ; $t++){
if( $page_no * $con_paging > $t && $t >= $page_no * $con_paging - $con_paging ){

$hyojisyoku = postdata($comparr[$t]['carr_syok']);
$hyojiplc = postdata($comparr[$t]['carr_plc']);
$hyojisal = postdata($comparr[$t]['carr_sal']);
$hyojiurl = urlencode($comparr[$t]['carr_url']);
$hyojisty = postdata($comparr[$t]['carr_sty']);
$hyojidata = date('Y年n月j日', $comparr[$t]['carr_time'] );
$hyojiapp = $comparr[$t]['carr_app'];

$rtime = time();
$catime = $comparr[$t]['carr_time'];
$bef_time = strtotime( '-2 day' , $catime );

if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}


if(!empty($comparr[$t]['review_avg'])){
$comp_rate = ($comparr[$t]['review_avg'] / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($comparr[$t]['review_avg'])){
$comp_rate = "-";
$comparr[$t]['review_avg'] = "-";
}


echo <<<EOF
<div class="card mb-3">
<div class="card-header clearfix"><h2 class="d-inline h6 m-0 p-0">{$comparr[$t]['comp_name']}</h2>
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$hyojisty} </div>
{$hyojisyoku}
</div>

<div class="card-body row">
<div class="col-md-9">
<p class="card-text mb-2">仕事内容：{$hyojiapp} </p>
<p class="card-text mb-2">勤務地： {$hyojiplc} </p>
<p class="card-text mb-0 pb-0">給与： {$hyojisal} </p>
</div>
<div class="col-md-3">
<a href="?c={$comparr[$t]['comp_num']}" class="btn btn-info mb-3 mt-3 mt-md-0 w-100" >企業情報</a>
<a href="?j={$comparr[$t]['job_num']}" class="btn btn-danger mb-0 mt-3 mt-md-0 w-100" >採用情報</a>
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
echo '<li class="page-item"><a href="?jq='.$getjq.'&pid='.$p_prev.'" class="page-link">前のページへ</a></li>';
}

$range = 3;
$ppager = 0;
if ($page_no - $range < 1) {
  $ppager = $range - $page_no + 1;
}
 
$npager = 0;
if ($page_no + $range > $con_page) {
  $npager = $page_no + $range - $con_pager;
}

for($i = $range + $npager; $i > 0; $i--){
if( $page_no - $i < 1  ){
continue;
}
$pn = $page_no -$i;
echo '<li class="page-item"><a href="?jq='.$getjq.'&pid='.$pn.'" class="page-link">'.$pn.'</a></li>';
}

echo '<li class="page-item active"><span class="page-link">'.$page_no.'</span></li>';

for( $i = 1; $i <= $range + $ppager; $i++ ){
if($page_no + $i > $con_page){
break;
}
$pn = $page_no + $i;
echo '<li class="page-item"><a href="?jq='.$getjq.'&pid='.$pn.'" class="page-link">'.$pn.'</a></li>';

}

if( $page_no < $con_page){
$p_next = $page_no + 1;
echo '<li class="page-item"><a href="?jq='.$getjq.'&pid='.$p_next.'" class="page-link">次のページへ</a></li>';
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
    <link href="./css/common.css" rel="stylesheet">

   <title>未登録の求人 ｜未登録の企業</title>
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

<div class="text-danger">検索した企業名・求人は現在登録されておりません。</div>

EOF;

}

?>