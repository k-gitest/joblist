<?php
//jsonファイル設定
$json_url = "";

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

$arr = getApiDataCurl($json_url);

//htmlcpecialcharsのユーザー定義関数
function hsc($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function postdata($this){ 
if(is_array($this)){
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


function postdata_title($this){ 
if(is_array($this)){
$length = count($this);
$no = 0;
foreach($this as $key => $val){
$no++;
    if($no !== $length && $val !== ""){
      $data_val .= $val."、";
    } elseif( $no === $length && $val !== "") {
      $data_val .= $val;
    }
}
return $data_val;
}
}

//ngram類似度計算関数
function get_ngram($str, $n, &$ngrams) {
	$str = preg_replace("/[　\t\n\r ]+/um", '', $str);
	$len = mb_strlen($str);
	if ($len <= 0 || $len <= $n)	return FALSE;

	$cnt = 0;
	for ($pos = 0; $pos < $len; $pos++) {
		$cc = mb_substr($str, $pos, $n);
		if (isset($cc)) {
			$ngrams[$cnt] = $cc;
			$cnt++;
		}
	}
	return $cnt;
}

function similar_ngram($sour, $dest) {
	$n = 3;		//N-gramのN数
	if (($n1 = get_ngram($sour, $n, $ngrams_sour)) == FALSE)	return FALSE;
	if (($n2 = get_ngram($dest, $n, $ngrams_dest)) == FALSE)	return FALSE;

	$result = count(array_intersect($ngrams_sour, $ngrams_dest));

	return (double)$result / $n2;
}

//var_dump($arr_sim);

//対象元となる表示求人の配列から文字列作成する関数
function this_ars($simarr){
foreach($simarr as $key => $val){
  if(is_array($val)){
    foreach($val as $key2 => $val2){
      if(is_array($val2)){
        foreach($val2 as $key3 => $val3){
          if(is_array($val3)){
            foreach($val3 as $key4 => $val4){
              //echo $key3."：".$val4."<br />";
              $str_data .= $val4;
            }
          }elseif(!is_array($val3)){
          if($key === "corp"){
          //echo $key2."：".$val3."<br />";
          $str_data .= $val3;
          }else{
          //echo $key3."：".$val3."<br />";
          $str_data .= $val3;
          }

          }
        }
      }elseif(!is_array($val2)){
      //echo $key2."：".$val2."<br />";
      $str_data .= $val2;
      }
    }
  }

}
return $str_data;
}

//配列から特定キーを削除する関数（多次元配列用（array_walk））
function array_col_delete(&$row, $key, $key_name) {
    unset($row[$key_name]);
}

//比較先となる全求人の配列から文字列を作成する関数
function arpr( $ar ){
foreach( $ar as $key => $val ){
//echo '配列番号は'.$key.'<br />';
  if(is_array($val)){
    foreach($val as $key2 => $val2){
      if(is_array($val2)){
        foreach($val2 as $key3 => $val3){
          if(!is_array($val3) && $key3 !== "num" && $key3 !== "dom_code" && $key3 !== "comp_code"){
          //echo $key3."：".$val3."<br />";
          $str_data[$key] .= $val3; 
          }elseif($key3 === "dom_code"){
          //echo "key3".$key3."：".$val3."<br />";
          $str_data[$key] .= $val3;
          }
          if(is_array($val3)){
            foreach($val3 as $key4 => $val4){
              if(!is_array($val4)){
                if($key2 === "corp" && $key3 !== "comp_review"){
                  //echo $key3."：".$val4."<br />";
                  $str_data[$key] .= $val4;
                }elseif($key3 !== "comp_review" && $key4 !== "carr_url" && $key4 !== "carr_time" && $key4 !== "carr_check"){
                  //echo $key4."：".$val4."<br />";
                  $str_data[$key] .= $val4;
                }
              }
              if(is_array($val4) && $key3 !== "review_val"){
                foreach($val4 as $key5 => $val5){
                  //echo $key4."：".$val5."<br />";
                  $str_data[$key] .= $val5;
                }
              }
            }
          }
        }
      }
    }
  }
}
return $str_data;
}

//中央値算出処理
function median($list){
sort($list);
if (count($list) % 2 == 0){
return (($list[(count($list)/2)-1]+$list[((count($list)/2))])/2);
}else{
return ($list[floor(count($list)/2)]);
}
}

?>