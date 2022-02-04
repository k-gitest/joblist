<?php
//編集確認画面処理

//バックアップ作成
//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$file = fopen('./***_joball_data1808.json_editback', 'w');
fputs($file, $json);
fclose($file);

//ロック解除
fclose($lock_fp);

echo "編集画面<br />";

$_SESSION['editkey'] = $editkey;
$_SESSION['editchk'] = "true";
$_SESSION['edit_select'] = true;

//編集データの一部表示
$edi_id = $_POST['edit'];
$edi_num = $arr['data']['id'][$editkey]['corp']['num'];
$edi_comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];
$edi_comp_info = $arr['data']['id'][$editkey]['corp']['comp_info'];
$edi_url = postdata_br($arr['data']['id'][$editkey]['job']['carr_url']);
$edi_avg = $arr['data']['id'][$editkey]['corp']['review_avg'];
if( !$edi_avg ){
$edi_avg = " - ";
}

$edi_time = $arr['data']['id'][$editkey]['time'];
$date = date("Y/m/d H:i:s", $arr['data']['id'][$editkey]['time']);
$jobc = count($arr['data']['id'][$editkey]['job']);

echo <<<EOF
<div class="card mb-1">
  <div class="card-body">
<h5 class="card-title">No.{$edi_num} : {$edi_comp_name} </h5>
<p class="card-text">企業概要： {$edi_comp_info} </p>
<ul class="list-inline">
<li class="list-inline-item">登録求人数：{$jobc}件</li>
<li class="list-inline-item">平均評価：{$edi_avg}点</li>
<li class="list-inline-item">登録日時：{$date}</li>
</ul>

<form method="POST" action="" id="form-comp"></form>
       <input type="submit" form="form-comp" class="btn btn-sm btn-primary w-100 mb-3" name="edit" value="企業データを編集する"> 

<form method="POST" action="" id="form-sele"></form>
EOF;

$edicont = count( $arr['data']['id'][$editkey]['job'] );
for( $i = 0; $i < $edicont; $i++){

$jobnumb = $i + 1;

$casyok = postdata($arr['data']['id'][$editkey]['job'][$i]['carr_syok']);
$caplc = postdata($arr['data']['id'][$editkey]['job'][$i]['carr_plc']);
$ca_date = date("Y/m/d", $arr['data']['id'][$editkey]['job'][$i]['carr_time']);

if($arr['data']['id'][$editkey]['job'][$i]['carr_check'] === "完了"){$carr_check = "checked";}else{$carr_check = "";}

if($arr['data']['id'][$editkey]['job'][$i]['carr_check'] === '完了'){
$_SESSION['jobid'] = $i;

//編集チェック
echo <<<EOF
<div class="card mb-3 bg-secondary text-white field">
<div class="card-header">
<div class="form-check form-check-inline mr-1">
  <input form="form-sele" class="form-check-input" type="checkbox" name="carr_check[{$i}]" id="carr_check" value="完了"   {$carr_check}>
</div>
求人登録{$jobnumb}<span class="text-white">*掲載期間が過ぎています</span>

<form method="POST" action="" class="float-right">
<div class="btn-group btn-group-sm float-right">
       <input type="submit" class="btn btn-primary" name="edit" value="求人データを編集する">
       <input type="submit" class="btn btn-danger" value="求人データを削除する" name="edit">
        <input type="hidden" name="jobnum" value="{$i}"> 
</div>
</form>

</div>

<div class="card-body">
<p class="card-text">募集職種： {$casyok} </p>
<p class="card-text">仕事内容： {$arr['data']['id'][$editkey]['job'][$i]['carr_app']} </p>
<p class="card-text">勤務地： {$caplc} </p>

 <div class="form-group">
    <label for="carr_url[{$i}]">求人URL<span class="text-danger">*</span> <a href="{$arr['data']['id'][$editkey]['job'][$i]['carr_url']}" rel="noreferrer noopener" target=”_blank” referrerpolicy="no-referrer" class="btn-sm btn-primary">URLリンク</a> </label>
    <input type="url" form="form-sele" class="form-control form-control-sm" name="carr_url[{$i}]" id="carr_url[{$i}]" placeholder="URL" value="{$arr['data']['id'][$editkey]['job'][$i]['carr_url']}">
  </div>

<div class="timeparent">
   <label for="r_time[{$i}]">掲載期間</label>
<div class="input-group input-group-sm">
       <input type="text" form="form-sele" class="form-control" name="carr_time[{$i}]" id="r_time[{$i}]" placeholder="掲載期間" value="{$ca_date}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn" value="" name="">変更する</button>
  </div>
</div>
</div>

</div>
</div>
EOF;
}else{
echo <<<EOF
<div class="card mb-3 field">
<div class="card-header">
<div class="form-check form-check-inline mr-1">
  <input form="form-sele" class="form-check-input" type="checkbox" name="carr_check[{$i}]" id="carr_check" value="完了"   {$carr_check}>
</div>
求人登録{$jobnumb}

<form method="POST" action="" class="float-right">
<div class="btn-group btn-group-sm float-right">
        <input type="submit" class="btn btn-primary" name="edit" value="求人データを編集する">
        <input type="submit" class="btn btn-danger" value="求人データを削除する" name="edit">
        <input type="hidden" name="jobnum" value="{$i}">
</div>
</form>

</div>

<div class="card-body">
<p class="card-text">募集職種： {$casyok} </p>
<p class="card-text">仕事内容： {$arr['data']['id'][$editkey]['job'][$i]['carr_app']} </p>
<p class="card-text">勤務地： {$caplc} </p>

<div class="form-group">
    <label for="carr_url[{$i}]">求人URL<span class="text-danger">*</span> <a href="{$arr['data']['id'][$editkey]['job'][$i]['carr_url']}" rel="noreferrer noopener" target=”_blank” referrerpolicy="no-referrer" class="btn-sm btn-primary">URLリンク</a> </label>
    <input type="url" form="form-sele" class="form-control form-control-sm" name="carr_url[{$i}]" id="carr_url[{$i}]" placeholder="URL" value="{$arr['data']['id'][$editkey]['job'][$i]['carr_url']}">
  </div>

<div class="timeparent">
   <label for="r_time[{$i}]">掲載期間</label>
<div class="input-group input-group-sm">
       <input type="text" form="form-sele" class="form-control" name="carr_time[{$i}]" id="r_time[{$i}]" placeholder="掲載期間" value="{$ca_date}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn w-100" value="" name="">変更する</button>
  </div>
</div>
</div>

</div>
</div>
EOF;
}


}

echo <<<EOF
<input type="submit" form="form-sele" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行">
<input type="hidden" form="form-sele"name="edit-sele" value="一括編集実行">

<hr />
       <form  method="post" action="">
<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
  <input type="button" class="btn btn-primary w-100" name="btn_back" value="前のページへ戻る" onclick="history.back()">
  <input type="submit" class="btn btn-outline-primary w-100" name="edit" value="求人追加"> 
  <a href="#edinavi" class="btn btn-primary w-100">ページの上へ戻る</a>
</div>

</form>

</div>
</div>
EOF;
?>