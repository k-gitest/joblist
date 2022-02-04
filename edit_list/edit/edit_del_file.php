<?php
//ファイルロック処理
$lockfile = 'lock.txt';
$lock_fp = fopen($lockfile,"w");//ロックファイルによるロック
flock($lock_fp,LOCK_EX);//LOCK_EXによるロック開始

//削除処理実行前にバックアップを作成する
$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
$file = fopen('./***.json_delback', 'w');
fputs($file, $json);
fclose($file);


//削除実行処理
$del2 = $_SESSION['delkey'];
//数値型へ変換する(注意：数値型の数と文字列型の数は別物)
$del2 = intval($del2);

//foreachのkeyは数値型
foreach ($arr['data'] as $record) {
 foreach ($record as $key => $value) {
if($del2 === $key){
unset($arr["data"]["id"][$key]);
$arr["data"]["id"] = array_values($arr["data"]["id"]);
break 2;
}

}
}

$json = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

//削除の場合はオプションwを使用する
$file = fopen('./***.json', 'w');
fputs($file, $json);
fclose($file);
//ファイル書き込み後はリロードによる重複対策で$_SESSIONと$_POSTを初期化する
$_SESSION = array();
$_POST = array();

//ロック解除
fclose($lock_fp);

echo "削除しました。<br />";
?>