<?php

if(isset($arr)){
//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

//編集実行処理
$editkey = $_SESSION["editkey"];
$edicomp = $_SESSION["edit_comp"];
$edijob = $_SESSION["edit_job"];
$jobnum = $_POST['jobnum'];
$edisele = $_SESSION['edit_select'];
$ed = $_POST['edit-sele'];
$ediadd = $_SESSION['edit_add'];
$edijobdel = $_SESSION['edit_jobdel'];

$comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];

unset($_SESSION['editchk']);
unset($_SESSION['editkey']);
unset($_SESSION['edit_comp']);
unset($_SESSION['edit_job']);
unset($_SESSION['edit_add']);
unset($_SESSION['edit_select']);
unset($_POST['jobnum']);
unset($_POST['edit-sele']);

if( $edicomp ){

$args = array(
  'comp_name'  => "",
  'comp_info'     => "",
  'comp_key'  =>  array(
                   'flags'     => FILTER_REQUIRE_ARRAY
                   ),
  'comp_code'  => "",
  'comp_review'  =>  array(
                   'flags'     => FILTER_REQUIRE_ARRAY
                   ),
  'comp_gyo'  => "",
  'comp_gyokai'  => "",
  'comp_taigu'  =>  array(
                   'flags'     => FILTER_REQUIRE_ARRAY
                   ),
  'comp_pr'  => "",
  'comp_yukyu'  => "",
  'comp_fukuri'  => "",
  'comp_syouyo'  => "",
  'comp_risyoku'  => "",
  'comp_kinzoku'  => "",
  'comp_agesal'  => ""
);
$po_name = filter_input_array(INPUT_POST,$args);

foreach($po_name as $key => $val){

foreach($arr['data']['id'][$editkey]['corp'] as $key2 => $val2){

if($key === $key2){

$arr['data']['id'][$editkey]['corp'][$key2] = $val;

}


}
}

echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
<p class="card-text">{$comp_name}の企業データ</p>
<p class="card-text">上記の企業データ編集が完了しました。</p>
</div>
</div>
EOF;
}

if($ediadd){

   $carr_syok = $_POST['carr_syok'];
   $carr_plc = $_POST['carr_plc'];
   $carr_app = $_POST['carr_app'];
   $carr_info = $_POST['carr_info'];
   $carr_sty = $_POST['carr_sty'];
   $carr_sal = $_POST['carr_sal'];
   $carr_key = $_POST['carr_key'];
   $carr_url = $_POST['carr_url'];
   $carr_acaback = $_POST['carr_acaback'];
   $carr_age = $_POST['carr_age'];
   $carr_overtime = $_POST['carr_overtime'];
   $carr_holy = $_POST['carr_holy'];
   $carr_time = $_POST['carr_time'];
   $carr_check = $_POST['carr_check'];

$cn = count($carr_syok);
for( $i = 0; $i < $cn ; $i++ ){

$jobarr[$i]['carr_syok'] = $carr_syok[$i];
$jobarr[$i]['carr_plc'] = $carr_plc[$i];
$jobarr[$i]['carr_app'] = $carr_app[$i];
$jobarr[$i]['carr_info'] = $carr_info[$i];
$jobarr[$i]['carr_sty'] = $carr_sty[$i];
$jobarr[$i]['carr_sal'] = $carr_sal[$i];
$jobarr[$i]['carr_key'] = $carr_key[$i];
$jobarr[$i]['carr_url'] = $carr_url[$i];
$jobarr[$i]['carr_acaback'] = $carr_acaback[$i];
$jobarr[$i]['carr_age'] = $carr_age[$i];
$jobarr[$i]['carr_overtime'] = $carr_overtime[$i];
$jobarr[$i]['carr_holy'] = $carr_holy[$i];
$jobarr[$i]['carr_time'] = strtotime($carr_time[$i]);
$jobarr[$i]['carr_check'] = $carr_check[$i];

}


$jcon = count($arr['data']['id'][$editkey]['job']) +1;

$arr['data']['id'][$editkey]['job'] = array_merge($arr['data']['id'][$editkey]['job'],$jobarr);

$jcon_t = count($arr['data']['id'][$editkey]['job']) +1;
$jb = count($jobarr);

echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
EOF;

for( $i = $jcon ; $i <  $jcon_t; $i++){
echo <<<EOF
<p class="card-text">{$comp_name}の求人ナンバー{$i}</p>
EOF;
}

echo <<<EOF
<p class="card-text">上記{$jb}件の求人追加が完了しました。</p>
</div>
</div>
EOF;
}

if( $edijob ){

   $carr_syok = $_POST['carr_syok'];
   $carr_plc = $_POST['carr_plc'];
   $carr_app = $_POST['carr_app'];
   $carr_info = $_POST['carr_info'];
   $carr_sty = $_POST['carr_sty'];
   $carr_sal = $_POST['carr_sal'];
   $carr_key = $_POST['carr_key'];
   $carr_url = $_POST['carr_url'];
   $carr_acaback = $_POST['carr_acaback'];
   $carr_age = $_POST['carr_age'];
   $carr_overtime = $_POST['carr_overtime'];
   $carr_holy = $_POST['carr_holy'];
   $carr_time = $_POST['carr_time'];
   $carr_check = $_POST['carr_check'];

$cnt = count( $carr_syok );

for( $i = 0; $i < $cnt ; $i++ ){

$arr['data']['id'][$editkey]['job'][$jobnum]['carr_syok'] = $carr_syok[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_plc'] = $carr_plc[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_app'] = $carr_app[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_info'] = $carr_info[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_sty'] = $carr_sty[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_sal'] = $carr_sal[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_key'] = $carr_key[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_url'] = $carr_url[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_acaback'] = $carr_acaback[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_age'] = $carr_age[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_overtime'] = $carr_overtime[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_holy'] = $carr_holy[$i];
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_time'] = strtotime($carr_time[$i]);
$arr['data']['id'][$editkey]['job'][$jobnum]['carr_check'] = $carr_check[$i];

}

$jobnum = $jobnum +1;
echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
<p class="card-text">{$comp_name}の求人ナンバー{$jobnum}</p>
<p class="card-text">上記求人の編集が完了しました。</p>
</div>
</div>
EOF;
}


if( $edisele && $ed === "一括編集実行"){

  $carr_syok = $_POST['carr_syok'];
   $carr_plc = $_POST['carr_plc'];
   $carr_app = $_POST['carr_app'];
   $carr_info = $_POST['carr_info'];
   $carr_sty = $_POST['carr_sty'];
   $carr_sal = $_POST['carr_sal'];
   $carr_key = $_POST['carr_key'];
   $carr_url = $_POST['carr_url'];
   $carr_acaback = $_POST['carr_acaback'];
   $carr_age = $_POST['carr_age'];
   $carr_overtime = $_POST['carr_overtime'];
   $carr_holy = $_POST['carr_holy'];
   $carr_time = $_POST['carr_time'];
   $carr_check = $_POST['carr_check'];

$co_carr = count($arr['data']['id'][$editkey]['job']);
for($i=0;$i<$co_carr;$i++){
if($carr_syok[$i]!==NULL){
$jobarr[$i]['carr_syok'] = $carr_syok[$i];
}else{$jobarr[$i]['carr_syok'] = $arr['data']['id'][$editkey]['job'][$i]['carr_syok'];}
if($carr_plc[$i]!==NULL){
$jobarr[$i]['carr_plc'] = $carr_plc[$i];
}else{$jobarr[$i]['carr_plc'] = $arr['data']['id'][$editkey]['job'][$i]['carr_plc'];}
if($carr_app[$i]!==NULL){
$jobarr[$i]['carr_app'] = $carr_app[$i];
}else{$jobarr[$i]['carr_app'] = $arr['data']['id'][$editkey]['job'][$i]['carr_app'];}
if($carr_info[$i]!==NULL){
$jobarr[$i]['carr_info'] = $carr_info[$i];
}else{$jobarr[$i]['carr_info'] = $arr['data']['id'][$editkey]['job'][$i]['carr_info'];}
if($carr_sty[$i]!==NULL){
$jobarr[$i]['carr_sty'] = $carr_sty[$i];
}else{$jobarr[$i]['carr_sty'] = $arr['data']['id'][$editkey]['job'][$i]['carr_sty'];}
if($carr_sal[$i]!==NULL){
$jobarr[$i]['carr_sal'] = $carr_sal[$i];
}else{$jobarr[$i]['carr_sal'] = $arr['data']['id'][$editkey]['job'][$i]['carr_sal'];}
if($carr_key[$i]!==NULL){
$jobarr[$i]['carr_key'] = $carr_key[$i];
}else{$jobarr[$i]['carr_key'] = $arr['data']['id'][$editkey]['job'][$i]['carr_key'];}
if($carr_url[$i]!==NULL){
$jobarr[$i]['carr_url'] = $carr_url[$i];
}else{$jobarr[$i]['carr_url'] = $arr['data']['id'][$editkey]['job'][$i]['carr_url'];}
if($carr_acaback[$i]!==NULL){
$jobarr[$i]['carr_acaback'] = $carr_acaback[$i];
}else{$jobarr[$i]['carr_acaback'] = $arr['data']['id'][$editkey]['job'][$i]['carr_acaback'];}
if($carr_age[$i]!==NULL){
$jobarr[$i]['carr_age'] = $carr_age[$i];
}else{$jobarr[$i]['carr_age'] = $arr['data']['id'][$editkey]['job'][$i]['carr_age'];}
if($carr_overtime[$i]!==NULL){
$jobarr[$i]['carr_overtime'] = $carr_overtime[$i];
}else{$jobarr[$i]['carr_overtime'] = $arr['data']['id'][$editkey]['job'][$i]['carr_overtime'];}
if($carr_holy[$i]!==NULL){
$jobarr[$i]['carr_holy'] = $carr_holy[$i];
}else{$jobarr[$i]['carr_holy'] = $arr['data']['id'][$editkey]['job'][$i]['carr_holy'];}
if($carr_time[$i]!==NULL){
$jobarr[$i]['carr_time'] = strtotime($carr_time[$i]);
}else{$jobarr[$i]['carr_time'] = $arr['data']['id'][$editkey]['job'][$i]['carr_time'];}
if($carr_check[$i]!==NULL){
$jobarr[$i]['carr_check'] = $carr_check[$i];
}else{$jobarr[$i]['carr_check'] = "";}
}

$arr['data']['id'][$editkey]['job'] = $jobarr;

echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
<p class="card-text">{$comp_name}の求人ナンバー{$jobid}</p>
<p class="card-text">上記求人の一括編集が完了しました。</p>
</div>
</div>
EOF;
}

if($edijobdel){

$jobid = $_POST['jobdel'];

unset( $arr['data']['id'][$editkey]['job'][$jobid] );
$arr['data']['id'][$editkey]['job'] = array_values($arr['data']['id'][$editkey]['job']);

$jobid = $jobid +1;

echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
<p class="card-text">{$comp_name}の求人ナンバー{$jobid}</p>
<p class="card-text">上記求人の削除が完了しました。</p>
</div>
</div>
EOF;
}

$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$file = fopen('./***data1808.json', 'w');
fputs($file, $json);
fclose($file);


$_SESSION = array();
$_POST = array();

//ロック解除
fclose($lock_fp);
}else{
echo 'サーバーが応答しませんでした。';
}

echo <<<EOF
<form method="POST" action="">
<button type="submit" class="btn btn-primary w-100 mb-3" name="edit" value="{$editkey}">{$comp_name}の編集トップへ戻る</button>
<input type="button" class="btn btn-primary w-100 float-right" onclick="location.href='./edit.php'" value="編集トップへ戻る">
</form>
EOF;
?>