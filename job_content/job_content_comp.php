<?php

$_SESSION = array();
$_POST = array();
$c = filter_var($_GET['c']);

//企業ナンバーの検索処理
$arrco = count($arr['data']['id']);
for($i = 0; $i < $arrco ; $i++){
if($c === $arr['data']['id'][$i]['corp']['num']){
$cn= $i;
break;//企業ナンバーが合ったら抜ける
}
}


if( isset($cn) ){
$arr_sim['corp'] = $arr['data']['id'][$cn]['corp'];
//企業ナンバーを取得
$comp_num = $arr['data']['id'][$cn]['corp']['num'];
$comp_key = postdata($arr['data']['id'][$cn]['corp']['comp_key']);
$comp_taigu = postdata($arr['data']['id'][$cn]['corp']['comp_taigu']);
//評価点計算処理
$comp_rate = $arr['data']['id'][$cn]['corp']['review_avg'];
$rate = $comp_rate;
if(!empty($comp_rate)){
$comp_rate = ($comp_rate / 5) * 100;//5点満点をパーセント表示計算
$comp_rate = round($comp_rate , 2 );//小数点第2位を四捨五入
}elseif(empty($comp_rate)){
$comp_rate = "-";
$rate = "-";
}

//平均年収・平均年齢表示処理
if(is_array($arr['data']['id'][$cn]['corp']['dom_code'])){
$comp_agesal = postdata($arr['data']['id'][$cn]['corp']['dom_code']);
}elseif(is_string($arr['data']['id'][$cn]['corp']['dom_code']) && $arr['data']['id'][$cn]['corp']['dom_code'] !== ""){
$comp_agesal = $arr['data']['id'][$cn]['corp']['dom_code'];
}elseif($arr['data']['id'][$cn]['corp']['dom_code'] === ""){
$comp_agesal = '-';
}

echo <<<EOF
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="./css/common.css" rel="stylesheet">
   <title>{$arr['data']['id'][$cn]['corp']['comp_name']}の評判 企業情報</title>
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
    <li class="breadcrumb-item">{$arr['data']['id'][$cn]['corp']['comp_name']}の評判 企業情報</li>
  </ul>
</nav>
<div class="card mb-3">
<div itemscope itemtype="http://schema.org/Article" class="company card-header clearfix">
<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
<h1 class="h5 p-0 mb-3"><span id="companyName" itemprop="name">{$arr['data']['id'][$cn]['corp']['comp_name']}</span><span class="h6">の評判｜企業情報</span></h1>
<div class="h5 float-left" style="color:#ff5500;"><span class="label">評判スコア</span></div>
<div class="star-ratings-sprite"><span style="width:{$comp_rate}%" class="star-ratings-sprite-rating"></span></div>
<div class="font-weight-bold h5 m-0 p-0" style="color:#ff5500;"><span itemprop="ratingValue">{$rate}</span>／<span class="h6" itemprop="bestRating">5</span></div>
</div>
</div>
 <div class="card-body">
<p class="card-text">企業概要： {$arr['data']['id'][$cn]['corp']['comp_info']} </p>
<p class="card-text">業種・業界： {$arr['data']['id'][$cn]['corp']['comp_gyo']} {$arr['data']['id'][$i]['corp']['comp_gyokai']} </p>
EOF;

if(!empty($arr['data']['id'][$cn]['corp']['comp_syouyo'])){
$ta_data[] = $arr['data']['id'][$cn]['corp']['comp_syouyo'];
}
if(!empty($arr['data']['id'][$cn]['corp']['comp_fukuri'])){
$ta_data[] = $arr['data']['id'][$cn]['corp']['comp_fukuri'];
}
if(!empty($arr['data']['id'][$cn]['corp']['comp_yukyu'])){
$ta_data[] = $arr['data']['id'][$cn]['corp']['comp_yukyu'];
}
if(!empty($arr['data']['id'][$cn]['corp']['comp_kinzoku'])){
$pr[] = $arr['data']['id'][$cn]['corp']['comp_kinzoku'];
}
if(!empty($arr['data']['id'][$cn]['corp']['comp_risyoku'])){
$pr[] = $arr['data']['id'][$cn]['corp']['comp_risyoku'];
}
if(!empty($arr['data']['id'][$cn]['corp']['comp_pr'])){
$pr[] = $arr['data']['id'][$cn]['corp']['comp_pr'];
}

if(!empty($comp_key)){echo '<p class="card-text">企業特徴： '.$comp_key.' </p>';}
if(!empty($comp_agesal)){echo '<p class="card-text">平均年齢・平均年収： '.$comp_agesal. ' </p>';}
if(!empty($ta_data)){$ta_data = postdata($ta_data);echo '<p class="card-text">待遇： '.$ta_data. ' </p>';}
if(!empty($pr)){$pr = postdata($pr);echo '<p class="card-text">企業PR： '.$pr. ' </p>';}
if(!empty($comp_taigu)){echo '<p class="card-text">会社制度： '.$comp_taigu. ' </p>';}


if(!empty($arr['data']['id'][$cn]['job']) ){
$jobcount = count($arr['data']['id'][$cn]['job']);

$rt = time();

for( $v = 0; $v < $jobcount; $v++ ){
if( $rt < $arr['data']['id'][$cn]['job'][$v]['carr_time'] ){
$ot_ca = 1;
}else{
$ot_carr = 1;
}

}

if( $ot_ca === 1 ){
echo <<<EOF
<div class="text-center border-top border-bottom py-3 my-3"><h2 class="h6 inline my-0 py-0">{$arr['data']['id'][$cn]['corp']['comp_name']}が現在募集中の求人</h2></div>
EOF;
}

for($z = 0; $z < $jobcount; $z++){
$jobno = $z +1;
foreach( $arr['data']['id'][$cn]['job'][$z] as $key => $val ){
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
//変数初期化
$htmlurl = "";
/*
      $htmlurl = $val;   
   $htmlurl = urlencode($htmlurl );
  */
    
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
$htmlurl .= '" target="_blank" rel="nofollow"><img src="//***.com/servlet/gifbanner" height="1" width="0" border="0">求人詳細</a>';
}elseif(strstr($val , 'type.jp' )){
$htmlurl .= '<a href="https://***.net/';
$htmlurl .= $val;
$htmlurl .= '" rel="nofollow" target="_blank">求人詳細<img src="https://***.net/" width="1" height="1" border="0" alt="" /></a>';
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
     $val = date('Y年n月j日', $val );
     $htmlcatime = $val;
   }

}
}

$catime = $arr['data']['id'][$cn]['job'][$z]['carr_time'];
$rtime = time();

$catime = strtotime('+1 day' , $catime);
$c_job = 0;

$bef_time = strtotime( '-3 day' , $catime );
if( $bef_time < $rtime ){
$htmlcatime_before = "掲載終了";
}else{
$htmlcatime_before = "";
}

if($catime > $rtime){
$c_job++;

/*求人ページへのリンク
<a href="?j={$comp_num}j{$z}" class="btn btn-danger w-100" >採用情報</a>
*/

echo <<<EOF

<div class="card mb-3">
   <div class="card-header">
   <div class="row">
   <div class="col-md-10">
   <h2 class="d-inline h6 m-0 p-0">{$arr['data']['id'][$cn]['corp']['comp_name']}の求人</h2> {$htmlsyok}
   </div>
   <div class="col-md-2">
   <div class="btn btn-outline-primary badge-pill pl-2 pr-2 pb-0 pt-0 m-0">{$htmlsty} </div>
   </div>
   </div>
</div>

  <div class="card-body">
<p class="card-text">仕事内容：{$htmlapp} </p>
<p class="card-text">勤務地： {$htmlplc} </p>
<p class="card-text">給与： {$htmlsal} </p>
<div class="jobacc">
{$htmlurl}
</div>
</div>
<div class="card-footer clearfix bg-white">
<p class="card-text float-right"><span class="mr-3 text-danger">{$htmlcatime_before}</span></p>
</div>

</div>

EOF;
}

}


if(!$ot_ca){
echo <<<EOF
<div class="text-center text-danger border-top pt-3">
現在募集を行なっている求人はありません。
</div>
EOF;
}

/*
if( $ot_carr === 1 ){
echo <<<EOF
<div class="text-center border-top border-bottom py-3 my-3"><h2 class="h6 inline my-0 text-danger py-0">{$arr['data']['id'][$cn]['corp']['comp_name']}が過去に募集していた求人</h2></div>
EOF;
}

for($z = 0; $z < $jobcount; $z++){
$jobno = $z +1;
foreach( $arr['data']['id'][$cn]['job'][$z] as $key => $val ){
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
   $htmlurl = $val;
   $htmlurl = urlencode($htmlurl );
   }elseif($key === 'carr_app'){
     $htmlapp = $val;
   }elseif($key === 'carr_key'){
     $htmlkey = $val;
   }elseif($key === 'carr_time'){
     $val = date('Y年n月j日', $val );
     $htmlcatime = $val;
   }

}
}

$catime = $arr['data']['id'][$cn]['job'][$z]['carr_time'];
$rtime = time();

$catime = strtotime('+1 day' , $catime);

if($catime < $rtime){

echo <<<EOF
<div class="card mb-3">
   <div class="card-header clearfix">
   <h2 class="d-inline h6 m-0 p-0">{$arr['data']['id'][$cn]['corp']['comp_name']}の求人 No.{$jobno}</h2>
   <div class="btn btn-outline-primary badge-pill float-right pl-2 pr-2 pb-0 pt-0 m-0">{$htmlsty} </div>
</div>

  <div class="card-body bg-light">
<p class="card-text font-weight-bold">職種：{$htmlsyok} </p>
<p class="card-text">勤務地： {$htmlplc} </p>
<p class="card-text">給与： {$htmlsal} </p>
</div>
<div class="card-footer clearfix">
<p class="card-text text-center text-danger">この求人募集は掲載期間が過ぎています。</p>
</div>

</div>


EOF;

}

}

*/

}elseif(empty($arr['data']['id'][$cn]['job'])){
echo <<<EOF
<div class="card mb-3">
<div class="card-header"><h2 class="d-inline h6 m-0 p-0">{$arr['data']['id'][$cn]['corp']['comp_name']}の求人</h2>
</div>
<div class="card-body">
<div class="w-100 h-100 d-flex align-items-center">
<p class="card-text mx-auto text-danger">現在、求人募集は有りません。</p>
</div>
</div>
</div>


EOF;
}

}elseif(!isset($cn)){
echo <<< EOF
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
    <link href="./css/common.css" rel="stylesheet">
   <title>不正なアクセス</title>
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
<div>
<div>
<div class="text-danger">不正なアクセスです。</div>
EOF;
}

echo <<<EOF
</div>
</div>
EOF;


if( isset($cn) ){
//配列から必要ないキーと値を削除していく（単純にunset）
unset($arr_sim['corp']['num']);
unset($arr_sim['corp']['comp_code']);
unset($arr_sim['corp']['comp_review']);
unset($arr_sim['corp']['dom_code']);
unset($arr_sim['corp']['review_val']);
unset($arr_sim['corp']['review_avg']);
//配列からキー・値削除（array_walk）
/*
$key_name = "job";
array_walk( $arr_sim,  "array_col_delete", $key_name);
*/
//不必要キー・値削除後に文字列作成関数へ
$str_data = this_ars($arr_sim);

$key_name = "job";
array_walk($arr['data']['id'], "array_col_delete", $key_name);

//文章データ作成関数へ
$arr_str_data = arpr($arr['data']['id']);

$simcount = count($arr_str_data);
$ngm_t = 0;
$contyo =0;
//最初に類似値の平均と中央値を求める
for($i=0;$i<$simcount;$i++){

$string1 = $str_data;
$string2 = $arr_str_data[$i];

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


$perc = median($ngm_arr); //中央値を求める関数へ
$ngm_t =  ceil($ngm_t / $contyo);//平均値

$sim_arr = median($sim_arr);
$sim_t =  ceil($sim_t / $contyo);

$sim_arr = $sim_arr+20;
$ngm_t = $ngm_t+20;

echo <<<EOF
<div class="text-center border-top border-bottom py-3 my-3"><h2 class="h6 inline my-0 py-0">{$arr['data']['id'][$cn]['corp']['comp_name']}と似ている会社</h2></div>
EOF;

for($i=0;$i<$simcount;$i++){
//比較対象する文字列設定
//比較元文字列
$string1 = $str_data;
//比較先文字列
$string2 = $arr_str_data[$i];

//ngramによる類似度
$ngm = sprintf('%02.1f', similar_ngram($string1, $string2) * 100);
$ngm = ceil($ngm);
//類似度表示部分
//similar関数による類似度
similar_text( $string1, $string2 ,$sim );
$sim = ceil($sim);

if($arr['data']['id'][$cn]['corp']['comp_name'] !== $arr['data']['id'][$i]['corp']['comp_name']){
if( $ngm > $ngm_t || $sim > $sim_arr){
//$ns_m = $ngm + $sim;
//$arr['data']['id'][$i]['sim_score'] = $ns_m / 2;
$a_sim[] = $arr['data']['id'][$i]; 
}
}



}

//var_dump( $a_sim );
//array_multisort( array_column( $a_sim, "sim_score" ), SORT_DESC, $a_sim ) ;

shuffle($a_sim);

$asimcont = count($a_sim);

if($asimcont > 5){
  $asimcont = 5;
  }

for($i=0;$i<$asimcont;$i++ ){

if( !$a_sim[$i]['corp']['review_avg'] ){
$a_sim[$i]['corp']['review_avg'] = "-";
}

echo <<<EOF
{$a_sim[$i]['sim_score']}
<div class="card mb-3">
<div class="card-header clearfix"><h2 class="d-inline h6 m-0 p-0">{$a_sim[$i]['corp']['comp_name']}</h2>
</div>

<div class="card-body row">
<div class="col-md-9">
<div class="h6 mb-3" style="color:#ff5500;">評判スコア：{$a_sim[$i]['corp']['review_avg']} </div>
<p class="card-text">企業概要：{$a_sim[$i]['corp']['comp_info']} </p>
</div>
<div class="col-md-3">
<a href="?c={$a_sim[$i]['corp']['num']}" class="btn btn-info mb-3 mt-3 mt-md-0 w-100" >企業情報</a>
</div>
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