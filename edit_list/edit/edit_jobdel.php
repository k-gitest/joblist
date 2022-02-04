<?php
	$editkey = $_SESSION['editkey'];
   $_SESSION['edit_jobdel'] = true;

   $jobid = $_POST['jobnum'];

   $num = $arr['data']['id'][$editkey]['job'][$jobid];

   $job = $arr['data']['id'][$editkey]['job'];

   $carr_syok = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_syok'] );
   $carr_plc = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_plc']);
   $carr_app = $arr['data']['id'][$editkey]['job'][$jobid]['carr_app'] ;
   $carr_info = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_info'] );
   $carr_sty = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_sty'] );
   $carr_sal = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_sal'] );
   $carr_key = $arr['data']['id'][$editkey]['job'][$jobid]['carr_key'];
   $carr_url = $arr['data']['id'][$editkey]['job'][$jobid]['carr_url'];
   $carr_acaback = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_acaback'] );
   $carr_age = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_age'] );
   $carr_overtime = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_overtime'] );
   $carr_holy = postdata($arr['data']['id'][$editkey]['job'][$jobid]['carr_holy'] );
   $carr_check = $arr['data']['id'][$editkey]['job'][$jobid]['carr_check'];
   $carr_time = $arr['data']['id'][$editkey]['job'][$jobid]['carr_time'];
   $carr_time = date("Y/m/d H:i:s",$carr_time);

//carr_timeをタイムスタンプからdate型へ変換
$job[$i]['carr_time'] = date("Y/m/d H:i:s",$job[$i]['carr_time']);

$comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];
$jobnum = $jobid + 1;

//求人情報html表示部分
echo <<<EOF
<table class="table table-sm table-striped">
 <thead>
    <tr>
     <th scope="col" colspan="2">{$comp_name}の求人ナンバー{$jobnum} 削除画面</th>
    </tr>
 </thead>
 <tbody>
    <tr>
      <td class="w-25">職種</td>
      <td>{$carr_syok}</td>
   </tr>
    <tr>
      <td class="w-25">勤務地</td>
      <td>{$carr_plc}</td>
   </tr>
    <tr>
      <td class="w-25">雇用形態</td>
      <td>{$carr_sty}</td>
   </tr>
    <tr>
      <td class="w-25">給与</td>
      <td>{$carr_sal}</td>
   </tr>
    <tr>
      <td class="w-25">業務内容</td>
      <td>{$carr_app}</td>
   </tr>
    <tr>
      <td class="w-25">学歴</td>
      <td>{$carr_acaback}</td>
   </tr>
    <tr>
      <td class="w-25">年齢</td>
      <td>{$carr_age}</td>
   </tr>
    <tr>
      <td class="w-25">残業時間</td>
      <td>{$carr_overtime}</td>
   </tr>
    <tr>
      <td class="w-25">年間休日</td>
      <td>{$carr_holy}</td>
   </tr>
    <tr>
      <td class="w-25">経験・資格</td>
      <td>{$carr_info}</td>
   </tr>
    <tr>
      <td class="w-25">応募条件</td>
      <td>{$carr_key}</td>
   </tr>
    <tr>
      <td class="w-25">URL</td>
      <td>{$carr_url}</td>
   </tr>
    <tr>
      <td class="w-25">掲載期間</td>
      <td>{$carr_time}</td>
   </tr>
 </tbody>
</table>

<form method="POST" action="" id="jobdel">
<input type="submit" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行" form="jobdel">

<input type="hidden" name="jobdel" value="{$jobid}" form="jobdel">

<hr />
<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
  <input type="button" class="btn btn-primary w-100" name="btn_back" value="前のページへ戻る" onclick="history.back()">
  <input type="submit" class="btn btn-outline-primary w-100" name="edit" value="求人追加" form="jobdel"> 
  <a href="#edinavi" class="btn btn-primary w-100">ページの上へ戻る</a>
</div>
</form>
EOF;
?>