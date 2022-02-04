<?php
$editkey = $_SESSION['editkey'];
$_SESSION['edit_job'] = true;

//$jobid = $_SESSION['jobid'];

$jobid = $_POST['jobnum'];

$num = $arr['data']['id'][$editkey]['job'][$jobid];

   $job = $arr['data']['id'][$editkey]['job'];

   $carr_syok = $arr['data']['id'][$editkey]['job'][$jobid]['carr_syok'];
   $carr_plc = $arr['data']['id'][$editkey]['job'][$jobid]['carr_plc'];
   $carr_app = $arr['data']['id'][$editkey]['job'][$jobid]['carr_app'];
   $carr_info = $arr['data']['id'][$editkey]['job'][$jobid]['carr_info'];
   $carr_sty = $arr['data']['id'][$editkey]['job'][$jobid]['carr_sty'];
   $carr_mon = $arr['data']['id'][$editkey]['job'][$jobid]['carr_mon'];
   $carr_sal = $arr['data']['id'][$editkey]['job'][$jobid]['carr_sal'];
   $carr_key = $arr['data']['id'][$editkey]['job'][$jobid]['carr_key'];
   $carr_url = $arr['data']['id'][$editkey]['job'][$jobid]['carr_url'];
   $carr_acaback = $arr['data']['id'][$editkey]['job'][$jobid]['carr_acaback'];
   $carr_age = $arr['data']['id'][$editkey]['job'][$jobid]['carr_age'];
   $carr_overtime = $arr['data']['id'][$editkey]['job'][$jobid]['carr_overtime'];
   $carr_holy = $arr['data']['id'][$editkey]['job'][$jobid]['carr_holy'];
   $carr_check = $arr['data']['id'][$editkey]['job'][$jobid]['carr_check'];
   $carr_time = $arr['data']['id'][$editkey]['job'][$jobid]['carr_time'];
   $carr_time = date("Y/m/d H:i:s",$carr_time);


//selectedの変数初期化
$sele = [];
$carr_count = $jobid + 1;
//セレクト・チェックのデータ設定処理
if(in_array("営業職" , $carr_syok)){ $sele[0] = "selected"; }
if(in_array("販売・サービス職" , $carr_syok)){ $sele[1] = "selected"; }
if(in_array("事務職（一般・総務・人事・企画）" , $carr_syok)){ $sele[2] = "selected"; }
if(in_array("事務職（経理・財務・労務・法務）" , $carr_syok)){ $sele[3] = "selected"; }
if(in_array("事務職（総合職）" , $carr_syok)){ $sele[134] = "selected"; }
if(in_array("事務職（その他）" , $carr_syok)){ $sele[135] = "selected"; }
if(in_array("経営・コンサル・管理職" , $carr_syok)){ $sele[4] = "selected"; }
if(in_array("デザイン・クリエイティブ職" , $carr_syok)){ $sele[5] = "selected"; }
if(in_array("技術職（IT・Web）" , $carr_syok)){ $sele[6] = "selected"; }
if(in_array("技術職（建設）" , $carr_syok)){ $sele[7] = "selected"; }
if(in_array("技術職（機械）" , $carr_syok)){ $sele[8] = "selected"; }
if(in_array("技術職（電気・電子）" , $carr_syok)){ $sele[9] = "selected"; }
if(in_array("技術職（化学・食品・医薬）" , $carr_syok)){ $sele[10] = "selected"; }
if(in_array("技術職（製造・生産）" , $carr_syok)){ $sele[11] = "selected"; }
if(in_array("技術職（総合職）" , $carr_syok)){ $sele[136] = "selected"; }
if(in_array("技術職（その他）" , $carr_syok)){ $sele[137] = "selected"; }
if(in_array("その他の職種" , $carr_syok)){ $sele[138] = "selected"; }


if(in_array("全国エリア" , $carr_plc)){ $sele[12] = "selected"; }
if(in_array("東北エリア" , $carr_plc)){ $sele[13] = "selected"; }
if(in_array("関東エリア" , $carr_plc)){ $sele[14] = "selected"; }
if(in_array("中部エリア" , $carr_plc)){ $sele[15] = "selected"; }
if(in_array("関西エリア" , $carr_plc)){ $sele[16] = "selected"; }
if(in_array("中四国エリア" , $carr_plc)){ $sele[17] = "selected"; }
if(in_array("九州エリア" , $carr_plc)){ $sele[18] = "selected"; }
if(in_array("北海道" , $carr_plc)){ $sele[19] = "selected"; }
if(in_array("青森県" , $carr_plc)){ $sele[20] = "selected"; }
if(in_array("岩手県" , $carr_plc)){ $sele[21] = "selected"; }
if(in_array("宮城県" , $carr_plc)){ $sele[22] = "selected"; }
if(in_array("秋田県" , $carr_plc)){ $sele[23] = "selected"; }
if(in_array("山形県" , $carr_plc)){ $sele[24] = "selected"; }
if(in_array("福島県" , $carr_plc)){ $sele[25] = "selected"; }
if(in_array("茨城県" , $carr_plc)){ $sele[26] = "selected"; }
if(in_array("栃木県" , $carr_plc)){ $sele[27] = "selected"; }
if(in_array("群馬県" , $carr_plc)){ $sele[28] = "selected"; }
if(in_array("埼玉県" , $carr_plc)){ $sele[29] = "selected"; }
if(in_array("千葉県" , $carr_plc)){ $sele[30] = "selected"; }
if(in_array("東京都" , $carr_plc)){ $sele[31] = "selected"; }
if(in_array("神奈川県" , $carr_plc)){ $sele[32] = "selected"; }
if(in_array("新潟県" , $carr_plc)){ $sele[33] = "selected"; }
if(in_array("富山県" , $carr_plc)){ $sele[34] = "selected"; }
if(in_array("石川県" , $carr_plc)){ $sele[35] = "selected"; }
if(in_array("福井県" , $carr_plc)){ $sele[36] = "selected"; }
if(in_array("山梨県" , $carr_plc)){ $sele[37] = "selected"; }
if(in_array("長野県" , $carr_plc)){ $sele[38] = "selected"; }
if(in_array("岐阜県" , $carr_plc)){ $sele[39] = "selected"; }
if(in_array("静岡県" , $carr_plc)){ $sele[40] = "selected"; }
if(in_array("愛知県" , $carr_plc)){ $sele[41] = "selected"; }
if(in_array("三重県" , $carr_plc)){ $sele[42] = "selected"; }
if(in_array("滋賀県" , $carr_plc)){ $sele[43] = "selected"; }
if(in_array("京都府" , $carr_plc)){ $sele[44] = "selected"; }
if(in_array("大阪府" , $carr_plc)){ $sele[45] = "selected"; }
if(in_array("兵庫県" , $carr_plc)){ $sele[46] = "selected"; }
if(in_array("奈良県" , $carr_plc)){ $sele[47] = "selected"; }
if(in_array("和歌山県" , $carr_plc)){ $sele[48] = "selected"; }
if(in_array("鳥取県" , $carr_plc)){ $sele[49] = "selected"; }
if(in_array("島根県" , $carr_plc)){ $sele[50] = "selected"; }
if(in_array("岡山県" , $carr_plc)){ $sele[51] = "selected"; }
if(in_array("広島県" , $carr_plc)){ $sele[52] = "selected"; }
if(in_array("山口県" , $carr_plc)){ $sele[53] = "selected"; }
if(in_array("徳島県" , $carr_plc)){ $sele[54] = "selected"; }
if(in_array("香川県" , $carr_plc)){ $sele[55] = "selected"; }
if(in_array("愛媛県" , $carr_plc)){ $sele[56] = "selected"; }
if(in_array("高知県" , $carr_plc)){ $sele[57] = "selected"; }
if(in_array("福岡県" , $carr_plc)){ $sele[58] = "selected"; }
if(in_array("佐賀県" , $carr_plc)){ $sele[59] = "selected"; }
if(in_array("長崎県" , $carr_plc)){ $sele[60] = "selected"; }
if(in_array("熊本県" , $carr_plc)){ $sele[61] = "selected"; }
if(in_array("大分県" , $carr_plc)){ $sele[62] = "selected"; }
if(in_array("宮崎県" , $carr_plc)){ $sele[63] = "selected"; }
if(in_array("鹿児島県" , $carr_plc)){ $sele[64] = "selected"; }
if(in_array("沖縄県" , $carr_plc)){ $sele[65] = "selected"; }
if(in_array("海外" , $carr_plc)){ $sele[66] = "selected"; }

if(in_array("正社員" , $carr_sty)){ $sele[67] = "selected"; }
if(in_array("契約社員" , $carr_sty)){ $sele[68] = "selected"; }
if(in_array("派遣社員" , $carr_sty)){ $sele[69] = "selected"; }
if(in_array("紹介予定派遣" , $carr_sty)){ $sele[70] = "selected"; }
if(in_array("アルバイト" , $carr_sty)){ $sele[71] = "selected"; }
if(in_array("業務委託" , $carr_sty)){ $sele[72] = "selected"; }
if(in_array("転職エージェント" , $carr_sty)){ $sele[73] = "selected"; }

if(in_array("月給15万円以上" , $carr_sal)){ $sele[74] = "selected"; }
if(in_array("月給20万円以上" , $carr_sal)){ $sele[75] = "selected"; }
if(in_array("月給25万円以上" , $carr_sal)){ $sele[76] = "selected"; }
if(in_array("月給30万円以上" , $carr_sal)){ $sele[77] = "selected"; }
if(in_array("月給35万円以上" , $carr_sal)){ $sele[78] = "selected"; }
if(in_array("月給40万円以上" , $carr_sal)){ $sele[79] = "selected"; }
if(in_array("月給50万円以上" , $carr_sal)){ $sele[80] = "selected"; }
if(in_array("年俸200万円以上" , $carr_sal)){ $sele[81] = "selected"; }
if(in_array("年俸300万円以上" , $carr_sal)){ $sele[82] = "selected"; }
if(in_array("年俸400万円以上" , $carr_sal)){ $sele[83] = "selected"; }
if(in_array("年俸500万円以上" , $carr_sal)){ $sele[84] = "selected"; }
if(in_array("年俸800万円以上" , $carr_sal)){ $sele[85] = "selected"; }
if(in_array("年俸1000万円以上" , $carr_sal)){ $sele[86] = "selected"; }
if(in_array("時給800円以上" , $carr_sal)){ $sele[87] = "selected"; }
if(in_array("時給1000円以上" , $carr_sal)){ $sele[88] = "selected"; }
if(in_array("時給1200円以上" , $carr_sal)){ $sele[89] = "selected"; }
if(in_array("時給1500円以上" , $carr_sal)){ $sele[90] = "selected"; }
if(in_array("時給2000円以上" , $carr_sal)){ $sele[91] = "selected"; }
if(in_array("年収200万円以上" , $carr_sal)){ $sele[92] = "selected"; }
if(in_array("年収300万円以上" , $carr_sal)){ $sele[93] = "selected"; }
if(in_array("年収400万円以上" , $carr_sal)){ $sele[94] = "selected"; }
if(in_array("年収500万円以上" , $carr_sal)){ $sele[95] = "selected"; }
if(in_array("年収800万円以上" , $carr_sal)){ $sele[96] = "selected"; }
if(in_array("年収1000万円以上" , $carr_sal)){ $sele[97] = "selected"; }
if(in_array("日給7000円以上" , $carr_sal)){ $sele[98] = "selected"; }
if(in_array("日給1万円以上" , $carr_sal)){ $sele[99] = "selected"; }
if(in_array("日給1万5000円以上" , $carr_sal)){ $sele[100] = "selected"; }
if(in_array("日給2万円以上" , $carr_sal)){ $sele[101] = "selected"; }
if(in_array("経験・スキルによる" , $carr_sal)){ $sele[102] = "selected"; }

if(!empty($job[$jobid]['carr_acaback'])){
if(in_array("学歴不問" , $carr_acaback)){ $sele[103] = "selected"; }
if(in_array("高卒以上" , $carr_acaback)){ $sele[104] = "selected"; }
if(in_array("高専卒以上" , $carr_acaback)){ $sele[105] = "selected"; }
if(in_array("専門卒以上" , $carr_acaback)){ $sele[106] = "selected"; }
if(in_array("短大卒以上" , $carr_acaback)){ $sele[107] = "selected"; }
if(in_array("大学卒以上" , $carr_acaback)){ $sele[108] = "selected"; }
if(in_array("院卒・修士・博士以上" , $carr_acaback)){ $sele[109] = "selected"; }
if(in_array("既卒・第2新卒" , $carr_acaback)){ $sele[110] = "selected"; }
}
if(!empty($job[$jobid]['carr_age'])){
if(in_array("年齢不問" , $carr_age)){ $sele[111] = "selected"; }
if(in_array("18歳以上" , $carr_age)){ $sele[112] = "selected"; }
if(in_array("30歳以下" , $carr_age)){ $sele[113] = "selected"; }
if(in_array("35歳以下" , $carr_age)){ $sele[114] = "selected"; }
if(in_array("40歳以下" , $carr_age)){ $sele[115] = "selected"; }
if(in_array("45歳以下" , $carr_age)){ $sele[116] = "selected"; }
if(in_array("50歳・60歳以下" , $carr_age)){ $sele[139] = "selected"; }
if(in_array("65歳以下" , $carr_age)){ $sele[140] = "selected"; }
}
if(!empty($job[$jobid]['carr_overtime'])){
if(in_array("残業ほぼ無し" , $carr_overtime)){ $sele[117] = "selected"; }
if(in_array("残業月10h以下" , $carr_overtime)){ $sele[118] = "selected"; }
if(in_array("残業月20h以下" , $carr_overtime)){ $sele[119] = "selected"; }
if(in_array("残業月30h以下" , $carr_overtime)){ $sele[120] = "selected"; }
if(in_array("残業月40h以下" , $carr_overtime)){ $sele[121] = "selected"; }
if(in_array("残業月50h以下" , $carr_overtime)){ $sele[122] = "selected"; }
if(in_array("残業月60h以下" , $carr_overtime)){ $sele[123] = "selected"; }
if(in_array("残業少なめ" , $carr_overtime)){ $sele[124] = "selected"; }
if(in_array("ノー残業デー有り" , $carr_overtime)){ $sele[125] = "selected"; }
}
if(!empty($job[$jobid]['carr_holy'])){
if(in_array("年間休日120日以上" , $carr_holy)){ $sele[126] = "selected"; }
if(in_array("年間休日125日以上" , $carr_holy)){ $sele[127] = "selected"; }
if(in_array("年間休日130日以上" , $carr_holy)){ $sele[128] = "selected"; }
if(in_array("年間休日135日以上" , $carr_holy)){ $sele[129] = "selected"; }
}
if(!empty($job[$jobid]['carr_info'])){
if(in_array("未経験者歓迎" , $carr_info)){ $sele[130] = "checked"; }
if(in_array("経験者歓迎" , $carr_info)){ $sele[131] = "checked"; }
if(in_array("要普免" , $carr_info)){ $sele[132] = "checked"; }
if(in_array("英語力" , $carr_info)){ $sele[133] = "checked"; }
}
if($carr_check === "完了"){ $sele[141] = "checked"; }

$comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];

//求人情報html表示部分
echo <<<EOF
<form method="POST" action="">
<div class="field card mb-3">

 <div class="card-header kyujin_no">
<div class="form-check form-check-inline mr-1">
<input class="form-check-input" type="checkbox" name="carr_check[0]" id="carr_check" value="完了"   {$sele[141]}>
</div>
{$comp_name}の求人登録登録{$carr_count}
</div>

  <div class="card-body">

  <div class="form-row">

   <div class="form-group col-md-3">
      <label for="carr_syok[0]">職種<span class="text-danger">*</span></label>
    <select multiple class="form-control form-control-sm" name="carr_syok[0][]" id="carr_syok[0]">
          <option value="営業職" {$sele[0]}>営業職</option>
          <option value="販売・サービス職" {$sele[1]}>販売・サービス職</option>
          <option value="事務職（一般・総務・人事・企画）" {$sele[2]}>事務職（一般・総務・人事・企画）</option>
          <option value="事務職（経理・財務・労務・法務）" {$sele[3]}>事務職（経理・財務・労務・法務）</option>
          <option value="事務職（総合職）" {$sele[134]}>事務職（総合職）</option>
          <option value="事務職（その他）" {$sele[135]}>事務職（そ の他）</option>
          <option value="経営・コンサル・管理職" {$sele[4]}>経営・コンサル・管理職</option>
          <option value="デザイン・クリエイティブ職" {$sele[5]}>デザイン・クリエイティブ職</option>
          <option value="技術職（IT・Web）" {$sele[6]}>技術職（IT・Web）</option>
          <option value="技術職（建設）" {$sele[7]}>技術職（建設）</option>
          <option value="技術職（機械）" {$sele[8]}>技術職（機械）</option>
          <option value="技術職（電気・電子）" {$sele[9]}>技術職（電気・電子）</option>
          <option value="技術職（化学・食品・医薬）" {$sele[10]}>技術職（化学・食品・医薬）</option>
          <option value="技術職（製造・生産）" {$sele[11]}>技術職（製造・生産）</option>
          <option value="技術職（総合職）" {$sele[136]}>技術職（総合職）</option>
          <option value="技術職（その他）" {$sele[137]}>技術職（その他）</option>
          <option value="その他の職種" {$sele[138]}>その他の職種</option>
</select>
  </div>

  <div class="form-group col-md-3">
    <label for="carr_plc[0]">勤務地<span class="text-danger">*</span></label>
    <select multiple class="form-control form-control-sm" name="carr_plc[0][]" id="carr_plc[0]">
      <option value="全国エリア" {$sele[12]}>全国エリア</option>
      <option value="東北エリア" {$sele[13]}>東北エリア</option>
      <option value="関東エリア" {$sele[14]}>関東エリア</option>
      <option value="中部エリア" {$sele[15]}>中部エリア</option>
      <option value="関西エリア" {$sele[16]}>関西エリア</option>
      <option value="中四国エリア" {$sele[17]}>中四国エリア</option>
      <option value="九州エリア" {$sele[18]}>九州エリア</option>
      <option value="北海道" {$sele[19]}>北海道</option>
      <option value="青森県" {$sele[20]}>青森県</option>
      <option value="岩手県" {$sele[21]}>岩手県</option>
      <option value="宮城県" {$sele[22]}>宮城県</option>
      <option value="秋田県" {$sele[23]}>秋田県</option>
      <option value="山形県" {$sele[24]}>山形県</option>
      <option value="福島県" {$sele[25]}>福島県</option>
      <option value="茨城県" {$sele[26]}>茨城県</option>
      <option value="栃木県" {$sele[27]}>栃木県</option>
      <option value="群馬県" {$sele[28]}>群馬県</option>
      <option value="埼玉県" {$sele[29]}>埼玉県</option>
      <option value="千葉県" {$sele[30]}>千葉県</option>
      <option value="東京都" {$sele[31]}>東京都</option>
      <option value="神奈川県" {$sele[32]}>神奈川県</option>
      <option value="新潟県" {$sele[33]}>新潟県</option>
      <option value="富山県" {$sele[34]}>富山県</option>
      <option value="石川県" {$sele[35]}>石川県</option>
      <option value="福井県" {$sele[36]}>福井県</option>
      <option value="山梨県" {$sele[37]}>山梨県</option>
      <option value="長野県" {$sele[38]}>長野県</option>
      <option value="岐阜県" {$sele[39]}>岐阜県</option>
      <option value="静岡県" {$sele[40]}>静岡県</option>
      <option value="愛知県" {$sele[41]}>愛知県</option>
      <option value="三重県" {$sele[42]}>三重県</option>
      <option value="滋賀県" {$sele[43]}>滋賀県</option>
      <option value="京都府" {$sele[44]}>京都府</option>
      <option value="大阪府" {$sele[45]}>大阪府</option>
      <option value="兵庫県" {$sele[46]}>兵庫県</option>
      <option value="奈良県" {$sele[47]}>奈良県</option>
      <option value="和歌山県" {$sele[48]}>和歌山県</option>
      <option value="鳥取県" {$sele[49]}>鳥取県</option>
      <option value="島根県" {$sele[50]}>島根県</option>
      <option value="岡山県" {$sele[51]}>岡山県</option>
      <option value="広島県" {$sele[52]}>広島県</option>
      <option value="山口県" {$sele[53]}>山口県</option>
      <option value="徳島県" {$sele[54]}>徳島県</option>
      <option value="香川県" {$sele[55]}>香川県</option>
      <option value="愛媛県" {$sele[56]}>愛媛県</option>
      <option value="高知県" {$sele[57]}>高知県</option>
      <option value="福岡県" {$sele[58]}>福岡県</option>
      <option value="佐賀県" {$sele[59]}>佐賀県</option>
      <option value="長崎県" {$sele[60]}>長崎県</option>
      <option value="熊本県" {$sele[61]}>熊本県</option>
      <option value="大分県" {$sele[62]}>大分県</option>
      <option value="宮崎県" {$sele[63]}>宮崎県</option>
      <option value="鹿児島県" {$sele[64]}>鹿児島県</option>
      <option value="沖縄県" {$sele[65]}>沖縄県</option>
      <option value="海外" {$sele[66]}>海外</option>
    </select>
  </div>

 <div class="form-group col-md-3">
    <label for="carr_sty[0]">雇用形態<span class="text-danger">*</span></label>
    <select multiple class="form-control form-control-sm" name="carr_sty[0][]" id="carr_sty[0]">
      <option value="正社員" {$sele[67]}>正社員</option>
      <option value="契約社員" {$sele[68]}>契約社員</option>
      <option value="派遣社員" {$sele[69]}>派遣社員</option>
      <option value="紹介予定派遣" {$sele[70]}>紹介予定派遣</option>
      <option value="アルバイト" {$sele[71]}>アルバイト</option>
      <option value="業務委託" {$sele[72]}>業務委託</option>
      <option value="転職エージェント" {$sele[73]}>転職エージェント</option>
   </select>
  </div>

<div class="form-group  col-md-3">
<label for="carr_sal[0]">給与形態・金額<span class="text-danger">*</span></label>
<select  multiple class="form-control form-control-sm" name="carr_sal[0][]" id="carr_sal[0]">
  <option value="月給15万円以上" data-val="月給" {$sele[74]}>月給15万円以上</option>
  <option value="月給20万円以上" data-val="月給"  {$sele[75]}>月給20万円以上</option>
  <option value="月給25万円以上" data-val="月給"  {$sele[76]}>月給25万円以上</option>
  <option value="月給30万円以上" data-val="月給"  {$sele[77]}>月給30万円以上</option>
  <option value="月給35万円以上" data-val="月給"  {$sele[78]}>月給35万円以上</option>
  <option value="月給40万円以上" data-val="月給"  {$sele[79]}>月給40万円以上</option>
  <option value="月給50万円以上" data-val="月給"  {$sele[80]}>月給50万円以上</option>
  <option value="年俸200万円以上" data-val="年俸"  {$sele[81]}>年俸200万円以上</option>
  <option value="年俸300万円以上" data-val="年俸"  {$sele[82]}>年俸300万円以上</option>
  <option value="年俸400万円以上" data-val="年俸"  {$sele[83]}>年俸400万円以上</option>
  <option value="年俸500万円以上" data-val="年俸"  {$sele[84]}>年俸500万円以上</option>
  <option value="年俸800万円以上" data-val="年俸"  {$sele[85]}>年俸800万円以上</option>
  <option value="年俸1000万円以上" data-val="年俸"  {$sele[86]}>年俸1000万円以上</option>
  <option value="時給800円以上" data-val="時給"  {$sele[87]}>時給800円以上</option>
  <option value="時給1000円以上" data-val="時給"  {$sele[88]}>時給1000円以上</option>
  <option value="時給1200円以上" data-val="時給"  {$sele[89]}>時給1200円以上</option>
  <option value="時給1500円以上" data-val="時給"  {$sele[90]}>時給1500円以上</option>
  <option value="時給2000円以上" data-val="時給"  {$sele[91]}>時給2000円以上</option>
  <option value="年収200万円以上" data-val="年収"  {$sele[92]}>年収200万円以上</option>
  <option value="年収300万円以上" data-val="年収"  {$sele[93]}>年収300万円以上</option>
  <option value="年収400万円以上" data-val="年収"  {$sele[94]}>年収400万円以上</option>
  <option value="年収500万円以上" data-val="年収"  {$sele[95]}>年収500万円以上</option>
  <option value="年収800万円以上" data-val="年収"  {$sele[96]}>年収800万円以上</option>
  <option value="年収1000万円以上" data-val="年収"  {$sele[97]}>年収1000万円以上</option>
  <option value="日給7000円以上" data-val="日給"  {$sele[98]}>日給7000円以上</option>
  <option value="日給1万円以上" data-val="日給"  {$sele[99]}>日給1万円以上</option>
  <option value="日給1万5000円以上" data-val="日給"  {$sele[100]}>日給1万5000円以上</option>
  <option value="日給2万円以上" data-val="日給"  {$sele[101]}>日給2万円以上</option>
  <option value="経験・スキルによる"  {$sele[102]}>経験・スキルによる</option>
</select>
</div>

 </div>

 <div class="form-group">
    <label for="carr_app[0]">仕事内容</label>
    <textarea class="form-control form-control-sm" name="carr_app[0]" id="carr_app[0]" rows="2">{$carr_app}</textarea>
  </div>

  <div class="form-row">

 <div class="form-group col-md-3">
<label for="carr_acaback[0]">最終学歴</label>
<select multiple class="form-control form-control-sm" name="carr_acaback[0][]" id="carr_acaback[0]">
  <option value="学歴不問" {$sele[103]}>学歴不問</option>
  <option value="高卒以上"  {$sele[104]}>高卒以上</option>
  <option value="高専卒以上"  {$sele[105]}>高専卒以上</option>
  <option value="専門卒以上"  {$sele[106]}>専門卒以上</option>
  <option value="短大卒以上"  {$sele[107]}>短大卒以上</option>
  <option value="大学卒以上"  {$sele[108]}>大学卒以上</option>
  <option value="院卒・修士・博士以上"  {$sele[109]}>院卒・修士・博士以上</option>
  <option value="既卒・第2新卒"  {$sele[110]}>既卒・第2新卒</option>
</select>
 </div>

 <div class="form-group col-md-3">
<label for="carr_age[0]">対象年齢</label>
<select multiple class="form-control form-control-sm" name="carr_age[0][]" id="carr_age[0]">
  <option value="年齢不問" {$sele[111]}>年齢不問</option>
  <option value="18歳以上"  {$sele[112]}>18歳以上</option>
  <option value="30歳以下"  {$sele[113]}>30歳以下</option>
  <option value="35歳以下"  {$sele[114]}>35歳以下</option>
  <option value="40歳以下"  {$sele[115]}>40歳以下</option>
  <option value="45歳以下"  {$sele[116]}>45歳以下</option>
  <option value="50歳・60歳以下" {$sele[139]}>50歳・60歳以下</option>
  <option value="65歳以下" {$sele[140]}>65歳以下</option>
</select>
</div>

 <div class="form-group col-md-3">
<label for="carr_overtime[0]">残業時間</label>
<select multiple class="form-control form-control-sm" name="carr_overtime[0][]" id="carr_overtime[0]">
  <option value="残業ほぼ無し" {$sele[117]}>残業ほぼ無し</option>
  <option value="残業月10h以下"  {$sele[118]}>残業月10h以下</option>
  <option value="残業月20h以下"  {$sele[119]}>残業月20h以下</option>
  <option value="残業月30h以下"  {$sele[120]}>残業月30h以下</option>
  <option value="残業月40h以下"  {$sele[121]}>残業月40h以下</option>
  <option value="残業月50h以下"  {$sele[122]}>残業月50h以下</option>
  <option value="残業月60h以下"  {$sele[123]}>残業月60h以下</option>
  <option value="残業少なめ"  {$sele[124]}>残業少なめ</option>
  <option value="ノー残業デー有り"  {$sele[125]}>ノー残業デー有り</option>
</select>
 </div>

 <div class="form-group col-md-3">
<label for="carr_holy[0]">年間休日</label>
<select multiple class="form-control form-control-sm" name="carr_holy[0][]" id="carr_holy[0]">
  <option value="年間休日120日以上" {$sele[126]}>年間休日120日以上</option>
  <option value="年間休日125日以上"  {$sele[127]}>年間休日125日以上</option>
  <option value="年間休日130日以上"  {$sele[128]}>年間休日130日以上</option>
  <option value="年間休日135日以上"  {$sele[129]}>年間休日135日以上</option>
</select>
 </div>

 </div>

 <div class="form-group">
    <label for="carr_key[0]">応募条件・資格など</label>
    <textarea class="form-control form-control-sm" name="carr_key[0]" id="carr_key[0]" rows="2">{$carr_key}</textarea>
  </div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_mikeiken[0]" value="未経験者歓迎" {$sele[130]}>
  <label class="form-check-label" for="carr_info_mikeiken[0]">未経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_keikensya[0]" value="経験者歓迎" {$sele[131]}>
  <label class="form-check-label" for="carr_info_keikensya[0]">経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_drive[0]" value="要普免"  {$sele[132]}>
  <label class="form-check-label" for="carr_info_drive[0]">要普免</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_english[0]" value="英語力"  {$sele[133]}>
  <label class="form-check-label" for="carr_info_english[0]">英語力</label>
</div>

</div>

 <div class="form-group">
    <label for="carr_url[0]">求人URL<span class="text-danger">*</span></label>
    <input type="url" class="form-control form-control-sm" name="carr_url[0]" id="carr_url[0]" placeholder="URL" value="{$carr_url}">
  </div>

<div class="timeparent">
   <label for="r_time[0]">掲載期間</label>
<div class="input-group">
       <input type="text" class="form-control form-control-sm" name="carr_time[0]" id="r_time[0]" placeholder="掲載期間" value="{$carr_time}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn w-100" value="" name="">変更する</button>
  </div>

</div>
</div>


  </div>
  <div class="card-footer text-right">
<button type="button" class="btn btn-primary vclear ml10" value="" name="">初期値に戻す</button>
<button type="button" class="btn btn-primary clearForm ml10" value="" name="">リセット</button>
</div>

</div>

<input type="submit" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行">
<input type="hidden" name="jobnum" value="{$jobid}">

<hr />
<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
  <input type="button" class="btn btn-primary w-100" name="btn_back" value="前のページへ戻る" onclick="history.back()">
  <input type="submit" class="btn btn-outline-primary w-100" name="edit" value="求人追加"> 
  <a href="#edinavi" class="btn btn-primary w-100">ページの上へ戻る</a>
</div>

</form>
EOF;
?>