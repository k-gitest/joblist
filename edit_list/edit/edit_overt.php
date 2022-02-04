<?php

echo '締め切り検索結果<br />';
$arcon = count($arr['data']['id']);

for($i =0; $i < $arcon; $i++ ){

$jcon = count($arr['data']['id'][$i]['job']);

for($t=0;$t < $jcon;$t++ ){
$ctime = $arr['data']['id'][$i]['job'][$t]['carr_time'];
$rtime = time();

$ctime = strtotime('+1 day' , $ctime);

$ca_ck = $arr['data']['id'][$i]['job'][$t]['carr_check'];

if( $ctime < $rtime && $ca_ck !== "完了"){
$arr['data']['id'][$i]['ovt_id'] =  $i;
$overt[] = $arr['data']['id'][$i];
break;
}

}

}



//var_dump($overt);
$ovt = count($overt);

echo '締め切り期限切れの求人企業件数は'.$ovt.'件です。<br />';

for($e=0;$e<$ovt;$e++){

$ock = count($overt[$e]['job']);
$on = 0;

for( $t =0; $t < $ock ; $t++ ){
if( $overt[$e]['job'][$t]['carr_check'] !== "完了" ){
$on++;
}
}


echo <<<EOF
<div class="card mb-1">
  <div class="card-body">
<div class="row">
<div class="col-9">
<h5 class="card-title">id{$overt[$e]['ovt_id']} : {$overt[$e]['corp']['comp_name']} </h5>
<p class="card-text">求人数：{$on}／{$ock} </p>
</div>
<div class="col-3">
      <form  method="post" action="">
        <button type='submit' class="btn btn-danger w-100 pt-3 pb-3" name='edit' value='{$overt[$e]['ovt_id']}'>編集</button>
      </form>
</div>

</div>

</div>
</div>
EOF;

}
?>