<?php
$editkey = $_SESSION['editkey'];
$_SESSION['edit_comp'] = true;

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
    <input type="text" name="comp_name" class="form-control form-control-sm" id="comp_name" placeholder="企業名" value="<?php echo $comp_name ?>" >
  </div>
<div class="form-group">
    <label for="comp_info">企業概要</label>
    <input type="text" name="comp_info" class="form-control form-control-sm" id="comp_info" placeholder="企業概要" value="<?php echo $comp_info ?>">
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
    <input type="text" name="comp_code" class="form-control form-control-sm" id="comp_code" placeholder="証券コード" value="<?php echo $comp_code ?>">
  </div>

<div class="form-group col-md-3">
    <label for="comp_gyo">業種</label>
    <select class="form-control form-control-sm" name="comp_gyo" id="comp_gyo">
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
    <select class="form-control form-control-sm" name="comp_gyokai" id="comp_gyokai">
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
<select multiple class="form-control form-control-sm" name="comp_taigu[]" id="comp_taigu">
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
    <input type="text" name="comp_agesal" class="form-control form-control-sm" id="comp_agesal" placeholder="平均年齢・平均年収" value="<?php echo $dom_code ?>">
  </div>

<div class="form-row">

<div class="form-group col-md-3">
<label for="comp_kinzoku">勤続年数</label>
<select class="form-control form-control-sm" name="comp_kinzoku" id="comp_kinzoku">
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
<select class="form-control form-control-sm" name="comp_risyoku" id="comp_risyoku">
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
<select class="form-control form-control-sm" name="comp_syouyo" id="comp_syouyo">
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
<select class="form-control form-control-sm" name="comp_fukuri" id="comp_fukuri">
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
    <textarea class="form-control form-control-sm" name="comp_yukyu" id="comp_yukyu" rows="1"><?php echo $comp_yukyu ?></textarea>
  </div>

 <div class="form-group">
    <label for="comp_pr">企業情報PR</label>
    <textarea class="form-control form-control-sm" name="comp_pr" id="comp_pr" rows="2"><?php echo $comp_pr ?></textarea>
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
       <input type="text" name="comp_review[{$key}]" class="form-control form-control-sm" id="comp_review" placeholder="口コミ評価URL" value="{$val}" >
<div class="input-group-append">
<button type="button" class="btn btn-sm btn-primary trash_review_btn w-100" value="" name="">削除</button>
  </div>
</div>

</div>
EOF;

}

}

echo <<<EOF
</div>

<div class="text-right mb-3">
<button type="button" class="btn btn-sm btn-primary add_review_btn w-100" value="" name="">URL追加</button>
</div>
<hr />
 <input type="submit" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行">
<hr />
<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
  <input type="button" class="btn btn-primary w-100" name="btn_back" value="前のページへ戻る" onclick="history.back()">
  <input type="submit" class="btn btn-outline-primary w-100" name="edit" value="求人追加"> 
  <a href="#edinavi" class="btn btn-primary w-100">ページの上へ戻る</a>
</div>

EOF;
?>