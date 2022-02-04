<?php
session_cache_limiter('public');
session_start();
/*
header('Expires:');
header('Cache-Control:');
header('Pragma:'); 
*/

require_once 'goutte.phar';
use Goutte\Client;

?>
<?php
  $page_flag = 0; //入力画面

  if (!empty($_POST['confirm'])) {

    $page_flag = 1; //確認画面

  } elseif (!empty($_POST['submit'])) {

    $page_flag = 2; //完了画面

  } else {

    $page_flag = 0; //入力画面
  }

//curlによるファイル読み込み
function getApiDataCurl($url)
{
    $option = [
        CURLOPT_RETURNTRANSFER => true, //文字列として返す
        CURLOPT_TIMEOUT        => 3, // タイムアウト時間
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, $option);

    $json    = curl_exec($ch);
    $info    = curl_getinfo($ch);
    $errorNo = curl_errno($ch);

    // OK以外はエラーなので空白配列を返す
    if ($errorNo !== CURLE_OK) {
        // 詳しくエラーハンドリングしたい場合はerrorNoで確認
        // タイムアウトの場合はCURLE_OPERATION_TIMEDOUT
        return [];
    }

    // 200以外のステータスコードは失敗とみなし空配列を返す
    if ($info['http_code'] !== 200) {
        return [];
    }

    // 文字列から変換
    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $jsonArray = json_decode($json, true);

    return $jsonArray;
}

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <title>タイトル</title>

<script>
$(function() {
    "use strict";
    
var num = 0;
var $content = $('.field:last-child');
//求人番号初期設定
var kyujin_num = num +1;
var kyujin_title = $('.kyujin_no').text();
$('.kyujin_no').text(kyujin_title +1); 

//求人数をvalueで送信
$(document).on('click','#confirm', function() {
$(this).val(kyujin_num);
});

$('#comp_key_jou').change(function() {
if($(this).prop('checked')){
$('#comp_code').prop('disabled',false);
$('#comp_agesal').prop('disabled',true);
}else{
$('#comp_code').prop('disabled',true);
$('#comp_agesal').prop('disabled',false);
}
});

/*
comp_key_jou
$(document).on('click','.comp_code', function() {
alert('test');
$('.comp_agesal').prop.('disabled',true);
});
*/

//追加ボタン処理
$(document).on('click','.add_btn', function() {
   num++;
   kyujin_num++;
  
   //クローン作成処理
   $content.clone().appendTo('.parent').find('input,textarea,select').each(function() {
    var base_name = $(this).attr('name');
    var bnr = base_name.replace(/\[\d{1}\]|\[\d{2}\]/g,"");//正規表現で[0-9]を削除
    var base_name2 = $(this).attr('id');
    var bnr2 = base_name2.replace(/\d{2}|\d{4}/g ,"");

    //[0-9]を削除後の処理
    if(bnr.match(/\[\]/)){    //selectなど[]が残っていた場合の処理
        var bnr_1 =bnr.replace(/\[\]/g,"");  //正規表現で[]を削除
        $(this).attr('name', bnr_1 + '[' + num + ']' + '[]');
    } else {
        $(this).attr('name', bnr + '[' + num + ']');
    }

    $(this).attr('id', bnr2 + '[' + num + ']');
  
//クローンフォーム内のクリア処理

//checkedをクリア
if($(this).attr('type') === 'checkbox' ){
$(this).prop("checked",false);
} else {
$(this).val('');//valueをクリア
}

  }).end().find('label').each(function() {
    //label内forに対する処理
    var base_name4 = $(this).attr('for');
    var bnr4 = base_name4.replace(/\[[0-9]\]+$/g ,"");
    $(this).attr('for', bnr4 + '[' + num + ']');

  }).end().find('.kyujin_no').text(kyujin_title + kyujin_num);//求人番号設定処理

});

//削除ボタン処理
$(document).on('click','.trash_btn', function() {
   num--;
   kyujin_num--;
   $(this).parents('.field').remove();

$('.parent').find('.field').each(function(i,e) {
//求人番号設定処理
var knum = i + 1;
$(this).find('.kyujin_no').text(kyujin_title + knum );

//nameをindex番号に置き換え処理
$(this).find('input,textarea,select').each(function() {
var rename = $(this).attr('name');
var rn1 = rename.replace(/[0-9]/g , i);
var rename2 = $(this).attr('id');
var rn2 = rename2.replace(/[0-9]/g , i);
$(this).attr('name', rn1);
$(this).attr('id', rn2);

}).end().find('label').each(function() {
//forをindex番号に置き換え処理
var rename3 = $(this).attr('for');
var rn3 = rename3.replace(/[0-9]/g , i);
$(this).attr('for', rn3);

  });


});

});

//リセットボタン処理
$(document).on('click','.clearForm', function(){
    $(this).parents('.field').find("input,textarea,select").val("").end().find(":checked").prop("checked", false);
});

//戻すボタン処理
//先ず初期値をdata()でdefaultに保存
$('input,textarea').each(function(){

$(this).data('default',$(this).val());

}).end().find('input[type="checkbox"]:checked,option:selected').each(function(){
//チェックボックスとセレクトボックスは選択されている要素にdata-要素を追加する
$(this).data('default',$(this).val());

});
//戻すボタンクリック後の処理
$(document).on('click','.vclear', function(){

$(this).parents('.field').find("input,textarea").val(function(){
return $(this).data('default');
}).end().find('input[type="checkbox"],option').each(function(){

//data-要素のあるオブジェクトに選択済みを追加する
if($(this).attr('default')){
$(this).prop("checked", true);
$(this).prop("selected", true);
}else{
$(this).prop("checked", false);
$(this).prop("selected", false);
};


});

});


//URL追加ボタン処理
var urlnum = 0;
var $urlcontent = $('.urlfield:last-child');
$(document).on('click','.add_review_btn', function(){
urlnum++;
  
   //クローン作成処理
   $urlcontent.clone().appendTo('.urlparent').find('input').each(function() {
    var url_name = $(this).attr('name');
    var urlna1 = url_name.replace(/\[[0-9]\]/g,"");//正規表現で[0-9]を削除
    var url_name2 = $(this).attr('id');
    var urlna2 = url_name2.replace(/\[[0-9]\]+$/g ,"");

        $(this).attr('name', urlna1 + '[' + urlnum + ']');
        $(this).attr('id', urlna2 + '[' + urlnum + ']');
        $(this).val('');//valueをクリア

    });
/*
.end().find('label').each(function(){

    var url_name4 = $(this).attr('for');
    var urlna4 = url_name4.replace(/\[[0-9]\]+$/g ,"");
    $(this).attr('for', urlna4 + '[' + urlnum + ']');

});
*/

});

//URL削除ボタン処理
$(document).on('click','.trash_review_btn', function(){
urlnum--;
$(this).parents('.urlfield').remove();

$('.urlparent').find('.urlfield').each(function(i,e) {

$(this).find('input').each (function() {
var urlrename = $(this).attr('name');
var urlrn1 = urlrename.replace(/[0-9]/g , i);
var urlrename2 = $(this).attr('id');
var urlrn2 = urlrename2.replace(/[0-9]/g , i);
$(this).attr('name', urlrn1);
$(this).attr('id', urlrn2);

}).end().find('label').each(function() {
var urlrename3 = $(this).attr('for');
var urlrn3 = urlrename3.replace(/[0-9]/g , i);
$(this).attr('for', urlrn3);
});

});

});

//フォーム入力チェック処理
$('form').on('submit',function(){
  var chksub = "";
  var chkcom = "";
  if($("#comp_name").val() === ""){
  chksub = false;
  chkcom += "企業名が入力されていません\n";
  $("#comp_name").after('<span class="text-danger">企業名を入力して下さい</span>');
  }

  if($("#comp_gyo").val() === ""){
  chksub = false;
  chkcom += "業種が入力されていません\n";
  $("#comp_gyo").after('<span class="text-danger">業種を入力して下さい</span>');
  }

//求人数ごとの入力値カウント初期設定
var cnt_syok = 0;var cnt_plc = 0;var cnt_sty = 0;var cnt_sal = 0;var cnt_url = 0;var cnt_time = 0;
//selectボックスの入力値チェック分岐処理
$(this).find('select').each(function(){

if($(this).attr('id').match(/carr_syok/) ){
cnt_syok++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_syok + "の職種が入力されていません\n";
  $(this).after('<span class="text-danger">職種を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_plc/ )){
cnt_plc++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_plc + "の勤務地が入力されていません\n";
  $(this).after('<span class="text-danger">勤務地を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_sty/ )){
cnt_sty++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_sty + "の雇用形態が入力されていません\n";
  $(this).after('<span class="text-danger">雇用形態を選択して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_sal/ )){
cnt_sal++;
 if($(this).val().length === 0){
  chksub = false;
  chkcom  += "求人No" + cnt_sal + "の給与が入力されていません\n";
  $(this).after('<span class="text-danger">給与を選択して下さい</span>');
  }
}

}).end().find('input').each(function(){

if($(this).attr('id').match(/carr_url/ )){
cnt_url++;
 if($(this).val() === ""){
  chksub = false;
  chkcom  += "求人No" + cnt_url + "のurlが入力されていません\n";
  $(this).after('<span class="text-danger">求人ページのURLを入力して下さい</span>');
  }
}

if($(this).attr('id').match(/carr_time/ )){
cnt_time++;
 if($(this).val() === ""){
  chksub = false;
  chkcom  += "求人No" + cnt_time + "のurlが入力されていません\n";
  $(this).after('<span class="text-danger">掲載期間を選択して下さい</span>');
  }
}


});

//未入力・未選択があった場合の処理
  if( chksub === false ){
    alert(chkcom);
    return false;
  }

});


});
</script>
</head>
<body>
<nav class="navbar navbar-light bg-light mb-3">
<div class="container">
  <a class="navbar-brand" href="***/test.php">企業情報入力フォーム</a>

<a class="btn btn-primary" href="***/edit.php">登録情報一覧</a>

</div>
</nav>
<div class="container">

<?php

//$_POSTデータ処理
if($_SERVER["REQUEST_METHOD"] === "POST"){

//先ずjsonファイルを読み込む
$json_url = "http://***_data1808.json";



$arr = getApiDataCurl($json_url);

//$json = file_get_contents($url);
//$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

//json_decodeで読み込んだjsonファイルをphp配列へ
//$arr = json_decode($json,true);
//num作成
$num = count($arr["data"]["id"]);
$num--;
$num = $arr['data']['id'][$num]['corp']['num'];

$jurl = '***_data1808.json';

if(file_exists($jurl)){
//url重複チェック
if(!empty($_POST['confirm'])){
foreach($arr['data']['id'] as $record => $key){
//読み込んだ配列からarray_columnでcarr_urlのみ検索する
$carrurl = array_column($key,'carr_url');
  foreach( $_POST['carr_url'] as $key2 ){
    foreach( $carrurl as $val ){
      if($val === $key2){
        echo "<p><span class='text-danger'>URLが重複しています。</span></p>";
        $page_flag = 0;
        break;
      }
    }
  }
}

//企業名重複チェック
if(!empty( $_POST['confirm'] ) ){
$acon = count($arr['data']['id']);
   for($i =0 ; $i < $acon; $i++ ){
      if($_POST['comp_name'] === $arr['data']['id'][$i]['corp']['comp_name'] || $_POST['comp_name'] === ""){
        echo "<p class='text-danger'>企業名が既に登録されているか入力されていません。</p>";
        $page_flag = 0;
        break;
      }
   }
}


}




//書き込み重複チェック、$_SESSIONによるチェックを含めて条件分岐
if(!empty($_POST['submit']) && $_SESSION["chk"] === "true" &&  !empty($_SESSION["chk"]) ){

//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

/*
//backupファイルへ書き込み
   $json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
   $file = fopen('./***_data1808_save.json', 'c');
   fputs($file, $json);
   fclose($file);
   */

//$_SESSIONのチェックは書き込まない為削除する
unset($_SESSION['chk']);

//URLチェック後に$_POSTの配列をPHP配列へ追加する
$arr["data"]["id"][] =  $_SESSION;

//ファイル書き込み処理

//$_POSTデータを追加した配列をjsonへ変換
$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//print $json."<br>";
    
//jsonへ変換したデータをjsonファイルに上書き
   $file = fopen('./***_data1808.json', 'c');
   fputs($file, $json);
   fclose($file);

//ファイルへ書き込み後に$_SESSIONと$_POSTを初期化
$_SESSION = array();
$_POST = array();

//ロック解除
fclose($lock_fp);

} else if(!empty($_POST['submit']) && empty($_SESSION['chk'])){
echo "<p><span class='text-danger'>不正な書き込み処理です。もう一度入力し直して下さい。</span></p>";
$page_flag = 0;
}


}else{
echo "<p><span class='text-danger'>ファイルがありません。</span></p>";
}

}  

?>



<?php if( $page_flag === 1 ): ?>

 <?php
//先ずjsonファイルを読み込む
$json_url = "***_joball_data1808.json";

//json_decodeで読み込んだjsonファイルをphp配列へ
$arr = getApiDataCurl($json_url);
//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

//backupファイルへ書き込み
   $json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
   $file = fopen('./***_data1808.json_regiback', 'w');
   fputs($file, $json);
   fclose($file);

//ロック解除
fclose($lock_fp);


//$_POSTデータ配列処理関数
function postdata($this){ 
if(!empty($this)){
$length = count($this);
$no = 0;
foreach($this as $key => $val){
$no++;
    if($no !== $length){
      $data_val .= $val."、";
} else {
      $data_val .= $val;
}
      }
return $data_val;
} else{$data_val = "";}
} 

function postdata_br($this){ 
if(!empty($this)){
$length = count($this);
$no = 0;
foreach($this as $key => $val){
$no++;
    if($no !== $length){
      $data_val .= $val."<br />";
} else {
      $data_val .= $val;
}
       }
return $data_val;
} else{$data_val = "";}
} 

   //取得した値をグローバル変数に代入
   $num++;//ナンバーを増やしてから桁を揃える
   $num = sprintf('%05d',$num);

   $_POST['num'] = $_SESSION['corp']['num'] = $num;
   $comp_name = $_SESSION['corp']['comp_name'] = $_POST['comp_name'];
   $comp_info = $_SESSION['corp']['comp_info'] = $_POST['comp_info'];
   $comp_key = $_SESSION['corp']['comp_key'] = $_POST['comp_key'];
   $comp_key_val = postdata($comp_key);
   $comp_code = $_SESSION['corp']['comp_code'] = $_POST['comp_code'];
   $comp_review = $_SESSION['corp']['comp_review'] = $_POST['comp_review'];
   $comp_review_val = postdata_br($comp_review);
   $comp_gyo = $_SESSION['corp']['comp_gyo'] = $_POST['comp_gyo'];
   $comp_gyokai = $_SESSION['corp']['comp_gyokai'] = $_POST['comp_gyokai'];
   $comp_taigu = $_SESSION['corp']['comp_taigu'] = $_POST['comp_taigu'];
   $comp_pr = $_SESSION['corp']['comp_pr'] = $_POST['comp_pr'];
   $comp_yukyu = $_SESSION['corp']['comp_yukyu'] = $_POST['comp_yukyu'];
   $comp_fukuri = $_SESSION['corp']['comp_fukuri'] = $_POST['comp_fukuri'];
   $comp_syouyo = $_SESSION['corp']['comp_syouyo'] = $_POST['comp_syouyo'];
   $comp_risyoku = $_SESSION['corp']['comp_risyoku'] = $_POST['comp_risyoku'];
   $comp_kinzoku = $_SESSION['corp']['comp_kinzoku'] = $_POST['comp_kinzoku'];
   $code_val = $_SESSION['corp']['dom_code'] = $_POST['comp_agesal'] ;

   //登録日時処理
   $time = $_SESSION['time'] = time();
   //$time = $_SESSION['time'] = $_POST['time'];
   $date = date("Y/m/d H:i:s",$time);
   //$_SESSIONによるリロード（更新）対策のチェック
   $_SESSION["chk"] = "true";

//数字を万円表示処理
function number_unit($int){
	$unit = array('万','億','兆','京');
	krsort($unit);
	if(is_numeric($int)){
		$tmp = '';
		$count = strlen($int);
		foreach($unit as $k => $v){
			if($count > (4 * ($k + 1))){
				if($int!==0) $tmp .= number_format(floor( $int /pow(10000,$k+1))).$v;
				$int = $int % pow(10000,$k+1);
			}
		}
		if($int!==0) $tmp .= number_format($int % pow(10000,$k+1));
		return $tmp;
	}else{
		return false;
	}
}


//スクレイピング処理
//証券コードから企業情報を取得する
if(!empty($_POST['comp_code'])){

$client = new Client(); 
$goutteurl = '***/?code='.$comp_code.'.T';
$crawler = $client->request('GET', $goutteurl);
$dom_code3 = $crawler->filter('table.boardFinCom th')->each(function($node){
if( $node->text() === "平均年齢"  || $node->text() === "平均年収"){
$dom_code2 = $node->nextAll()->text();
return $dom_code2;
}else{
return true;
}
});

foreach($dom_code3 as $key => $val){
if($val !== true){
if(strstr($val,"千円") && !strstr($val,"-")){
$val2 = str_replace('千円', '', $val);
$val2 = str_replace(',', '', $val2);
$val2 = $val2 * 1000;
$val2 = number_unit($val2);
$dom_code[] = $val2."円";
}elseif(strstr($val, "-千円")){
$val2 = "-万円";
$dom_code[]= $val2;
}else{
$dom_code[] = $val;
}
}
}
//平均年収と平均年齢の値をSESSIONと表示用変数へ代入
$code_val = $_SESSION['corp']['dom_code'] = $dom_code;
$code_val = postdata($code_val);
}

//評価URLから企業評価を取得する
if($_POST['comp_review'] !== "false" && !empty($_POST['comp_review'])){

$revcont = $_POST['comp_review'];

foreach($revcont as $key => $value){

$client = new Client(); 

//配列からURLを取得する
$goutteurl = $value;
$crawler = $client->request('GET', $goutteurl);

//webサイト名からDOM処理をstrposで条件分岐する
if(strpos($value,'***')){

$dom[] = $crawler->filter('p.contentsHeader_rating')->each(function($node){
$dom2 = $node -> text();
return $dom2;
});

}elseif(strpos($value,'***') !== false){

$dom4 = $crawler->filter('span.point span')->each(function($node){
//属性で判別取得する場合は一度別の変数へ代入する（余計な値も取得してしまう為）
$dom2 = $node->attr('class');

//目的のテキストを取得し、それ以外はtrueを返す
if($dom2 === 'label' || $dom2 === 'sub'){
return true;
}else{

$dom3 = $node->text();
$dom3 = $dom3 / 20;//5点満点評価へ変換計算
$dom3 = round($dom3 , 2);//小数点繰り上げ（引数の2は小数点第2位表示）
return $dom3;
}


});

//trueでなければ配列へ代入する処理
foreach($dom4 as $key => $val){
if($val !== true){
$dom[][] = $val;//配列の形式を合わせる
}


}


}elseif(strpos($value,'***') !== false){

$dom[] = $crawler->filter('span.pc-report-header-review-aggregate__rating-average')->each(function($node){
$dom2 = $node -> text();
return $dom2;
});

}elseif(strpos($value,'***') !== false){

$dom[] = $crawler->filter('em.total-evaluate-point')->each(function($node){
$dom2 = $node -> text();
return $dom2;
});


}


}//foreach終点

//評価URLから取得した評価値をSESSIONへ代入、表示用変数へ代入
$review_val = $_SESSION['corp']['review_val'] = $dom;
$revval= 0;//評価点代入変数の初期化
$revcon = 0;//評価数カウントの初期化

if( !empty($review_val) ){//評判URLの有無チェック
foreach($review_val as $key => $val){
$revcon++;//評価URL数の合計数
foreach($val as $val2){
$revval += $val2;//評価点数の合計
$rev_data[] = (string)$val2;
}
}

$review_avg = $revval / $revcon;//平均点計算
$review_avg = round($review_avg , 2);//小数点繰り上げ
$rev_avg = $_SESSION['corp']['review_avg'] = $review_avg;

}else{
echo "評判URLが空です。<br />";
}


}
//評価点の個別表示用処理
$rev_data = postdata($rev_data);

   //求人数
   $carr_num = $_POST['confirm'];
   //求人データ
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

//var_dump($_POST['carr_time']);

//求人value配列処理
for( $i=0 ; $i < $carr_num ; $i++){
$job[$i]['職種'] = $jobarr[$i]['carr_syok'] = $carr_syok[$i];
$job[$i]['勤務地'] = $jobarr[$i]['carr_plc'] = $carr_plc[$i];
$job[$i]['仕事内容'] = $jobarr[$i]['carr_app'] = $carr_app[$i];
$job[$i]['条件資格'] = $jobarr[$i]['carr_info'] = $carr_info[$i];
$job[$i]['雇用形態'] = $jobarr[$i]['carr_sty'] = $carr_sty[$i];
$job[$i]['給与形態'] = $jobarr[$i]['carr_sal'] = $carr_sal[$i];
$job[$i]['募集内容'] = $jobarr[$i]['carr_key'] = $carr_key[$i];
$job[$i]['求人URL'] = $jobarr[$i]['carr_url'] = $carr_url[$i];
$job[$i]['学歴'] = $jobarr[$i]['carr_acaback'] = $carr_acaback[$i];
$job[$i]['年齢'] = $jobarr[$i]['carr_age'] = $carr_age[$i];
$job[$i]['残業'] = $jobarr[$i]['carr_overtime'] = $carr_overtime[$i];
$job[$i]['年間休日'] = $jobarr[$i]['carr_holy'] = $carr_holy[$i];
//先ずdate型をstrtotimeでタイムスタンプ型へ
$jobarr[$i]['carr_time'] = strtotime($carr_time[$i]);
//その後表示用にタイムスタンプ型からdate型へ
$job[$i]['掲載期間'] = date("Y/m/d H:i:s",$jobarr[$i]['carr_time']); 
}
//一つの求人を1つの配列へ代入後にSESSIONのjobへ代入する
$_SESSION['job'] = $jobarr;

//var_dump($_SESSION['job']);

//求人表示処理
function preview($this,$this2){

for( $i=0 ; $i < $this2 ; $i++){
$k_no = $i +1;

echo <<<EOF
<table class="table">
  <thead>
    <tr>
      <th colspan="2" class="bg-white">求人情報{$k_no}</th>
   </tr>
  </thead>
 <tbody>
EOF;

foreach ($this[$i] as $key => $value) {
if( is_array($value) ){
$value2 = postdata($value);

echo <<<EOF
    <tr>
      <td>{$key}</td>
      <td>{$value2}</td>
   </tr>
EOF;

} else {

echo <<<EOF
    <tr>
      <td>{$key}</td>
      <td>{$value}</td>
   </tr>
EOF;

}

}

echo <<<EOF
 </tbody>
</table>
EOF;

}

}

echo <<<EOF
<div class="mb-3">
入力内容の確認画面です。<br />
入力情報に間違いが無いか確認をしてください。
</div>

<table class="table table-striped">
  <thead>
    <tr>
      <th colspan="2">企業情報</th>
   </tr>
  </thead>
<tbody>
    <tr>
      <td>No.</td>
      <td>$num</td>
   </tr>
   <tr>
      <td>登録日時</td>
      <td>$date</td>
   </tr>
    <tr>
      <td>企業名</td>
      <td>$comp_name</td>
   </tr>
    <tr>
      <td>企業概要</td>
      <td>$comp_info</td>
   </tr>
    <tr>
      <td>企業の特徴</td>
      <td>$comp_key_val</td>
   </tr>
   <tr>
      <td>福利厚生</td>
      <td>$comp_fukuri</td>
   </tr>
    <tr>
      <td>賞与</td>
      <td>$comp_syouyo</td>
   </tr>
    <tr>
      <td>離職率</td>
      <td>$comp_risyoku</td>
   </tr>
    <tr>
      <td>勤続年数</td>
      <td>$comp_kinzoku</td>
   </tr>
    <tr>
      <td>有給休暇</td>
      <td>$comp_yukyu</td>
   </tr>
    <tr>
      <td>企業のPR</td>
      <td>$comp_pr</td>
   </tr>
   <tr>
      <td>証券コード</td>
      <td>$comp_code</td>
   </tr>
   <tr>
      <td>平均年齢・平均年収</td>
      <td>{$code_val}</td>
   </tr>
    <tr>
      <td>企業の業種</td>
      <td>$comp_gyo</td>
   </tr>
    <tr>
      <td>企業の業界</td>
      <td>$comp_gyokai</td>
   </tr>
   <tr>
      <td>会社制度</td>
      <td>$comp_taigu</td>
   </tr>
    <tr>
      <td>口コミ評価URL</td>
      <td>$comp_review_val</td>
   </tr>
    <tr>
      <td>口コミ評価平均点</td>
      <td>{$rev_avg}（{$revcon}サイト合計{$revval}（{$rev_data}））</td>
   </tr>
    <tr>
      <td colspan="2">
EOF;
?>

<?php
preview($job, $carr_num);
?>

</td>
  </tr>
 </tbody>
</table>

<div class="mb-3 text-center">
入力情報に間違いが無ければ以下の送信ボタンを押して登録を完了して下さい。<br />
入力情報に間違いがあった場合は戻るボタンを押して修正を行って下さい。
</div>


<form method="post" action="">
<div class="text-center">
<button type="button" class="btn btn-outline-primary badge-pill w-25" name="btn_back" value="戻る" onclick="history.back()">修正を行う</button>

<button type="submit" class="btn btn-outline-primary badge-pill w-25" name="submit" value="送信">登録を完了する</button>
</div>
</form>



<?php elseif( $page_flag === 2 ): ?>
<?php

$arc = count($arr['data']['id']) - 1;
$comp_name = $arr['data']['id'][$arc]['corp']['comp_name'];
$jobnum = count($arr['data']['id'][$arc]['job']);

echo <<<EOF
<div class="card mb-1">
 <div class="card-body">
<p class="card-text">{$comp_name}の求人を{$jobnum}件</p>
<p class="card-text">上記企業と求人の新規登録が完了しました。</p>
</div>
</div>

<a href="***/test.php" class="btn btn-primary w-100" >新規登録画面へ戻る</a>

EOF;
?>
<?php else: ?>
<?php 
//掲載期間の初期値設定
$rtime = time();
$rdate = date("Y-m-d",$rtime);
?>

<div class="mb-3">
企業の情報、ならびに求人情報を入力して下さい。<br />
<span class="text-danger">*</span>が付いている項目は必須項目となります。
</div>

<form method="post" action="">
<div class="form-group">
    <label for="comp_name">企業名<span class="text-danger">*</span></label>
    <input type="text" name="comp_name" class="form-control form-control-sm" id="comp_name" placeholder="企業名">
  </div>
<div class="form-group">
    <label for="comp_info">企業概要</label>
    <input type="text" name="comp_info" class="form-control form-control-sm" id="comp_info" placeholder="企業概要">
  </div>

<div class="form-group">

<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_jou" value="上場企業">
  <label class="form-check-label" for="comp_key_jou">上場企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_gaisi" value="外資系企業">
  <label class="form-check-label" for="comp_key_gaisi">外資系企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_hijou" value="非上場大手企業">
  <label class="form-check-label" for="comp_key_hijou">非上場大手企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_group" value="グループ企業">
  <label class="form-check-label" for="comp_key_group">グループ企業</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" name="comp_key[]" id="comp_key_cyusyo" value="中小企業">
  <label class="form-check-label" for="comp_key_cyusyo">中小企業</label>
</div>

</div>

  <div class="form-row">

<div class="form-group col-md-3">
    <label for="comp_code">証券コード</label>
    <input type="text" name="comp_code" class="form-control form-control-sm" id="comp_code" placeholder="証券コード" disabled>
  </div>

<div class="form-group col-md-3">
    <label for="comp_gyo">業種<span class="text-danger">*</span></label>
    <select class="form-control form-control-sm" name="comp_gyo" id="comp_gyo">
<option value="">選択してください</option>
<option value="メーカー・製造業">メーカー・製造業</option>
<option value="建築・設備業">建築・設備業</option>
<option value="流通・小売業">流通・小売業</option>
<option value="専門商社・総合商社">専門商社・総合商社</option>
<option value="農林水産業">農林水産業</option>
<option value="物流・運輸業">物流・運輸業</option>
<option value="広告・放送・新聞・出版">広告・放送・新聞・出版</option>
<option value="金融業・保険・不動産業">金融業・保険・不動産業</option>
<option value="IT・情報通信業">IT・情報通信業</option>
<option value="サービス・インフラ・運輸業">サービス・インフラ・運輸業</option>
<option value="市場調査・研究機関">市場調査・研究機関</option>
<option value="公社・官公庁・自治体・団体・教育機関">公社・官公庁・自治体・団体・教育機関</option>
<option value="病院・医療機関">病院・医療機関</option>
   </select>
  </div>

<div class="form-group col-md-3">
    <label for="comp_gyokai">業界</label>
    <select class="form-control form-control-sm" name="comp_gyokai" id="comp_gyokai">
<option value="">選択してください</option>
<option value="自動車・二輪車業界">自動車・二輪車業界</option>
<option value="鉄道業界">鉄道業界</option>
<option value="航空・海運業界">航空・海運業界</option>
<option value="倉庫・運送業界">倉庫・運送業界</option>
<option value="食品・飲料・菓子業界">食品・飲料・菓子業界</option>
<option value="電機・半導体・電子部品業界">電機・半導体・電子部品業界</option>
<option value="医療機器・精密機器業界">医療機器・精密機器業界</option>
<option value="建機・重機・工作機械業界">建機・重機・工作機械業界</option>
<option value="石油・電力・ガス業界">石油・電力・ガス業界</option>
<option value="化学・製薬業界">化学・製薬業界</option>
<option value="鉄鋼・非鉄金属・繊維・素材業界">鉄鋼・非鉄金属・繊維・素材業界</option>
<option value="旅行・ホテル・レジャー業界">旅行・ホテル・レジャー業界</option>
<option value="アパレル・インテリア業界">アパレル・インテリア業界</option>
<option value="ゲーム・玩具・雑貨業界">ゲーム・玩具・雑貨業界</option>
<option value="百貨店・スーパー・飲食業界">百貨店・スーパー・飲食業界</option>
<option value="Webサービス・ネット通販業界">Webサービス・ネット通販業界</option>
    </select>
  </div>

<div class="form-group col-md-3">
    <label for="comp_taigu">会社制度</label>
<select multiple class="form-control form-control-sm" name="comp_taigu[]" id="comp_taigu">
<option value="">選択してください</option>
  <option value="正社員登用・無期転換">正社員登用・無期転換</option>
  <option value="退職金制度">退職金制度</option>
  <option value="転勤無し・地域限定">転勤無し・地域限定</option>
  <option value="在宅勤務">在宅勤務</option>
  <option value="産休・育休">産休・育休</option>
  <option value="週休3日制">週休3日制</option>
  <option value="プレミアムフライデー">プレミアムフライデー</option>
  </select>
</div>

</div>

<div class="form-group">
    <label for="comp_agesal">平均年齢・平均年収</label>
    <input type="text" name="comp_agesal" class="form-control form-control-sm" id="comp_agesal" placeholder="平均年齢・平均年収">
  </div>

<div class="form-row">

<div class="form-group col-md-3">
<label for="comp_kinzoku">勤続年数</label>
<select class="form-control form-control-sm" name="comp_kinzoku" id="comp_kinzoku">
<option value="">選択してください</option>
<option value="平均勤続年数5年以上">平均勤続年数5年以上</option>
<option value="平均勤続年数10年以上">平均勤続年数10年以上</option>
<option value="平均勤続年数15年以上">平均勤続年数15年以上</option>
<option value="平均勤続年数20年以上">平均勤続年数20年以上</option>
<option value="平均勤続年数25年以上">平均勤続年数25年以上</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_risyoku">離職率</label>
<select class="form-control form-control-sm" name="comp_risyoku" id="comp_risyoku">
<option value="">選択してください</option>
<option value="離職率1％以下">離職率1％以下</option>
<option value="離職率5％以下">離職率5％以下</option>
<option value="離職率10％以下">離職率10％以下</option>
<option value="離職率15％以下">離職率15％以下</option>
<option value="離職率20％以下">離職率20％以下</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_syouyo">賞与</label>
<select class="form-control form-control-sm" name="comp_syouyo" id="comp_syouyo">
<option value="">選択してください</option>
<option value="賞与4ヶ月以上">賞与4ヶ月以上</option>
<option value="賞与5ヶ月以上">賞与5ヶ月以上</option>
<option value="賞与6ヶ月以上">賞与6ヶ月以上</option>
<option value="賞与7ヶ月以上">賞与7ヶ月以上</option>
<option value="賞与8ヶ月以上">賞与8ヶ月以上</option>
<option value="賞与9ヶ月以上">賞与9ヶ月以上</option>
<option value="賞与10ヶ月以上">賞与10ヶ月以上</option>
</select>
</div>

<div class="form-group col-md-3">
<label for="comp_fukuri">福利厚生</label>
<select class="form-control form-control-sm" name="comp_fukuri" id="comp_fukuri">
<option value="">選択してください</option>
<option value="手当幾つか有り">手当幾つか有り</option>
<option value="福利厚生幾つか有り">福利厚生幾つか有り</option>
<option value="手当・福利厚生幾つか有り">手当・福利厚生幾つか有り</option>
<option value="福利厚生有り">福利厚生有り</option>
<option value="福利厚生良い">福利厚生良い</option>
</select>
</div>



</div>

 <div class="form-group">
    <label for="comp_yukyu">有給休暇取得率・消化率・日数</label>
    <textarea class="form-control form-control-sm" name="comp_yukyu" id="comp_yukyu" rows="1"></textarea>
  </div>


 <div class="form-group">
    <label for="comp_pr">企業情報PR</label>
    <textarea class="form-control form-control-sm" name="comp_pr" id="comp_pr" rows="2"></textarea>
  </div>

<div class="urlparent">
   <label for="comp_review">口コミ評価URL</label>

<div class="urlfield mb-3">

<div class="input-group">
       <input type="text" name="comp_review[0]" class="form-control form-control-sm" id="comp_review" placeholder="口コミ評価URL">
<div class="input-group-append">
<button type="button" class="btn btn-sm btn-primary trash_review_btn w-100" value="" name="">削除</button>
  </div>
</div>

</div>

</div>

<div class="text-right mb-3">
<button type="button" class="btn btn-sm btn-primary add_review_btn w-100" value="" name="">URL追加</button>
</div>

<div class="card p-2 mb-3">
<div class="parent">
<div class="field card mb-3">

 <div class="card-header kyujin_no">求人登録</div>
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
<button type="button" class="btn btn-sm btn-primary vclear ml10" value="" name="">初期値に戻す</button>
<button type="button" class="btn btn-sm btn-primary clearForm ml10" value="" name="">リセット</button>
<button type="button" class="btn btn-sm btn-primary trash_btn ml10" value="" name="">削除</button>
</div>

</div>


</div>

<button type="button" class="btn btn-sm btn-primary mt10 miw100 add_btn" value="" name="">求人情報を追加する</button>

</div>

<div class="text-center w-100 m-3">
上記の入力内容で宜しければ、以下の確認画面へ進むボタンを押して下さい。
</div>
<button type="submit" class="btn btn-outline-primary btn-block badge-pill" id="confirm" name="confirm" value="">確認画面へ進む</button>

</form>

<?php endif; ?>
</div>
<footer style="height:400px;" class="bg-light mt-5">

<div class="w-100 h-100 d-flex align-items-center">
<div class="mx-auto">Copyright © All Rights Reserved.</div>
</div>

</footer>
</body>