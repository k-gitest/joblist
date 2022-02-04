<?php

$_SESSION = array();
$_POST = array();

$j = filter_var($_GET['j']);

//企業ナンバーと求人ナンバーを分割処理
$comp_num = mb_strstr($j , 'j' ,true );
$job_num = strpos($j , 'j');
$jnum = substr( $j , $job_num +1 );

//企業ナンバーの検索処理
$arrco = count($arr['data']['id']);
for($i = 0; $i < $arrco ; $i++){
if($comp_num === $arr['data']['id'][$i]['corp']['num']){
$cn = $i;
if( !empty($arr['data']['id'][$i]['job'][$jnum]) ){
$job = $arr['data']['id'][$i]['job'][$jnum];
}

$arr_sim['corp'] = $arr['data']['id'][$i]['corp'];
$arr_sim['job']  = $arr['data']['id'][$i]['job'][$jnum];

$job['comp_name'] = $arr['data']['id'][$i]['corp']['comp_name'];
$job['comp_info'] = $arr['data']['id'][$i]['corp']['comp_info'];
$job['rate'] = $arr['data']['id'][$i]['corp']['review_avg'];
break;//企業ナンバーが合ったら抜ける
}
}

if( !empty($job) ){

//評価点計算処理

$comp_rate = $job['rate'];
$rate = $comp_rate;

if(!empty($job['rate'])){
$comp_rate = ($job['rate'] / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($job['rate'])){
$comp_rate = "-";
$rate = "-";
}

foreach( $job as $key => $val ){
if(is_array($val)){
   foreach($val as $key2 => $val2){
   //echo $key.'は'.$val2.'です。<br />';
   if($key === 'carr_syok'){
   $htmlsyok = postdata($val);
   }elseif( $key === 'carr_plc'){
       $htmlplc = postdata($val);
   }elseif($key === 'carr_info'){
       $htmlinfo = postdata($val);
   }elseif($key === 'carr_sty'){
       $htmlsty = postdata($val);
   }elseif($key === 'carr_sal'){
       $htmlsal = postdata($val);
   }elseif( $key === 'carr_acaback' ){
       $htmlaca = postdata($val);
   }elseif( $key === 'carr_age'){
       $htmlage = postdata($val);
   }elseif( $key === 'carr_overtime'){
       $htmlovertime = postdata($val);
   }elseif( $key === 'carr_holy'){
       $htmlholy = postdata($val);
   }


   }
}else{
//echo $key.'は'.$val.'です。<br />';
   if($key === 'carr_url'){

$val = urlencode($val );
//urlによるafコードリンクの条件分岐処理
if( strstr( $val , 'next.rikunabi' ) ){
$htmlurl .= '<a href="//***.com/';
$valcheck = mb_substr($val,  -3);
if($valcheck === "%2F" || $valcheck === "%26"){
$htmlurl .= $val."%3Fvos%3Dnrnn00002";
}elseif($valcheck === "%3F"){
$htmlurl .= $val."%26vos%3Dnrnn00002";
}
$htmlurl .= '" target="_blank" rel="nofollow"><img src="//***.com/" height="1" width="0" border="0">求人詳細</a>';
}elseif(strstr($val , 'type.jp' )){
$htmlurl .= '<a href="https://***.net/';
$htmlurl .= $val;
$htmlurl .= '" rel="nofollow" target="_blank">求人詳細<img src="https:***.net/" width="1" height="1" border="0" alt="" /></a>';
}elseif( strstr( $val , 'find-job') ){
$htmlurl .= '<a href="https://***.net/';
$htmlurl .= $val;
$htmlurl .= '" rel="nofollow" target="_blank">求人詳細<img src="https://***.net/" width="1" height="1" border="0" alt="" /></a>';
}elseif( strstr( $val ,'haken.rikunabi' ) ){
$htmlurl .= '<a href="//***.com/';
$htmlurl .= $val."%26aid%3Dmval_00001%26vos%3Dnrnhvccp000050222";
$htmlurl .= '" target="_blank" rel="nofollow"><img src="//***.com/" height="1" width="0" border="0">求人詳細</a>';
}

  }elseif($key === 'carr_app'){
     $htmlapp = $val;
   }elseif($key === 'carr_key'){
     $htmlkey = $val;
   }elseif($key === 'carr_time'){
     $catime = $val;//表示チェック用に先に変数へ代入

     $val = date('Y年n月j日', $val );
     $htmlcatime = $val;
  }

}
}

$rtime = time();
$catime = strtotime('+1 day' , $catime);
$bef_time = strtotime( '-3 day' , $catime );

if( !$htmlaca && !$htmlage ){
$htacage = "-";
}elseif( !$htmlaca && $htmlage ){
$htacage = $htmlage;
}elseif( $htmlaca && !$htmlage ){
$htacage = $htmlaca;
}else{
$htacage =  $htmlaca."、".$htmlage;
}

if(!$htmlkey){
$htmlkey = "-";
}
if(!$htmlovertime){
$htmlovertime = "-";
}
if(!$htmlholy){
$htmlholy = "-"; 
}
if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}

if($catime > $rtime){

echo <<<EOF
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
   <title>{$job['comp_name']}の求人 採用情報</title>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<link href="./css/common.css" rel="stylesheet">

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
    <li class="breadcrumb-item"><a href="?c={$comp_num}">{$job['comp_name']}の評判｜企業情報</a></li>
    <li class="breadcrumb-item">{$job['comp_name']}の求人｜採用情報</li>
  </ul>
</nav>
<div class="card mb-3">
<div class="card-header  clearfix">
<h1 class="h5 p-0 m-0 d-inline">{$job['comp_name']}<span class="h6">の求人｜採用情報</span></h1>
</div>

  <div class="card-body">
<div class="row mb-3">
<div class="col-md-8 mb-3 mb-md-0">
<p class="card-text">企業概要： {$job['comp_info']} </p>
</div>
<div class="col-md-4">
<a href="?c={$comp_num}" class="btn btn-info w-100" >企業情報</a>
</div>

</div>

<div class="card mb-1">
<div class="card-header clearfix">
<h2 class="d-inline h6 m-0 p-0">職種：{$htmlsyok}</h2>
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$htmlsty} </div>
</div>
  <div class="card-body jobacc">
<p class="card-text">仕事内容： {$htmlapp} </p>
<div class="card mb-3">
<div class="card-body">
<p class="card-title font-weight-bold">応募条件</p>
<p class="card-text">学歴・年齢： {$htacage} </p>
<p class="card-text">資格： {$htmlinfo} </p>
<p class="card-text">その他経験： {$htmlkey} </p>
</div>
</div>
<p class="card-text">勤務地： {$htmlplc} </p>
<p class="card-text">給与： {$htmlsal} </p>
<p class="card-text">残業： {$htmlovertime} </p>
<p class="card-text">年間休日： {$htmlholy} </p>
<div class="jobacc">
{$htmlurl}
</div>
</div>
<div class="card-footer clearfix bg-white">
<p class="card-text float-right"><span class="mr-3 text-danger">{$htmlcatime_before}</span></p>
</div>

</div>

</div>
</div>
EOF;
}else{
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
   <title>{$job['comp_name']}の求人 採用情報</title>
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
    <li class="breadcrumb-item"><a href="?c={$comp_num}">{$job['comp_name']}の評判｜企業情報</a></li>
    <li class="breadcrumb-item">{$job['comp_name']}の求人｜採用情報</li>
  </ul>
</nav>

<div class="card mb-3">
<div class="card-header  clearfix">
<h1 class="h5 p-0 m-0 d-inline">{$job['comp_name']}<span class="h6">の求人｜採用情報</span></h1>
</div>

  <div class="card-body">
<div class="row mb-3">
<div class="col-8">
<p class="card-text">企業概要： {$job['comp_info']} </p>
</div>
<div class="col-4">
<a href="?c={$comp_num}" class="btn btn-info w-100" >企業情報</a>
</div>

</div>

<div class="card mb-1 bg-light">
<div class="card-header clearfix">
<h2 class="d-inline h6 m-0 p-0">職種：{$htmlsyok}</h2>
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$htmlsty} </div>
</div>
  <div class="card-body">
<p class="card-text">仕事内容： {$htmlapp} </p>
<div class="card mb-3 bg-light">
<div class="card-body">
<p class="card-title font-weight-bold">応募条件</p>
<p class="card-text">学歴・年齢： {$htmlaca} {$htmlage} </p>
<p class="card-text">資格： {$htmlinfo} </p>
<p class="card-text">その他経験： {$htmlkey} </p>
</div>
</div>
<p class="card-text">勤務地： {$htmlplc} </p>
<p class="card-text">給与： {$htmlsal} </p>
<p class="card-text">残業： {$htmlovertime} </p>
<p class="card-text">年間休日： {$htmlholy} </p>
</div>
<div class="card-footer clearfix bg-light">
<p class="card-text text-center text-danger">この求人は掲載期間が過ぎています。</p>
</div>

</div>

</div>
</div>
EOF;
}

}else{

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
   <title>不正なアクセスです</title>
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

<div class="text-danger">不正なアクセスです。</div>
EOF;


}

$jcom = count( $arr['data']['id'][$i]['job'] );
$jnum = (int)$jnum;


$joco = 0;
for($f = 0; $f < $jcom ; $f++ ){
  
$rtime = time();
$catime = $arr['data']['id'][$i]['job'][$f]['carr_time'];
$catime = strtotime('+1 day' , $catime);

if( $r !== $jnum && $rtime < $catime){
$joco++;
}  
  }

if( $joco != 0){
echo<<< EOF
    <div class="text-center border-top border-bottom py-3 my-3"><h2 class="h6 inline my-0 py-0">{$arr['data']['id'][$i]['corp'][comp_name]}の他の求人</h2></div>
EOF;
  }

for( $r = 0; $r <  $jcom ; $r++){

$rtime = time();
$catime = $arr['data']['id'][$i]['job'][$r]['carr_time'];
$catime = strtotime('+1 day' , $catime);

if( $r !== $jnum && $rtime < $catime){

$htmlapp = $arr['data']['id'][$i]['job'][$r]['carr_app'];
$htmlsty = postdata($arr['data']['id'][$i]['job'][$r]['carr_sty']);
$htmlsyok = postdata($arr['data']['id'][$i]['job'][$r]['carr_syok']);
$htmlplc = postdata($arr['data']['id'][$i]['job'][$r]['carr_plc']);
$htmlsal = postdata($arr['data']['id'][$i]['job'][$r]['carr_sal']);
$htmlcatime = date('Y年n月j日', $arr['data']['id'][$i]['job'][$r]['carr_time']);
$comp_num = $arr['data']['id'][$i]['corp']['num'];

$bef_time = strtotime( '-3 day' , $catime );
if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}

echo <<<EOF

<div class="card mb-3">
   <div class="card-header">
   <div class="row">
   <div class="col-md-10">
   <h2 class="d-inline h6 m-0 p-0">職種：{$htmlsyok}</h2>
   </div>
   <div class="col-md-2">
   <div class="btn btn-outline-primary badge-pill pl-2 pr-2 pb-0 pt-0 m-0">{$htmlsty} </div>
   </div>
   </div>
</div>

  <div class="card-body">
<p class="card-text">業務内容：{$htmlapp} </p>
<div class="jobacc">
<a href="?j={$comp_num}j{$r}" class="btn btn-danger w-100" >採用情報</a>
</div>
</div>
<div class="card-footer clearfix bg-white">
<p class="card-text float-right"><span class="mr-3 text-danger">{$htmlcatime_before}</span></p>
</div>

</div>
EOF;

}
}


//var_dump($arr_sim);
if( !empty($job) ){
//配列から必要ないキーと値を削除していく（単純にunset）
unset($arr_sim['corp']['num']);
unset($arr_sim['corp']['comp_code']);
unset($arr_sim['corp']['comp_review']);
unset($arr_sim['corp']['dom_code']);
unset($arr_sim['corp']['review_val']);
unset($arr_sim['corp']['review_avg']);
unset($arr_sim['corp']['comp_taigu']);
unset($arr_sim['corp']['comp_yukyu']);
unset($arr_sim['corp']['comp_fukuri']);
unset($arr_sim['corp']['comp_syouyo']);
unset($arr_sim['corp']['comp_risyoku']);
unset($arr_sim['corp']['comp_kinzoku']);
unset($arr_sim['corp']['comp_key']);
unset($arr_sim['corp']['comp_name']);

unset($arr_sim['job']['carr_plc']);
unset($arr_sim['job']['carr_info']);
unset($arr_sim['job']['carr_url']);
unset($arr_sim['job']['carr_time']);
unset($arr_sim['job']['carr_check']);
unset($arr_sim['job']['carr_sty']);
unset($arr_sim['job']['carr_sal']);
unset($arr_sim['job']['carr_key']);
unset($arr_sim['job']['carr_acaback']);
unset($arr_sim['job']['carr_age']);
unset($arr_sim['job']['carr_overtime']);
unset($arr_sim['job']['carr_holy']);


//配列からキー・値削除（array_walk）
/*
if(!empty($arr_sim['job'])){
$key_name = "carr_url";
array_walk($arr_sim['job'], "array_col_delete", $key_name);
$key_name = "carr_time";
array_walk($arr_sim['job'], "array_col_delete", $key_name);
$key_name = "carr_check";
array_walk($arr_sim['job'], "array_col_delete", $key_name);
}
*/
//不必要キー・値削除後に文字列作成関数へ
$str_data = this_ars($arr_sim);
//var_dump($str_data);

$ssdc = count($arr['data']['id']);
$rtime = time();
$arrnew = [];

for($i=0;$i<$ssdc ; $i++){

$dds = count($arr['data']['id'][$i]['job']);
for($b=0 ; $b < $dds ; $b++){
//if($arr['data']['id'][$i]['job'][$b]['carr_time'] > $rtime){
$arrn .= $arr['data']['id'][$i]['corp']['comp_info'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_gyo'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_gyokai'];
/*
$arrn .= $arr['data']['id'][$i]['corp']['comp_name'];
$arrn .= postdata($arr['data']['id'][$i]['corp']['comp_key']);
$arrn .= postdata($arr['data']['id'][$i]['corp']['comp_taigu']);
$arrn .= $arr['data']['id'][$i]['corp']['comp_pr'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_yukyu'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_fukuri'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_syouyo'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_risyoku'];
$arrn .= $arr['data']['id'][$i]['corp']['comp_kinzoku'];
$arrn .= $arr['data']['id'][$i]['corp']['dom_code'];
$arrn .= $arr['data']['id'][$i]['corp']['review_avg'];
*/

$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_syok']);
$arrn .= $arr['data']['id'][$i]['job'][$b]['carr_app'];
/*
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_plc']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_info']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_sty']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_sal']);
$arrn .= $arr['data']['id'][$i]['job'][$b]['carr_key'];
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_acaback']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_age']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_overtime']);
$arrn .= postdata($arr['data']['id'][$i]['job'][$b]['carr_holy']);
*/

$arrnew[$i][$b]['num'] = $arr['data']['id'][$i]['corp']['num'];
$arrnew[$i][$b]['carr_num'] = $arr['data']['id'][$i]['corp']['num']."j".$b;
$arrnew[$i][$b]['comp_name'] = $arr['data']['id'][$i]['corp']['comp_name'];
$arrnew[$i][$b]['carr_syok'] = postdata($arr['data']['id'][$i]['job'][$b]['carr_syok']);
$arrnew[$i][$b]['carr_plc'] = postdata($arr['data']['id'][$i]['job'][$b]['carr_plc']);
$arrnew[$i][$b]['carr_sty'] = postdata($arr['data']['id'][$i]['job'][$b]['carr_sty']);
$arrnew[$i][$b]['carr_sal'] = postdata($arr['data']['id'][$i]['job'][$b]['carr_sal']);
$arrnew[$i][$b]['carr_time'] = $arr['data']['id'][$i]['job'][$b]['carr_time'];

$arrnew[$i][$b]['sim'] = $arrn;
$arrn ="";
//}

}

}

$simcount = count($arrnew);
$ngm_t = 0;
$contyo =0;

for($i=0;$i<$simcount;$i++){
$ncont = count($arrnew[$i]);
for($j=0;$j<$ncont;$j++){

$string1 = $str_data;
$string2 = $arrnew[$i][$j]['sim'];

$ngm = sprintf('%02.1f', similar_ngram($string1, $string2) * 100);
$ngm = ceil($ngm);

$contyo++;
$ngm_t += $ngm;
$ngm_arr[] = $ngm;

similar_text( $string1, $string2 ,$sim );
$sim = ceil($sim);

$sim_t += $sim;
$sim_arr[] = $sim;

}
}



$perc = median($ngm_arr);
$ngm_t =  ceil($ngm_t / $contyo);

$sim_arr = median($sim_arr);
$sim_t =  ceil($sim_t / $contyo);

$sim_arr = $sim_arr+10;
$ngm_t = $ngm_t+10;

echo <<<EOF
<div class="text-center border-top border-bottom py-3 my-3"><h2 class="h6 inline my-0 py-0">{$job['comp_name']}の{$htmlsyok}求人と似ている求人</h2></div>
EOF;


for($i=0;$i<$simcount;$i++){
$ncont = count($arrnew[$i]);
for($j=0;$j<$ncont;$j++){

//if($arrnew[$i][$j]['carr_time'] > $rtime){
//比較対象する文字列設定
//比較元文字列
$string1 = $str_data;
//比較先文字列
$string2 = $arrnew[$i][$j]['sim'];

//ngramによる類似度
$ngm = sprintf('%02.1f', similar_ngram($string1, $string2) * 100);
$ngm = ceil($ngm);
//類似度表示部分

similar_text( $string1, $string2 ,$sim );
$sim = ceil($sim);

if($job['comp_name'] !== $arrnew[$i][$j]['comp_name']){
if( $ngm > $ngm_t || $sim > $sim_arr){

$new_sim[] = $arrnew[$i][$j];

}
}

//}

}

}



//var_dump($new_sim);

shuffle($new_sim);
$newcont = count($new_sim);

if($newcont > 5){
  $newcont = 5;
  }

for($i=0;$i<$newcont;$i++){

$simdate = date('Y年n月j日', $new_sim[$i]['carr_time']);

$rtime = time();
$catime = $new_sim[$i]['carr_time'];

$catime = strtotime('+1 day' , $catime);
$bef_time = strtotime( '-3 day' , $catime );

if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}


echo <<<EOF
<div class="card mb-3">
<div class="card-header clearfix"><h2 class="d-inline h6 m-0 p-0">{$new_sim[$i]['comp_name']}</h2>
<div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$new_sim[$i]['carr_sty']} </div>
</div>

<div class="card-body row">
<div class="col-md-9">
<p class="card-text"> 職種：{$new_sim[$i]['carr_syok']} </p>
<p class="card-text">勤務地： {$new_sim[$i]['carr_plc']} </p>
<p class="card-text">給与： {$new_sim[$i]['carr_sal']} </p>
</div>
<div class="col-md-3">
<a href="?c={$new_sim[$i]['num']}" class="btn btn-info mb-3 mt-3 mt-md-0 w-100" >企業情報</a>
<a href="?j={$new_sim[$i]['carr_num']}" class="btn btn-danger mb-3 mt-3 mt-md-0 w-100" >採用情報</a>
</div>
</div>
<div class="card-footer  clearfix bg-white">
<p class="card-text float-right"><span class="mr-3 text-danger">{$htmlcatime_before}</span></p>
</div>
</div>
EOF;

}

}

/*
$arr_str_data = arpr($arr['data']['id']);
$simcount = count($arr_str_data);

for($i=0;$i<$simcount;$i++){
//比較対象する文字列設定
//比較元文字列
$string1 = $str_data;
//比較先文字列
$string2 = $arr_str_data[$i];

//similar_text関数（第3引数はパーセント表示設定）
similar_text( $string1, $string2 ,$sim );
$sim = ceil($sim);
//類似度表示部分
if( $sim > 45){
echo $arr['data']['id'][$i]['corp']['comp_name'].'<br />';
echo  "similar_textの結果は".$sim."％ <br />";
}

}
*/

$prev_cn = $cn-1;
$next_cn = $cn+1;

$prev_compname = $arr['data']['id'][$prev_cn]['corp']['comp_name'];
$prev_compnum = $arr['data']['id'][$prev_cn]['corp']['num'];

$next_compname = $arr['data']['id'][$next_cn]['corp']['comp_name'];
$next_compnum = $arr['data']['id'][$next_cn]['corp']['num'];

if($prev_cn >= 0){
echo <<<EOF
<a href="?c={$prev_compnum}" class="btn btn-info  mb-3 w-100 h-auto arrow_prev" >{$prev_compname}</a>
EOF;
}

if($next_cn < $arrco){
echo <<<EOF
<a href="?c={$next_compnum}" class="btn btn-info mb-3 w-100 h-auto arrow_next" >{$next_compname}</a>
EOF;
}


?>