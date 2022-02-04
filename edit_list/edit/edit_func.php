<?php
//先ずjsonファイルを読み込む
$json_url = "***_data1808.json";

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

//json_decodeで読み込んだjsonファイルをphp配列へ
$arr = getApiDataCurl($json_url);

if($_SERVER["REQUEST_METHOD"]){
//サーバーアクションで条件分岐
$delkey = filter_input(INPUT_POST, 'del');
$editkey = filter_input(INPUT_POST,'edit');
$searchkey = filter_input(INPUT_GET, 'q');
}

//配列のキーと値のチェック処理（共通）
function arrcng($this){
foreach($this as $key => $val){
if(is_array($key)){
arrcng($key);
}elseif(is_array($val)){
arrcng($val);
}else{
echo $key."は".$val."<br />";
}
}
}

//配列の、<br />表示処理
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

function postdata_br($this){ 
if(is_array($this)){
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

?>