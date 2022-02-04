<?php elseif(isset($editkey) &&  $editkey !== "編集実行"): ?>

<?php

if(isset($arr)){
//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

//編集処理実行前にバックアップを作成する
$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$file = fopen('./***.json_editback', 'w');
fputs($file, $json);
fclose($file);

//ロック解除
fclose($lock_fp);
}else{
echo 'サーバーが応答しませんでした。<br />';
}

//編集画面・編集データ表示処理
   $editkey = $_SESSION['editkey'];
   $num = $arr['data']['id'][$editkey]['corp']['num'];
   $comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];
   $comp_info = $arr['data']['id'][$editkey]['corp']['comp_info'];
   $comp_key = $arr['data']['id'][$editkey]['corp']['comp_key'];
   $comp_gyo = $arr['data']['id'][$editkey]['corp']['comp_gyo'];
   $comp_gyokai = $arr['data']['id'][$editkey]['corp']['comp_gyokai'];
   $comp_taigu = $arr['data']['id'][$editkey]['corp']['comp_taigu'];
   $comp_code = $arr['data']['id'][$editkey]['corp']['comp_code'];
   $comp_yukyu = $arr['data']['id'][$editkey]['corp']['comp_yukyu'];
   $comp_pr = $arr['data']['id'][$editkey]['corp']['comp_pr'];
   $comp_review = $arr['data']['id'][$editkey]['corp']['comp_review'];
   $comp_fukuri = $arr['data']['id'][$editkey]['corp']['comp_fukuri'];
   $comp_syouyo = $arr['data']['id'][$editkey]['corp']['comp_syouyo'];
   $comp_risyoku = $arr['data']['id'][$editkey]['corp']['comp_risyoku'];
   $comp_kinzoku = $arr['data']['id'][$editkey]['corp']['comp_kinzoku'];
   $dom_code = $arr['data']['id'][$editkey]['corp']['dom_code'];

   $job = $arr['data']['id'][$editkey]['job'];

   $carr_syok = $arr['data']['id'][$editkey]['job']['carr_syok'];
   $carr_plc = $arr['data']['id'][$editkey]['job']['carr_plc'];
   $carr_app = $arr['data']['id'][$editkey]['job']['carr_app'];
   $carr_info = $arr['data']['id'][$editkey]['job']['carr_info'];
   $carr_sty = $arr['data']['id'][$editkey]['job']['carr_sty'];
   $carr_mon = $arr['data']['id'][$editkey]['job']['carr_mon'];
   $carr_sal = $arr['data']['id'][$editkey]['job']['carr_sal'];
   $carr_key = $arr['data']['id'][$editkey]['job']['carr_key'];
   $carr_url = $arr['data']['id'][$editkey]['job']['carr_url'];
   $carr_acaback = $arr['data']['id'][$editkey]['job']['carr_acaback'];
   $carr_age = $arr['data']['id'][$editkey]['job']['carr_age'];
   $carr_overtime = $arr['data']['id'][$editkey]['job']['carr_overtime'];
   $carr_holy = $arr['data']['id'][$editkey]['job']['carr_holy'];
   $carr_check = $arr['data']['id'][$editkey]['job']['carr_check'];
   
   $carr_time = $arr['data']['id'][$editkey]['job']['carr_time'];
   

   $time = $arr['data']['id'][$editkey]['time'];
   $date = date("Y/m/d H:i:s",$time);

?>

<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
<a href="#jobcard" class="btn btn-primary w-100">求人情報へ</a>
<a href="#kako" class="btn btn-outline-primary w-100">過去求人へ</a>
<a href="#editbutton" class="btn btn-outline-primary w-100">編集実行ボタンへ</a>
<a href="#edifoot" class="btn btn-primary w-100">ページ下へ</a>
</div>

<form method="post" action="">

<div class="form-group">
    <label for="comp_name">企業名<span class="text-danger">*</span></label>
    <input type="text" name="comp_name" class="form-control" id="comp_name" placeholder="企業名" value="<?php echo $comp_name ?>" >
  </div>
<div class="form-group">
    <label for="comp_info">企業概要</label>
    <input type="text" name="comp_info" class="form-control" id="comp_info" placeholder="企業概要" value="<?php echo $comp_info ?>">
  </div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_jou" value="上場企業" <?php if(in_array("上場企業" ,(array)$comp_key,true)){ echo "checked"; } ?> >
  <label class="form-check-label" for="comp_key_jou">上場企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_gaisi" value="外資系企業" <?php if(in_array("外資系企業" , (array)$comp_key,true)){ echo "checked"; } ?> >
  <label class="form-check-label" for="comp_key_gaisi">外資系企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_hijou" value="非上場大手企業" <?php if(in_array("非上場大手企業" , (array)$comp_key,true)){ echo "checked"; } ?>>
  <label class="form-check-label" for="comp_key_hijou">非上場大手企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_group" value="グループ企業" <?php if(in_array("グループ企業" , (array)$comp_key,true)){ echo "checked"; } ?>>
  <label class="form-check-label" for="comp_key_group">グループ企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_cyusyo" value="中小企業" <?php if(in_array("中小企業" , (array)$comp_key,true)){ echo "checked"; } ?>>
  <label class="form-check-label" for="comp_key_cyusyo">中小企業</label>
</div>

</div>

  <div class="form-row">

<div class="form-group col-md-3">
    <label for="comp_code">証券コード</label>
    <input type="text" name="comp_code" class="form-control" id="comp_code" placeholder="証券コード" value="<?php echo $comp_code ?>">
  </div>

<div class="form-group col-md-3">
    <label for="comp_gyo">業種</label>
    <select class="form-control" name="comp_gyo" id="comp_gyo">
<option value="">選択してください</option>
<option value="メーカー・製造業" <?php if("メーカー・製造業" === $comp_gyo){ echo "selected"; } ?> >メーカー・製造業</option>
<option value="建築・設備業" <?php if("建築・設備業" === $comp_gyo){ echo "selected"; } ?> >建築・設備業</option>
<option value="流通・小売業" <?php if("流通・小売業" === $comp_gyo){ echo "selected"; } ?> >流通・小売業</option>
<option value="専門商社・総合商社" <?php if("専門商社・総合商社" === $comp_gyo){ echo "selected"; } ?> >専門商社・総合商社</option>
<option value="農林水産業" <?php if("農林水産業" === $comp_gyo){ echo "selected"; } ?> >農林水産業</option>
<option value="物流・運輸業" <?php if("物流・運輸業" === $comp_gyo){ echo "selected"; } ?> >物流・運輸業</option>
<option value="広告・放送・新聞・出版" <?php if("広告・放送・新聞・出版" === $comp_gyo){ echo "selected"; } ?> >広告・放送・新聞・出版</option>
<option value="金融業・保険・不動産業" <?php if("金融業・保険・不動産業" === $comp_gyo){ echo "selected"; } ?> >金融業・保険・不動産業</option>
<option value="IT・情報通信業" <?php if("IT・情報通信業" === $comp_gyo){ echo "selected"; } ?> >IT・情報通信業</option>
<option value="サービス・インフラ・運輸業" <?php if("サービス・インフラ・運輸業" === $comp_gyo){ echo "selected"; } ?> >サービス・インフラ・運輸業</option>
<option value="市場調査・研究機関" <?php if("市場調査・研究機関" === $comp_gyo){ echo "selected"; } ?> >市場調査・研究機関</option>
<option value="公社・官公庁・自治体・団体・教育機関" <?php if("公社・官公庁・自治体・団体・教育機関" === $comp_gyo){ echo "selected"; } ?> >公社・官公庁・自治体・団体・教育機関</option>
<option value="病院・医療機関" <?php if("病院・医療機関" === $comp_gyo){ echo "selected"; } ?> >病院・医療機関</option>
   </select>
  </div>

<div class="form-group col-md-3">
    <label for="comp_gyokai">業界</label>
    <select class="form-control" name="comp_gyokai" id="comp_gyokai">
<option value="">選択してください</option>
<option value="自動車・二輪車業界" <?php if("自動車・二輪車業界" === $comp_gyokai){ echo "selected"; } ?> >自動車・二輪車業界</option>
<option value="鉄道業界" <?php if("鉄道業界" === $comp_gyokai){ echo "selected"; } ?> >鉄道業界</option>
<option value="航空・海運業界" <?php if("航空・海運業界" === $comp_gyokai){ echo "selected"; } ?> >航空・海運業界</option>
<option value="倉庫・運送業界" <?php if("倉庫・運送業界" === $comp_gyokai){ echo "selected"; } ?> >倉庫・運送業界</option>
<option value="食品・飲料・菓子業界" <?php if("食品・飲料・菓子業界" === $comp_gyokai){ echo "selected"; } ?> >食品・飲料・菓子業界</option>
<option value="電機・半導体・電子部品業界" <?php if("電機・半導体・電子部品業界" === $comp_gyokai){ echo "selected"; } ?> >電機・半導体・電子部品業界</option>
<option value="医療機器・精密機器業界" <?php if("医療機器・精密機器業界" === $comp_gyokai){ echo "selected"; } ?> >医療機器・精密機器業界</option>
<option value="建機・重機・工作機械業界" <?php if("建機・重機・工作機械業界" === $comp_gyokai){ echo "selected"; } ?> >建機・重機・工作機械業界</option>
<option value="石油・電力・ガス業界" <?php if("石油・電力・ガス業界" === $comp_gyokai){ echo "selected"; } ?> >石油・電力・ガス業界</option>
<option value="化学・製薬業界" <?php if("化学・製薬業界" === $comp_gyokai){ echo "selected"; } ?> >化学・製薬業界</option>
<option value="鉄鋼・非鉄金属・繊維・素材業界" <?php if("鉄鋼・非鉄金属・繊維・素材業界" === $comp_gyokai){ echo "selected"; } ?> >鉄鋼・非鉄金属・繊維・素材業界</option>
<option value="旅行・ホテル・レジャー業界" <?php if("旅行・ホテル・レジャー業界" === $comp_gyokai){ echo "selected"; } ?> >旅行・ホテル・レジャー業界</option>
<option value="アパレル・インテリア業界" <?php if("アパレル・インテリア業界" === $comp_gyokai){ echo "selected"; } ?> >アパレル・インテリア業界</option>
<option value="ゲーム・玩具・雑貨業界" <?php if("ゲーム・玩具・雑貨業界" === $comp_gyokai){ echo "selected"; } ?> >ゲーム・玩具・雑貨業界</option>
<option value="百貨店・スーパー・飲食業界" <?php if("百貨店・スーパー・飲食業界" === $comp_gyokai){ echo "selected"; } ?> >百貨店・スーパー・飲食業界</option>
<option value="Webサービス・ネット通販業界" <?php if("Webサービス・ネット通販業界" === $comp_gyokai){ echo "selected"; } ?> >Webサービス・ネット通販業界</option>
    </select>
  </div>

<div class="form-group col-md-3">
    <label for="comp_taigu">会社制度</label>
<select multiple class="form-control" name="comp_taigu[]" id="comp_taigu">
<option value="">選択してください</option>
  <option value="正社員登用・無期転換" <?php if(in_array("正社員登用・無期転換" , (array)$comp_taigu,true )){ echo "selected"; } ?>>正社員登用・無期転換</option>
  <option value="退職金制度" <?php if(in_array("退職金制度" , (array)$comp_taigu,true )){ echo "selected"; } ?>>退職金制度</option>
  <option value="転勤無し・地域限定" <?php if(in_array("転勤無し・地域限定" , (array)$comp_taigu,true )){ echo "selected"; } ?>>転勤無し・地域限定</option>
  <option value="在宅勤務" <?php if(in_array("在宅勤務" , (array)$comp_taigu,true )){ echo "selected"; } ?>>在宅勤務</option>
  <option value="産休・育休" <?php if(in_array("産休・育休" , (array)$comp_taigu,true )){ echo "selected"; } ?>>産休・育休</option>
  <option value="週休3日制" <?php if(in_array("週休3日制" , (array)$comp_taigu,true )){ echo "selected"; } ?>>週休3日制</option>
  <option value="プレミアムフライデー" <?php if(in_array("プレミアムフライデー" , (array)$comp_taigu,true )){ echo "selected"; } ?>>プレミアムフライデー</option>
  </select>
</div>

</div>

<div class="form-group">
    <label for="comp_agesal">平均年齢・平均年収</label>
    <input type="text" name="comp_agesal" class="form-control" id="comp_agesal" placeholder="平均年齢・平均年収" value="<?php echo $dom_code ?>">
  </div>

<div class="form-row">

<div class="form-group col-md-3">
<label for="comp_kinzoku">勤続年数</label>
<select class="form-control" name="comp_kinzoku" id="comp_kinzoku">
<option value="">選択してください</option>
<option value="平均勤続年数5年以上" <?php if("平均勤続年数5年以上" === $comp_kinzoku){ echo "selected"; } ?> >平均勤続年数5年以上</option>
<option value="平均勤続年数10年以上" <?php if("平均勤続年数10年以上" === $comp_kinzoku){ echo "selected"; } ?> >平均勤続年数10年以上</option>
<option value="平均勤続年数15年以上" <?php if("平均勤続年数15年以上" === $comp_kinzoku){ echo "selected"; } ?> >平均勤続年数15年以上</option>
<option value="平均勤続年数20年以上" <?php if("平均勤続年数20年以上" === $comp_kinzoku){ echo "selected"; } ?> >平均勤続年数20年以上</option>
<option value="平均勤続年数25年以上" <?php if("平均勤続年数25年以上" === $comp_kinzoku){ echo "selected"; } ?> >平均勤続年数25年以上</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_risyoku">離職率</label>
<select class="form-control" name="comp_risyoku" id="comp_risyoku">
<option value="">選択してください</option>
<option value="離職率1％以下" <?php if("離職率1％以下" === $comp_risyoku){ echo "selected"; } ?> >離職率1％以下</option>
<option value="離職率5％以下" <?php if("離職率5％以下" === $comp_risyoku){ echo "selected"; } ?> >離職率5％以下</option>
<option value="離職率10％以下" <?php if("離職率10％以下" === $comp_risyoku){ echo "selected"; } ?> >離職率10％以下</option>
<option value="離職率15％以下" <?php if("離職率15％以下" === $comp_risyoku){ echo "selected"; } ?> >離職率15％以下</option>
<option value="離職率20％以下" <?php if("離職率20％以下" === $comp_risyoku){ echo "selected"; } ?> >離職率20％以下</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_syouyo">賞与</label>
<select class="form-control" name="comp_syouyo" id="comp_syouyo">
<option value="">選択してください</option>
<option value="賞与4ヶ月以上" <?php if("賞与4ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与4ヶ月以上</option>
<option value="賞与5ヶ月以上" <?php if("賞与5ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与5ヶ月以上</option>
<option value="賞与6ヶ月以上" <?php if("賞与6ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与6ヶ月以上</option>
<option value="賞与7ヶ月以上" <?php if("賞与7ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与7ヶ月以上</option>
<option value="賞与8ヶ月以上" <?php if("賞与8ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与8ヶ月以上</option>
<option value="賞与9ヶ月以上" <?php if("賞与9ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与9ヶ月以上</option>
<option value="賞与10ヶ月以上" <?php if("賞与10ヶ月以上" === $comp_syouyo){ echo "selected"; } ?> >賞与10ヶ月以上</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_fukuri">福利厚生</label>
<select class="form-control" name="comp_fukuri" id="comp_fukuri">
<option value="">選択してください</option>
<option value="手当幾つか有り" <?php if("手当幾つか有り" === $comp_fukuri){ echo "selected"; } ?> >手当幾つか有り</option>
<option value="福利厚生幾つか有り" <?php if("福利厚生幾つか有り" === $comp_fukuri){ echo "selected"; } ?> >福利厚生幾つか有り</option>
<option value="手当・福利厚生幾つか有り" <?php if("手当・福利厚生幾つか有り" === $comp_fukuri){ echo "selected"; } ?> >手当・福利厚生幾つか有り</option>
<option value="福利厚生有り" <?php if("福利厚生有り" === $comp_fukuri){ echo "selected"; } ?> >福利厚生有り</option>
<option value="福利厚生良い" <?php if("福利厚生良い" === $comp_fukuri){ echo "selected"; } ?> >福利厚生良い</option>
</select>
</div>

</div>

 <div class="form-group">
    <label for="comp_yukyu">有給休暇取得率・消化率・日数</label>
    <textarea class="form-control" name="comp_yukyu" id="comp_yukyu" rows="1"><?php echo $comp_yukyu ?></textarea>
  </div>

 <div class="form-group">
    <label for="comp_pr">企業情報PR</label>
    <textarea class="form-control" name="comp_pr" id="comp_pr" rows="2"><?php echo $comp_pr ?></textarea>
  </div>

<div class="urlparent">
   <label for="comp_review">口コミ評価URL</label>

<?php
//評価URLhtml表示処理
if(is_array($comp_review)){
foreach($comp_review as $key => $val){

echo <<<EOF
<div class="urlfield mb-3">

<div class="input-group">
       <input type="text" name="comp_review[{$key}]" class="form-control" id="comp_review" placeholder="口コミ評価URL" value="{$val}" >
<div class="input-group-append">
<button type="button" class="btn btn-primary trash_review_btn w-100" value="" name="">削除</button>
  </div>
</div>

</div>
EOF;

}

}

?>

</div>

<div class="text-right mb-3">
<button type="button" class="btn btn-primary add_review_btn w-100" value="" name="">URL追加</button>
</div>

<div class="card p-2 mb-3">
<div class="parent pagein" id="jobcard">


<?php
//求人データ表示処理開始
$jcon = count($job);//求人数を取得
$rtime = time();
$karacon = 0;
for($i = 0; $i < $jcon;$i++){
if( $job[$i]['carr_time'] < $rtime ){
$karacon++;
}
}

for($i = 0; $i < $jcon;$i++){//求人件数を1データ毎に表示する
if( $job[$i]['carr_time'] > $rtime ){

//selectedの変数初期化
$sele = [];
$carr_count = $i + 1;
//セレクト・チェックのデータ設定処理
if(in_array("営業職" , $job[$i]['carr_syok'])){ $sele[0] = "selected"; }
if(in_array("販売・サービス職" , $job[$i]['carr_syok'])){ $sele[1] = "selected"; }
if(in_array("事務職（一般・総務・人事・企画）" , $job[$i]['carr_syok'])){ $sele[2] = "selected"; }
if(in_array("事務職（経理・財務・労務・法務）" , $job[$i]['carr_syok'])){ $sele[3] = "selected"; }
if(in_array("事務職（総合職）" , $job[$i]['carr_syok'])){ $sele[134] = "selected"; }
if(in_array("事務職（その他）" , $job[$i]['carr_syok'])){ $sele[135] = "selected"; }
if(in_array("経営・コンサル・管理職" , $job[$i]['carr_syok'])){ $sele[4] = "selected"; }
if(in_array("デザイン・クリエイティブ職" , $job[$i]['carr_syok'])){ $sele[5] = "selected"; }
if(in_array("技術職（IT・Web）" , $job[$i]['carr_syok'])){ $sele[6] = "selected"; }
if(in_array("技術職（建設）" , $job[$i]['carr_syok'])){ $sele[7] = "selected"; }
if(in_array("技術職（機械）" , $job[$i]['carr_syok'])){ $sele[8] = "selected"; }
if(in_array("技術職（電気・電子）" , $job[$i]['carr_syok'])){ $sele[9] = "selected"; }
if(in_array("技術職（化学・食品・医薬）" , $job[$i]['carr_syok'])){ $sele[10] = "selected"; }
if(in_array("技術職（製造・生産）" , $job[$i]['carr_syok'])){ $sele[11] = "selected"; }
if(in_array("技術職（総合職）" , $job[$i]['carr_syok'])){ $sele[136] = "selected"; }
if(in_array("技術職（その他）" , $job[$i]['carr_syok'])){ $sele[137] = "selected"; }
if(in_array("その他の職種" , $job[$i]['carr_syok'])){ $sele[138] = "selected"; }


if(in_array("全国エリア" , $job[$i]['carr_plc'])){ $sele[12] = "selected"; }
if(in_array("東北エリア" , $job[$i]['carr_plc'])){ $sele[13] = "selected"; }
if(in_array("関東エリア" , $job[$i]['carr_plc'])){ $sele[14] = "selected"; }
if(in_array("中部エリア" , $job[$i]['carr_plc'])){ $sele[15] = "selected"; }
if(in_array("関西エリア" , $job[$i]['carr_plc'])){ $sele[16] = "selected"; }
if(in_array("中四国エリア" , $job[$i]['carr_plc'])){ $sele[17] = "selected"; }
if(in_array("九州エリア" , $job[$i]['carr_plc'])){ $sele[18] = "selected"; }
if(in_array("北海道" , $job[$i]['carr_plc'])){ $sele[19] = "selected"; }
if(in_array("青森県" , $job[$i]['carr_plc'])){ $sele[20] = "selected"; }
if(in_array("岩手県" , $job[$i]['carr_plc'])){ $sele[21] = "selected"; }
if(in_array("宮城県" , $job[$i]['carr_plc'])){ $sele[22] = "selected"; }
if(in_array("秋田県" , $job[$i]['carr_plc'])){ $sele[23] = "selected"; }
if(in_array("山形県" , $job[$i]['carr_plc'])){ $sele[24] = "selected"; }
if(in_array("福島県" , $job[$i]['carr_plc'])){ $sele[25] = "selected"; }
if(in_array("茨城県" , $job[$i]['carr_plc'])){ $sele[26] = "selected"; }
if(in_array("栃木県" , $job[$i]['carr_plc'])){ $sele[27] = "selected"; }
if(in_array("群馬県" , $job[$i]['carr_plc'])){ $sele[28] = "selected"; }
if(in_array("埼玉県" , $job[$i]['carr_plc'])){ $sele[29] = "selected"; }
if(in_array("千葉県" , $job[$i]['carr_plc'])){ $sele[30] = "selected"; }
if(in_array("東京都" , $job[$i]['carr_plc'])){ $sele[31] = "selected"; }
if(in_array("神奈川県" , $job[$i]['carr_plc'])){ $sele[32] = "selected"; }
if(in_array("新潟県" , $job[$i]['carr_plc'])){ $sele[33] = "selected"; }
if(in_array("富山県" , $job[$i]['carr_plc'])){ $sele[34] = "selected"; }
if(in_array("石川県" , $job[$i]['carr_plc'])){ $sele[35] = "selected"; }
if(in_array("福井県" , $job[$i]['carr_plc'])){ $sele[36] = "selected"; }
if(in_array("山梨県" , $job[$i]['carr_plc'])){ $sele[37] = "selected"; }
if(in_array("長野県" , $job[$i]['carr_plc'])){ $sele[38] = "selected"; }
if(in_array("岐阜県" , $job[$i]['carr_plc'])){ $sele[39] = "selected"; }
if(in_array("静岡県" , $job[$i]['carr_plc'])){ $sele[40] = "selected"; }
if(in_array("愛知県" , $job[$i]['carr_plc'])){ $sele[41] = "selected"; }
if(in_array("三重県" , $job[$i]['carr_plc'])){ $sele[42] = "selected"; }
if(in_array("滋賀県" , $job[$i]['carr_plc'])){ $sele[43] = "selected"; }
if(in_array("京都府" , $job[$i]['carr_plc'])){ $sele[44] = "selected"; }
if(in_array("大阪府" , $job[$i]['carr_plc'])){ $sele[45] = "selected"; }
if(in_array("兵庫県" , $job[$i]['carr_plc'])){ $sele[46] = "selected"; }
if(in_array("奈良県" , $job[$i]['carr_plc'])){ $sele[47] = "selected"; }
if(in_array("和歌山県" , $job[$i]['carr_plc'])){ $sele[48] = "selected"; }
if(in_array("鳥取県" , $job[$i]['carr_plc'])){ $sele[49] = "selected"; }
if(in_array("島根県" , $job[$i]['carr_plc'])){ $sele[50] = "selected"; }
if(in_array("岡山県" , $job[$i]['carr_plc'])){ $sele[51] = "selected"; }
if(in_array("広島県" , $job[$i]['carr_plc'])){ $sele[52] = "selected"; }
if(in_array("山口県" , $job[$i]['carr_plc'])){ $sele[53] = "selected"; }
if(in_array("徳島県" , $job[$i]['carr_plc'])){ $sele[54] = "selected"; }
if(in_array("香川県" , $job[$i]['carr_plc'])){ $sele[55] = "selected"; }
if(in_array("愛媛県" , $job[$i]['carr_plc'])){ $sele[56] = "selected"; }
if(in_array("高知県" , $job[$i]['carr_plc'])){ $sele[57] = "selected"; }
if(in_array("福岡県" , $job[$i]['carr_plc'])){ $sele[58] = "selected"; }
if(in_array("佐賀県" , $job[$i]['carr_plc'])){ $sele[59] = "selected"; }
if(in_array("長崎県" , $job[$i]['carr_plc'])){ $sele[60] = "selected"; }
if(in_array("熊本県" , $job[$i]['carr_plc'])){ $sele[61] = "selected"; }
if(in_array("大分県" , $job[$i]['carr_plc'])){ $sele[62] = "selected"; }
if(in_array("宮崎県" , $job[$i]['carr_plc'])){ $sele[63] = "selected"; }
if(in_array("鹿児島県" , $job[$i]['carr_plc'])){ $sele[64] = "selected"; }
if(in_array("沖縄県" , $job[$i]['carr_plc'])){ $sele[65] = "selected"; }
if(in_array("海外" , $job[$i]['carr_plc'])){ $sele[66] = "selected"; }

if(in_array("正社員" , $job[$i]['carr_sty'])){ $sele[67] = "selected"; }
if(in_array("契約社員" , $job[$i]['carr_sty'])){ $sele[68] = "selected"; }
if(in_array("派遣社員" , $job[$i]['carr_sty'])){ $sele[69] = "selected"; }
if(in_array("紹介予定派遣" , $job[$i]['carr_sty'])){ $sele[70] = "selected"; }
if(in_array("アルバイト" , $job[$i]['carr_sty'])){ $sele[71] = "selected"; }
if(in_array("業務委託" , $job[$i]['carr_sty'])){ $sele[72] = "selected"; }
if(in_array("転職エージェント" , $job[$i]['carr_sty'])){ $sele[73] = "selected"; }

if(in_array("月給15万円以上" , $job[$i]['carr_sal'])){ $sele[74] = "selected"; }
if(in_array("月給20万円以上" , $job[$i]['carr_sal'])){ $sele[75] = "selected"; }
if(in_array("月給25万円以上" , $job[$i]['carr_sal'])){ $sele[76] = "selected"; }
if(in_array("月給30万円以上" , $job[$i]['carr_sal'])){ $sele[77] = "selected"; }
if(in_array("月給35万円以上" , $job[$i]['carr_sal'])){ $sele[78] = "selected"; }
if(in_array("月給40万円以上" , $job[$i]['carr_sal'])){ $sele[79] = "selected"; }
if(in_array("月給50万円以上" , $job[$i]['carr_sal'])){ $sele[80] = "selected"; }
if(in_array("年俸200万円以上" , $job[$i]['carr_sal'])){ $sele[81] = "selected"; }
if(in_array("年俸300万円以上" , $job[$i]['carr_sal'])){ $sele[82] = "selected"; }
if(in_array("年俸400万円以上" , $job[$i]['carr_sal'])){ $sele[83] = "selected"; }
if(in_array("年俸500万円以上" , $job[$i]['carr_sal'])){ $sele[84] = "selected"; }
if(in_array("年俸800万円以上" , $job[$i]['carr_sal'])){ $sele[85] = "selected"; }
if(in_array("年俸1000万円以上" , $job[$i]['carr_sal'])){ $sele[86] = "selected"; }
if(in_array("時給800円以上" , $job[$i]['carr_sal'])){ $sele[87] = "selected"; }
if(in_array("時給1000円以上" , $job[$i]['carr_sal'])){ $sele[88] = "selected"; }
if(in_array("時給1200円以上" , $job[$i]['carr_sal'])){ $sele[89] = "selected"; }
if(in_array("時給1500円以上" , $job[$i]['carr_sal'])){ $sele[90] = "selected"; }
if(in_array("時給2000円以上" , $job[$i]['carr_sal'])){ $sele[91] = "selected"; }
if(in_array("年収200万円以上" , $job[$i]['carr_sal'])){ $sele[92] = "selected"; }
if(in_array("年収300万円以上" , $job[$i]['carr_sal'])){ $sele[93] = "selected"; }
if(in_array("年収400万円以上" , $job[$i]['carr_sal'])){ $sele[94] = "selected"; }
if(in_array("年収500万円以上" , $job[$i]['carr_sal'])){ $sele[95] = "selected"; }
if(in_array("年収800万円以上" , $job[$i]['carr_sal'])){ $sele[96] = "selected"; }
if(in_array("年収1000万円以上" , $job[$i]['carr_sal'])){ $sele[97] = "selected"; }
if(in_array("日給7000円以上" , $job[$i]['carr_sal'])){ $sele[98] = "selected"; }
if(in_array("日給1万円以上" , $job[$i]['carr_sal'])){ $sele[99] = "selected"; }
if(in_array("日給1万5000円以上" , $job[$i]['carr_sal'])){ $sele[100] = "selected"; }
if(in_array("日給2万円以上" , $job[$i]['carr_sal'])){ $sele[101] = "selected"; }
if(in_array("経験・スキルによる" , $job[$i]['carr_sal'])){ $sele[102] = "selected"; }

if(!empty($job[$i]['carr_acaback'])){
if(in_array("学歴不問" , $job[$i]['carr_acaback'])){ $sele[103] = "selected"; }
if(in_array("高卒以上" , $job[$i]['carr_acaback'])){ $sele[104] = "selected"; }
if(in_array("高専卒以上" , $job[$i]['carr_acaback'])){ $sele[105] = "selected"; }
if(in_array("専門卒以上" , $job[$i]['carr_acaback'])){ $sele[106] = "selected"; }
if(in_array("短大卒以上" , $job[$i]['carr_acaback'])){ $sele[107] = "selected"; }
if(in_array("大学卒以上" , $job[$i]['carr_acaback'])){ $sele[108] = "selected"; }
if(in_array("院卒・修士・博士以上" , $job[$i]['carr_acaback'])){ $sele[109] = "selected"; }
if(in_array("既卒・第2新卒" , $job[$i]['carr_acaback'])){ $sele[110] = "selected"; }
}
if(!empty($job[$i]['carr_age'])){
if(in_array("年齢不問" , $job[$i]['carr_age'])){ $sele[111] = "selected"; }
if(in_array("18歳以上" , $job[$i]['carr_age'])){ $sele[112] = "selected"; }
if(in_array("30歳以下" , $job[$i]['carr_age'])){ $sele[113] = "selected"; }
if(in_array("35歳以下" , $job[$i]['carr_age'])){ $sele[114] = "selected"; }
if(in_array("40歳以下" , $job[$i]['carr_age'])){ $sele[115] = "selected"; }
if(in_array("45歳以下" , $job[$i]['carr_age'])){ $sele[116] = "selected"; }
if(in_array("50歳・60歳以下" , $job[$i]['carr_age'])){ $sele[139] = "selected"; }
if(in_array("65歳以下" , $job[$i]['carr_age'])){ $sele[140] = "selected"; }
}
if(!empty($job[$i]['carr_overtime'])){
if(in_array("残業ほぼ無し" , $job[$i]['carr_overtime'])){ $sele[117] = "selected"; }
if(in_array("残業月10h以下" , $job[$i]['carr_overtime'])){ $sele[118] = "selected"; }
if(in_array("残業月20h以下" , $job[$i]['carr_overtime'])){ $sele[119] = "selected"; }
if(in_array("残業月30h以下" , $job[$i]['carr_overtime'])){ $sele[120] = "selected"; }
if(in_array("残業月40h以下" , $job[$i]['carr_overtime'])){ $sele[121] = "selected"; }
if(in_array("残業月50h以下" , $job[$i]['carr_overtime'])){ $sele[122] = "selected"; }
if(in_array("残業月60h以下" , $job[$i]['carr_overtime'])){ $sele[123] = "selected"; }
if(in_array("残業少なめ" , $job[$i]['carr_overtime'])){ $sele[124] = "selected"; }
if(in_array("ノー残業デー有り" , $job[$i]['carr_overtime'])){ $sele[125] = "selected"; }
}
if(!empty($job[$i]['carr_holy'])){
if(in_array("年間休日120日以上" , $job[$i]['carr_holy'])){ $sele[126] = "selected"; }
if(in_array("年間休日125日以上" , $job[$i]['carr_holy'])){ $sele[127] = "selected"; }
if(in_array("年間休日130日以上" , $job[$i]['carr_holy'])){ $sele[128] = "selected"; }
if(in_array("年間休日135日以上" , $job[$i]['carr_holy'])){ $sele[129] = "selected"; }
}
if(!empty($job[$i]['carr_info'])){
if(in_array("未経験者歓迎" , $job[$i]['carr_info'])){ $sele[130] = "checked"; }
if(in_array("経験者歓迎" , $job[$i]['carr_info'])){ $sele[131] = "checked"; }
if(in_array("要普免" , $job[$i]['carr_info'])){ $sele[132] = "checked"; }
if(in_array("英語力" , $job[$i]['carr_info'])){ $sele[133] = "checked"; }
}

//carr_timeをタイムスタンプからdate型へ変換
$job[$i]['carr_time'] = date("Y/m/d H:i:s",$job[$i]['carr_time']);

//求人情報html表示部分
echo <<<EOF
<div class="field card mb-3">

 <div class="card-header kyujin_no">求人登録登録{$carr_count}</div>
  <div class="card-body">

  <div class="form-row">

   <div class="form-group col-md-3">
      <label for="carr_syok[{$i}]">職種<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_syok[{$i}][]" id="carr_syok[{$i}]">
          <option value="営業職" {$sele[0]}>営業職</option>
          <option value="販売・サービス職" {$sele[1]}>販売・サービス職</option>
          <option value="事務職（一般・総務・人事・企画）" {$sele[2]}>事務職（一般・総務・人事・企画）</option>
          <option value="事務職（経理・財務・労務・法務）" {$sele[3]}>事務職（経理・財務・労務・法務）</option>
          <option value="事務職（総合職）" {$sele[134]}>事務職（総合職）</option>
          <option value="事務職（その他）" {$sele[135]}>事務職（その他）</option>
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
    <label for="carr_plc[{$i}]">勤務地<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_plc[{$i}][]" id="carr_plc[{$i}]">
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
    <label for="carr_sty[{$i}]">雇用形態<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_sty[{$i}][]" id="carr_sty[{$i}]">
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
<label for="carr_sal[{$i}]">給与形態・金額<span class="text-danger">*</span></label>
<select  multiple class="form-control" name="carr_sal[{$i}][]" id="carr_sal[{$i}]">
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
    <label for="carr_app[{$i}]">仕事内容</label>
    <textarea class="form-control" name="carr_app[{$i}]" id="carr_app[{$i}]" rows="2">{$job[$i]['carr_app']}</textarea>
  </div>

  <div class="form-row">

 <div class="form-group col-md-3">
<label for="carr_acaback[{$i}]">最終学歴</label>
<select multiple class="form-control" name="carr_acaback[{$i}][]" id="carr_acaback[{$i}]">
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
<label for="carr_age[{$i}]">対象年齢</label>
<select multiple class="form-control" name="carr_age[{$i}][]" id="carr_age[{$i}]">
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
<label for="carr_overtime[{$i}]">残業時間</label>
<select multiple class="form-control" name="carr_overtime[{$i}][]" id="carr_overtime[{$i}]">
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
<label for="carr_holy[{$i}]">年間休日</label>
<select multiple class="form-control" name="carr_holy[{$i}][]" id="carr_holy[{$i}]">
  <option value="年間休日120日以上" {$sele[126]}>年間休日120日以上</option>
  <option value="年間休日125日以上"  {$sele[127]}>年間休日125日以上</option>
  <option value="年間休日130日以上"  {$sele[128]}>年間休日130日以上</option>
  <option value="年間休日135日以上"  {$sele[129]}>年間休日135日以上</option>
</select>
 </div>

 </div>

 <div class="form-group">
    <label for="carr_key[{$i}]">応募条件・資格など</label>
    <textarea class="form-control" name="carr_key[$i]" id="carr_key[{$i}]" rows="2">{$job[$i]['carr_key']}</textarea>
  </div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$i}][]" id="carr_info_mikeiken[{$i}]" value="未経験者歓迎" {$sele[130]}>
  <label class="form-check-label" for="carr_info_mikeiken[{$i}]">未経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$i}][]" id="carr_info_keikensya[{$i}]" value="経験者歓迎" {$sele[131]}>
  <label class="form-check-label" for="carr_info_keikensya[{$i}]">経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$i}][]" id="carr_info_drive[{$i}]" value="要普免"  {$sele[132]}>
  <label class="form-check-label" for="carr_info_drive[{$i}]">要普免</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$i}][]" id="carr_info_english[{$i}]" value="英語力"  {$sele[133]}>
  <label class="form-check-label" for="carr_info_english[{$i}]">英語力</label>
</div>

</div>

 <div class="form-group">
    <label for="carr_url[{$i}]">求人URL<span class="text-danger">*</span></label>
    <input type="url" class="form-control" name="carr_url[{$i}]" id="carr_url[{$i}]" placeholder="URL" value="{$job[$i]['carr_url']}">
  </div>

<div class="timeparent">
   <label for="r_time[{$i}]">掲載期間</label>
<div class="input-group">
       <input type="text" class="form-control" name="carr_time[{$i}]" id="r_time[{$i}]" placeholder="掲載期間" value="{$job[$i]['carr_time']}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn w-100" value="" name="">変更する</button>
  </div>

</div>
</div>


  </div>
  <div class="card-footer text-right">
<button type="button" class="btn btn-primary vclear ml10" value="" name="">初期値に戻す</button>
<button type="button" class="btn btn-primary clearForm ml10" value="" name="">リセット</button>
<button type="button" class="btn btn-primary trash_btn ml10" value="" name="">削除</button>
</div>

</div>
EOF;
}else{

$job[$i]['cnum'] = $i;
$last_job[] = $job[$i];

}


}



if($jcon === $karacon){
$karatitle = $jcon+1;
echo <<< EOF
<div class="text-center text-danger">
現在掲載期間中の求人はございません。<br />
新規に求人登録を行うか、過去の求人から再度掲載期間を更新して下さい。
</div>
<hr class="my-3">
<div class="field card mb-3">

 <div class="card-header kyujin_no">求人登録{$karatitle}</div>
  <div class="card-body">

  <div class="form-row">

 <div class="form-group col-md-3">
    <label for="carr_syok">職種<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_syok[{$jcon}][]" id="carr_syok">
      <option value="営業職">営業職</option>
      <option value="販売・サービス職">販売・サービス職</option>
      <option value="事務職（一般・総務・人事・企画）">事務職（一般・総務・人事・企画）</option>
      <option value="事務職（経理・財務・労務・法務）">事務職（経理・財務・労務・法務）</option>
      <option value="事務職（総合職）">事務職（総合職）</option>
      <option value="事務職（その他）">事務職（その他）</option>
      <option value="経営・コンサル・管理職">経営・コンサル・管理職</option>
      <option value="デザイン・クリエイティブ職">デザイン・クリエイティブ職</option>
      <option value="技術職（IT・Web）">技術職（IT・Web）</option>
      <option value="技術職（建設）">技術職（建設）</option>
      <option value="技術職（機械）">技術職（機械）</option>
      <option value="技術職（電気・電子）">技術職（電気・電子）</option>
      <option value="技術職（化学・食品・医薬）">技術職（化学・食品・医薬）</option>
      <option value="技術職（製造・生産）">技術職（製造・生産）</option>
      <option value="技術職（総合職）">技術職（総合職）</option>
      <option value="技術職（その他）">技術職（その他）</option>
      <option value="その他の職種">その他の職種</option>
</select>
  </div>

  <div class="form-group col-md-3">
    <label for="carr_plc">勤務地<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_plc[{$jcon}][]" id="carr_plc">
      <option value="全国エリア">全国エリア</option>
      <option value="東北エリア">東北エリア</option>
      <option value="関東エリア">関東エリア</option>
      <option value="中部エリア">中部エリア</option>
      <option value="関西エリア">関西エリア</option>
      <option value="中四国エリア">中四国エリア</option>
      <option value="九州エリア">九州エリア</option>
      <option value="北海道">北海道</option>
      <option value="青森県">青森県</option>
      <option value="岩手県">岩手県</option>
      <option value="宮城県">宮城県</option>
      <option value="秋田県">秋田県</option>
      <option value="山形県">山形県</option>
      <option value="福島県">福島県</option>
      <option value="茨城県">茨城県</option>
      <option value="栃木県">栃木県</option>
      <option value="群馬県">群馬県</option>
      <option value="埼玉県">埼玉県</option>
      <option value="千葉県">千葉県</option>
      <option value="東京都">東京都</option>
      <option value="神奈川県">神奈川県</option>
      <option value="新潟県">新潟県</option>
      <option value="富山県">富山県</option>
      <option value="石川県">石川県</option>
      <option value="福井県">福井県</option>
      <option value="山梨県">山梨県</option>
      <option value="長野県">長野県</option>
      <option value="岐阜県">岐阜県</option>
      <option value="静岡県">静岡県</option>
      <option value="愛知県">愛知県</option>
      <option value="三重県">三重県</option>
      <option value="滋賀県">滋賀県</option>
      <option value="京都府">京都府</option>
      <option value="大阪府">大阪府</option>
      <option value="兵庫県">兵庫県</option>
      <option value="奈良県">奈良県</option>
      <option value="和歌山県">和歌山県</option>
      <option value="鳥取県">鳥取県</option>
      <option value="島根県">島根県</option>
      <option value="岡山県">岡山県</option>
      <option value="広島県">広島県</option>
      <option value="山口県">山口県</option>
      <option value="徳島県">徳島県</option>
      <option value="香川県">香川県</option>
      <option value="愛媛県">愛媛県</option>
      <option value="高知県">高知県</option>
      <option value="福岡県">福岡県</option>
      <option value="佐賀県">佐賀県</option>
      <option value="長崎県">長崎県</option>
      <option value="熊本県">熊本県</option>
      <option value="大分県">大分県</option>
      <option value="宮崎県">宮崎県</option>
      <option value="鹿児島県">鹿児島県</option>
      <option value="沖縄県">沖縄県</option>
      <option value="海外">海外</option>
    </select>
  </div>

 <div class="form-group col-md-3">
    <label for="carr_sty">雇用形態<span class="text-danger">*</span></label>
    <select multiple class="form-control" name="carr_sty[{$jcon}][]" id="carr_sty">
      <option value="正社員">正社員</option>
      <option value="契約社員">契約社員</option>
      <option value="派遣社員">派遣社員</option>
      <option value="紹介予定派遣">紹介予定派遣</option>
      <option value="アルバイト">アルバイト</option>
      <option value="業務委託">業務委託</option>
      <option value="転職エージェント">転職エージェント</option>
   </select>
  </div>

<div class="form-group  col-md-3">
<label for="carr_sal">給与形態・金額<span class="text-danger">*</span></label>

<select  multiple class="form-control" name="carr_sal[{$jcon}][]" id="carr_sal">
  <option value="月給15万円以上" data-val="月給">月給15万円以上</option>
  <option value="月給20万円以上" data-val="月給">月給20万円以上</option>
  <option value="月給25万円以上" data-val="月給">月給25万円以上</option>
  <option value="月給30万円以上" data-val="月給">月給30万円以上</option>
  <option value="月給35万円以上" data-val="月給">月給35万円以上</option>
  <option value="月給40万円以上" data-val="月給">月給40万円以上</option>
  <option value="月給50万円以上" data-val="月給">月給50万円以上</option>
  <option value="年俸200万円以上" data-val="年俸">年俸200万円以上</option>
  <option value="年俸300万円以上" data-val="年俸">年俸300万円以上</option>
  <option value="年俸400万円以上" data-val="年俸">年俸400万円以上</option>
  <option value="年俸500万円以上" data-val="年俸">年俸500万円以上</option>
  <option value="年俸800万円以上" data-val="年俸">年俸800万円以上</option>
  <option value="年俸1000万円以上" data-val="年俸">年俸1000万円以上</option>
  <option value="時給800円以上" data-val="時給">時給800円以上</option>
  <option value="時給1000円以上" data-val="時給">時給1000円以上</option>
  <option value="時給1200円以上" data-val="時給">時給1200円以上</option>
  <option value="時給1500円以上" data-val="時給">時給1500円以上</option>
  <option value="時給2000円以上" data-val="時給">時給2000円以上</option>
  <option value="年収200万円以上" data-val="年収">年収200万円以上</option>
  <option value="年収300万円以上" data-val="年収">年収300万円以上</option>
  <option value="年収400万円以上" data-val="年収">年収400万円以上</option>
  <option value="年収500万円以上" data-val="年収">年収500万円以上</option>
  <option value="年収800万円以上" data-val="年収">年収800万円以上</option>
  <option value="年収1000万円以上" data-val="年収">年収1000万円以上</option>
  <option value="日給7000円以上" data-val="日給">日給7000円以上</option>
  <option value="日給1万円以上" data-val="日給">日給1万円以上</option>
  <option value="日給1万5000円以上" data-val="日給">日給1万5000円以上</option>
  <option value="日給2万円以上" data-val="日給">日給2万円以上</option>
  <option value="経験・スキルによる">経験・スキルによる</option>
</select>
</div>

 </div>

 <div class="form-group">
    <label for="carr_app">仕事内容</label>
    <textarea class="form-control" name="carr_app[{$jcon}]" id="carr_app" rows="2"></textarea>
  </div>

  <div class="form-row">

 <div class="form-group col-md-3">
<label for="carr_acaback">最終学歴</label>
<select multiple class="form-control" name="carr_acaback[{$jcon}][]" id="carr_acaback">
  <option value="学歴不問">学歴不問</option>
  <option value="高卒以上">高卒以上</option>
  <option value="高専卒以上">高専卒以上</option>
  <option value="専門卒以上">専門卒以上</option>
  <option value="短大卒以上">短大卒以上</option>
  <option value="大学卒以上">大学卒以上</option>
  <option value="院卒・修士・博士以上">院卒・修士・博士以上</option>
  <option value="既卒・第2新卒">既卒・第2新卒</option>
</select>
 </div>

 <div class="form-group col-md-3">
<label for="carr_age">対象年齢</label>
<select multiple class="form-control" name="carr_age[{$jcon}][]" id="carr_age">
  <option value="年齢不問">年齢不問</option>
  <option value="18歳以上">18歳以上</option>
  <option value="30歳以下">30歳以下</option>
  <option value="35歳以下">35歳以下</option>
  <option value="40歳以下">40歳以下</option>
  <option value="45歳以下">45歳以下</option>
  <option value="50歳・60歳以下">50歳・60歳以下</option>
  <option value="65歳以下">65歳以下</option>
</select>
</div>

 <div class="form-group col-md-3">
<label for="carr_overtime">残業時間</label>
<select multiple class="form-control" name="carr_overtime[{$jcon}][]" id="carr_overtime">
  <option value="残業ほぼ無し">残業ほぼ無し</option>
  <option value="残業月10h以下">残業月10h以下</option>
  <option value="残業月20h以下">残業月20h以下</option>
  <option value="残業月30h以下">残業月30h以下</option>
  <option value="残業月40h以下">残業月40h以下</option>
  <option value="残業月50h以下">残業月50h以下</option>
  <option value="残業月60h以下">残業月60h以下</option>
  <option value="残業少なめ">残業少なめ</option>
  <option value="ノー残業デー有り">ノー残業デー有り</option>
</select>
 </div>

 <div class="form-group col-md-3">
<label for="carr_holy">年間休日</label>
<select multiple class="form-control" name="carr_holy[{$jcon}][]" id="carr_holy">
  <option value="年間休日120日以上">年間休日120日以上</option>
  <option value="年間休日125日以上">年間休日125日以上</option>
  <option value="年間休日130日以上">年間休日130日以上</option>
  <option value="年間休日135日以上">年間休日135日以上</option>
</select>
 </div>

</div>

 <div class="form-group">
    <label for="carr_key">応募条件・資格など</label>
    <textarea class="form-control" name="carr_key[{$jcon}]" id="carr_key" rows="2"></textarea>
  </div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$jcon}][]" id="carr_info_mikeiken" value="未経験者歓迎">
  <label class="form-check-label" for="carr_info_mikeiken">未経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$jcon}][]" id="carr_info_keikensya" value="経験者歓迎">
  <label class="form-check-label" for="carr_info_keikensya">経験者歓迎</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$jcon}][]" id="carr_info_drive" value="要普免">
  <label class="form-check-label" for="carr_info_drive">要普免</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="carr_info[{$jcon}][]" id="carr_info_english" value="英語力">
  <label class="form-check-label" for="carr_info_english">英語力</label>
</div>

</div>

 <div class="form-group">
    <label for="carr_url">求人URL<span class="text-danger">*</span></label>
    <input type="url" class="form-control" name="carr_url[{$jcon}]" id="carr_url" placeholder="URL">
  </div>

<div class="form-group">
<label for="carr_time">掲載期間</label>
<input type="date" class="form-control" id="carr_time" name="carr_time[{$jcon}]" placeholder="掲載期間" value="<?php echo $rdate ?>">
</div>
 
  </div>
  <div class="card-footer text-right">
<button type="button" class="btn btn-primary vclear ml10" value="" name="">初期値に戻す</button>
<button type="button" class="btn btn-primary clearForm ml10" value="" name="">リセット</button>
<button type="button" class="btn btn-primary trash_btn ml10" value="" name="">削除</button>
</div>

</div>
EOF;
}
?>


</div>

<button type="button" class="btn btn-primary mt10 miw100 add_btn" value="" name="">求人情報を追加する</button>

</div>

<div class="btn-group d-flex mb-3 text-center pagein" role="group" id="editbutton">
<a href="#edinavi" class="btn btn-primary w-100">ページ上</a>
<a href="./edit.php" class="btn btn-primary w-100">編集トップ</a>
<a href="#jobcard" class="btn btn-primary w-100">求人情報へ</a>
<a href="#edifoot" class="btn btn-primary w-100">ページ下へ</a>
</div>


 <button type="submit" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行">編集実行</button>

<hr class="my-3">
<div class="text-center" id="kako">掲載期間が過ぎた過去の求人</div>
<div class="text-center">再度掲載する場合は掲載期間を変更して延長して下さい</div>
<hr class="my-3">

<?php
$ljc = count($last_job);
for($x=0;$x<$ljc;$x++){
$c_num = $last_job[$x]['cnum']+1;
$carr_syok = postdata($last_job[$x]['carr_syok']);
$carr_sal = postdata($last_job[$x]['carr_sal']);
$carr_plc = postdata($last_job[$x]['carr_plc']);
$carr_sty = postdata($last_job[$x]['carr_sty']);
$carr_time = date("Y/m/d H:i:s",$last_job[$x]['carr_time']);
if($last_job[$x]['carr_check'] === "完了"){$carr_check = "checked";}else{$carr_check = "";}

if($last_job[$x]['carr_check'] === "完了"){

echo <<<EOF
//編集チェック
<div class="card mb-3">
<div class="card-header">
<div class="form-check form-check-inline mr-1">
  <input class="form-check-input" type="checkbox" name="carr_check[{$last_job[$x]['cnum']}]" id="carr_check" value="完了"   {$carr_check}>
</div>
求人登録{$c_num}<span class="text-danger">*掲載期間が過ぎています</span>
</div>
  <div class="card-body bg-light">

<p>職種：{$carr_syok}</p>
<p>雇用形態：{$carr_sty}</p>
<p>業務内容：{$last_job[$x]['carr_app']}</p>
<p>勤務地：{$carr_plc}</p>
<p>給与：{$carr_sal}</p>

 <div class="form-group">
    <label for="carr_url[{$last_job[$x]['cnum']}]">求人URL<span class="text-danger">*</span> <a href="{$last_job[$x]['carr_url']}" rel="noreferrer noopener" target=”_blank” referrerpolicy="no-referrer" class="btn-sm btn-primary">URLリンク</a> </label>
    <input type="url" class="form-control" name="carr_url[{$last_job[$x]['cnum']}]" id="carr_url[{$last_job[$x]['cnum']}]" placeholder="URL" value="{$last_job[$x]['carr_url']}">
  </div>

<div class="timeparent">
   <label for="r_time[{$last_job[$x]['cnum']}]">掲載期間</label>
<div class="input-group">
       <input type="text" class="form-control" name="carr_time[{$last_job[$x]['cnum']}]" id="r_time[{$last_job[$x]['cnum']}]" placeholder="掲載期間" value="{$carr_time}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn w-100" value="" name="">変更する</button>
  </div>

</div>
</div>


</div>
</div>
EOF;
}else{

echo <<<EOF
<div class="card mb-3">

 <div class="card-header">
<div class="form-check form-check-inline mr-1">
  <input class="form-check-input" type="checkbox" name="carr_check[{$last_job[$x]['cnum']}]" id="carr_check" value="完了"   {$carr_check}>
</div>
求人登録{$c_num}<span class="text-danger">*掲載期間が過ぎています</span>
</div>
  <div class="card-body">

<p>職種：{$carr_syok}</p>
<p>雇用形態：{$carr_sty}</p>
<p>業務内容：{$last_job[$x]['carr_app']}</p>
<p>勤務地：{$carr_plc}</p>
<p>給与：{$carr_sal}</p>

 <div class="form-group">
    <label for="carr_url[{$last_job[$x]['cnum']}]">求人URL<span class="text-danger">*</span> <a href="{$last_job[$x]['carr_url']}" rel="noreferrer noopener" target=”_blank” referrerpolicy="no-referrer" class="btn-sm btn-primary">URLリンク</a> </label>
    <input type="url" class="form-control" name="carr_url[{$last_job[$x]['cnum']}]" id="carr_url[{$last_job[$x]['cnum']}]" placeholder="URL" value="{$last_job[$x]['carr_url']}">
  </div>

<div class="timeparent">
   <label for="r_time[{$last_job[$x]['cnum']}]">掲載期間</label>
<div class="input-group">
       <input type="text" class="form-control" name="carr_time[{$last_job[$x]['cnum']}]" id="r_time[{$last_job[$x]['cnum']}]" placeholder="掲載期間" value="{$carr_time}" readonly>
<div class="input-group-append">
<button type="button" class="btn btn-primary time_btn w-100" value="" name="">変更する</button>
  </div>

</div>
</div>


</div>
</div>

EOF;
}


echo <<< EOF
<div class="btn-group d-flex mb-3 text-center pagein" role="group" id="edifoot">
<a href="#edinavi" class="btn btn-primary w-100">上に戻る</a>
<a href="#jobcard" class="btn btn-primary w-100">求人情報へ</a>
<a href="#editbutton" class="btn btn-outline-primary w-100">編集ボタンへ</a>
</div>

EOF;
}



?>
</form>
