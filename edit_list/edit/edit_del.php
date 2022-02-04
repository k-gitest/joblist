<?php
//削除確認画面処理
$_SESSION['delkey'] = $delkey;
$_SESSION['delchk'] = "true";
//削除する企業の一部データ表示
$del_corp = $arr['data']['id'][$delkey]['corp'];
$del_job = $arr['data']['id'][$delkey]['job'];

$del_id = $_POST['del'];
$del_num = $del_corp['num'];
$del_comp_name = $del_corp['comp_name'];
$del_comp_info = $del_corp['comp_info']; 
$del_comp_info = postdata($del_comp_info);
$del_comp_key = $del_corp['comp_key'];
$del_comp_key = postdata($del_comp_key);
$del_comp_code = $del_corp['comp_code'];
$del_comp_review = $del_corp['comp_review'];
$del_comp_review = postdata_br($del_comp_review);
$del_comp_gyo = $del_corp['comp_gyo'];
$del_comp_gyokai = $del_corp['comp_gyokai'];
$del_comp_pr = $del_corp['comp_pr'];
$del_comp_yukyu = $del_corp['comp_yukyu'];
$del_comp_fukuri = $del_corp['comp_fukuri'];
$del_comp_syouyo = $del_corp['comp_syouyo'];
$del_comp_risyoku = $del_corp['comp_risyoku'];
$del_comp_kinzoku = $del_corp['comp_kinzoku'];

$del_time = $arr['data']['id'][$delkey]['time'];

$del_job_count = count($del_job);

for( $i=0 ; $i < $del_job_count ; $i++){
$job[$i]['職種'] = $del_job[$i]['carr_syok'];
$job[$i]['勤務地'] = $del_job[$i]['carr_plc'];
$job[$i]['応募資格'] = $del_job[$i]['carr_app'];
$job[$i]['条件特徴'] = $del_job[$i]['carr_info'];
$job[$i]['雇用形態'] = $del_job[$i]['carr_sty'];
$job[$i]['給与形態'] = $del_job[$i]['carr_sal'];
$job[$i]['備考'] = $del_job[$i]['carr_key'];
$job[$i]['求人URL'] = $del_job[$i]['carr_url'];
$job[$i]['学歴'] = $del_job[$i]['carr_acaback'];
$job[$i]['年齢'] = $del_job[$i]['carr_age'];
$job[$i]['残業'] = $del_job[$i]['carr_overtime'];
$job[$i]['年間休日'] = $del_job[$i]['carr_holy'];
}


echo <<<EOF
<div class="card mb-1">
  <div class="card-body">
<h5 class="card-title">削除するid{$del_id} ：{$del_comp_name} </h5>
<p class="card-text"> 削除するNo： {$del_num} </p>
<p class="card-text"> 削除する登録時間： {$del_time} </p>
       <form  method="post" action="">
        <input type="submit" class="btn btn-primary" name="del" value="削除する"> 
        <input type="button" class="btn btn-primary" name="btn_back" value="戻る" onclick="history.back()">
        </form>
EOF;
?>