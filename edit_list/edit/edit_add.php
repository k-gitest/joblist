<?php

$editkey = $_SESSION['editkey'];
$jobid = $_POST['jobnum'];

$_SESSION['edit_add'] = true;

//var_dump($arr['data']['id'][$editkey]);
//var_dump($arr['data']['id'][$editkey]['job'][$jobid]);

$comp_name = $arr['data']['id'][$editkey]['corp']['comp_name'];
$edicont = count($arr['data']['id'][$editkey]['job']);
$jobno = $edicont +1;

echo <<<EOF
<form method="post" action=""> 
<div class="card p-2 mb-3">
<div class="parent">
<div class="field card mb-3">

 <div class="card-header kyujin_no">{$comp_name}の求人登録{$jobno}を追加</div>
  <div class="card-body">

  <div class="form-row">

    <div class="form-group col-md-3">
      <label for="carr_syok">職種<span class="text-danger">*</span></label>
      <select multiple class="form-control form-control-sm" name="carr_syok[0][]" id="carr_syok">
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
      <select multiple class="form-control form-control-sm" name="carr_plc[0][]" id="carr_plc">
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
      <select multiple class="form-control form-control-sm" name="carr_sty[0][]" id="carr_sty">
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
      <select  multiple class="form-control form-control-sm" name="carr_sal[0][]" id="carr_sal">
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
    <textarea class="form-control form-control-sm" name="carr_app[0]" id="carr_app" rows="2"></textarea>
 </div>

 <div class="form-row">

 <div class="form-group col-md-3">
    <label for="carr_acaback">最終学歴</label>
    <select multiple class="form-control form-control-sm" name="carr_acaback[0][]" id="carr_acaback">
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
    <select multiple class="form-control form-control-sm" name="carr_age[0][]" id="carr_age">
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
    <select multiple class="form-control form-control-sm" name="carr_overtime[0][]" id="carr_overtime">
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
    <select multiple class="form-control form-control-sm" name="carr_holy[0][]" id="carr_holy">
      <option value="年間休日120日以上">年間休日120日以上</option>
      <option value="年間休日125日以上">年間休日125日以上</option>
      <option value="年間休日130日以上">年間休日130日以上</option>
      <option value="年間休日135日以上">年間休日135日以上</option>
    </select>
 </div>

</div>

  <div class="form-group">
    <label for="carr_key">応募条件・資格など</label>
    <textarea class="form-control form-control-sm" name="carr_key[0]" id="carr_key" rows="2"></textarea>
  </div>

<div class="form-group">

  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_mikeiken" value="未経験者歓迎">
    <label class="form-check-label" for="carr_info_mikeiken">未経験者歓迎</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_keikensya" value="経験者歓迎">
    <label class="form-check-label" for="carr_info_keikensya">経験者歓迎</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_drive" value="要普免">
    <label class="form-check-label" for="carr_info_drive">要普免</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="carr_info[0][]" id="carr_info_english" value="英語力">
    <label class="form-check-label" for="carr_info_english">英語力</label>
  </div>

</div>

 <div class="form-group">
    <label for="carr_url">求人URL<span class="text-danger">*</span></label>
    <input type="url" class="form-control form-control-sm" name="carr_url[0]" id="carr_url" placeholder="URL">
  </div>

<div class="form-group">
<label for="carr_time">掲載期間</label>
<input type="date" class="form-control form-control-sm" id="carr_time" name="carr_time[0]" placeholder="掲載期間" value="<?php echo $rdate ?>">
</div>
 
  </div>
  <div class="card-footer text-right">
<button type="button" class="btn btn-primary vclear ml10" value="" name="">初期値に戻す</button>
<button type="button" class="btn btn-primary clearForm ml10" value="" name="">リセット</button>
<button type="button" class="btn btn-primary trash_btn ml10" value="" name="">削除</button>
</div>

</div>


</div>

<button type="button" class="btn btn-primary mt10 miw100 add_btn" value="" name="">求人情報を追加する</button>

</div>

<input type="submit" class="btn btn-outline-primary badge-pill w-100" name="edit" value="編集実行">

<hr />
<div class="btn-group d-flex edinavi text-center mb-3 pagein" role="group" id="edinavi">
  <input type="button" class="btn btn-primary w-100" name="btn_back" value="前のページへ戻る" onclick="history.back()">
 <a href="#edinavi" class="btn btn-primary w-100">ページの上へ戻る</a>
</div>

</form>

EOF;
?>