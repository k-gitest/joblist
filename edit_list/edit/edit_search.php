<?php
$_SESSION = array();
$_POST = array();
if(!empty($_GET['q'])){

foreach ($arr['data'] as $record) {
 foreach ($record as $key => $value) {
  foreach ($value as $value2 => $atai) {

    if( is_array($atai)){
       foreach ($atai as  $value3 => $val4) {
       if(is_array($val4)){
          foreach($val4 as $key2){
           if(is_array($key2)){
            foreach($key2 as $key3 => $val5){
              if(strstr($val5,$searchkey)){
                $schk = 1;
              }
            }
          }elseif(strstr($key2, $searchkey)){
            $schk = 1;
         }
          }
       } else {
            if(strstr($val4, $searchkey)){
              $schk = 1;
            }
       }
        
       }
      } else {
      if(strstr($atai, $searchkey)){
           $schk = 1;
    }

    }

}

//当たり判定があった場合の処理
if( $schk === 1){
$arr['data']['id'][$key]['sid'] = $key;
//当たり判定があったidを取得し新たな配列へ入れる
$s_data[] = $arr['data']['id'][$key];
}

//当たり判定の初期化
$schk = 0;

}
}

}

//検索結果ページ処理
$s_contall = count($s_data);
$s_con_paging = 10;
$s_con_page = $s_contall / $s_con_paging;
$s_con_page = ceil($s_con_page);
$s_page_no = intval($_GET['s_pid']);
if( empty($s_page_no) ){
$s_page_no = 1;
$_GET['s_pid'] = 1;
}

echo "検索語句は".$searchkey."です。<br />";
echo "検索ヒット数は". $s_contall."件です。<br />";
echo "総ページ数は".$s_con_page."ページです。<br />";

//検索結果表示処理
for($i=0; $i < $s_contall ; $i++){
if( $s_page_no * $s_con_paging > $i && $i >= $s_page_no * $s_con_paging - $s_con_paging ){
//企業データ部分表示処理
/*
foreach( $s_data[$i]['corp'] as $key => $val ){
if(is_array($val)){
foreach($val as $key2 => $val2){
echo $key."は".$val2."です。<br />";
}
}else{
echo $key."は".$val."です。<br />";
}

}
*/

//求人部分表示処理
$jobcount = count($s_data[$i]['job']);
/*
for($z = 0; $z < $jobcount; $z++){
foreach( $s_data[$i]['job'][$z] as $key => $val ){
if(is_array($val)){
   foreach($val as $key2 => $val2){
   echo $key.'は'.$val2.'です。<br />';
   }
}else{
echo $key.'は'.$val.'です。<br />';
}

}
}
*/

//登録日時表示
$date = date("Y/m/d H:i:s", $s_data[$i]['time']);
//検索ヒットID
$s_sid = $s_data[$i]["sid"];

$jc = count( $s_data[$i]['job'] );
$ck = 0;

for( $j = 0; $j < $jc ; $j++ ){

if($s_data[$i]['job'][$j]['carr_check'] !== "完了"){
$ck++;
}

}

echo <<<EOF
<div class="card mb-1">
  <div class="card-body row">
<div class="col-12">
<h5 class="card-title">id {$s_data[$i]['sid']}：{$s_data[$i]['corp']['comp_name']} </h5>
</div>
<div class="col-9">
<p class="card-text mb-2">求人数： {$jobcount} </p>
<p class="card-text mb-2">有効求人： {$ck} </p>
<p class="card-text">登録日時： {$date} </p>
</div>
<div class="col-3">
        <form  method="post" action="">
        <button type='submit' class="btn btn-primary w-100 mb-3" name='edit' value='{$s_sid}'>編集</button>
        <button type='submit' class="btn btn-danger w-100" name='del' value='{$s_sid}'>削除</button>
       </form>
</div>

 </div>
</div>
EOF;



}
}

//検索結果ページャー処理
echo <<<EOF
<nav aria-label="...">
  <ul class="pagination justify-content-center">
EOF;

if($s_page_no > 1 ){
$p_prev = $s_page_no -1;
echo "<li class='page-item'><a href='?q={$searchkey}&s_pid={$p_prev}' class='page-link'>前のページへ</a></li>";
}

for($i=1 ; $i <= $s_con_page ; $i++){

if( $s_page_no === $i){
echo "<li class='page-item active'><span class='page-link'>".$i."</span></li>";
} else {
echo "<li class='page-item'><a href='?q={$searchkey}&s_pid={$i}' class='page-link'>$i</a></li>";
}

}

if( $s_page_no < $s_con_page){
$p_next = $s_page_no + 1;
echo "<li class='page-item'><a href='?q={$searchkey}&s_pid={$p_next}' class='page-link'>次のページへ</a></li>";
}

echo <<<EOF
  </ul>
</nav>
EOF;

$_GET['q'] = array();
?>