<?php
//登録情報一覧表示処理
$_SESSION = array();
$_POST = array();

//sortで逆順（新しく登録した順に）
$arr['data']['id'] = array_reverse($arr['data']['id']);

echo "登録件数は".count($arr['data']['id'])."件です。<br />";
$con_all = count($arr['data']['id']);
$con_paging = 10;
$con_page = $con_all / $con_paging;
//ceilで小数点切り上げ
$con_page = ceil($con_page);
echo "総ページ数は".$con_page."ページです。<br />";
//連想配列の数値型に注意
$page_no = intval($_GET['pid']);
if( empty($page_no) ){
$page_no = 1;
$_GET['pid'] = 1;
}
echo "現在のページは".$page_no."ページ目です。<br />";

//前後のページ数表示設定
$npager = $page_no - 3;
$ppager = $page_no + 3;

//登録情報一覧表示処理（for文）
for($i=0; $i < $con_all ; $i++){
if( $page_no * $con_paging > $i && $i >= $page_no * $con_paging - $con_paging ){

//求人部分表示処理
$jobcount = count($arr['data']['id'][$i]['job']);
//登録日時表示処理
$date = date("Y/m/d H:i:s", $arr['data']['id'][$i]['time']);

for($e = 0 ; $e < $jobcount ; $e++){

$date2 = $arr['data']['id'][$i]['job'][$e]['carr_time'];
$rdate = time();
$warn = "";
if( $date2 < $rdate){
$warn = '<span class="text-danger">期限切れ求人が有ります、更新して下さい。</span>';
break;
}else{
$warn = date("Y/m/d H:i:s", $date2);
}

}

//編集ナンバー調整処理
$ad = count($arr['data']['id']);
$ad = $ad -1;
$n = $ad - $i;

echo <<<EOF
<div class="card mb-1">
  <div class="card-body row">
<div class="col-12">
<h5 class="card-title">id {$i}：{$arr['data']['id'][$i]['corp']['comp_name']} </h5>
</div>
<div class="col-9">
<p class="card-text mb-2">登録日時： {$date} </p>
<p class="card-text mb-2">求人数： {$jobcount} </p>
<p class="card-text">応募期限： {$warn} </p>
</div>
<div class="col-3">
        <form  method="post" action="">
        <button type='submit' class="btn btn-primary w-100 mb-3" name='edit' value='{$n}'>編集</button>
        <button type='submit' class="btn btn-danger w-100" name='del' value='{$n}'>削除</button>
       </form>
</div>

 </div>
</div>
EOF;
}
}

//ページャー表示部分
echo <<<EOF
<nav aria-label="..." class="mt-3">
  <ul class="pagination justify-content-center">
EOF;

if($page_no > 1 ){
$p_prev = $page_no -1;
echo "<li class='page-item'><a href='?pid=".$p_prev."' class='page-link'>前のページへ</a></li>";
}

//前後ページ表示数調整処理
if( $npager <= 0 ){
$pneg = -$npager;
$ppager = $pneg + $ppager;
$npager = 1;
}

if($ppager >= $con_page){
$pneg = $ppager - $con_page;
$pneg = intval($pneg);
$npager = $npager - $pneg;
$ppager = $con_page;
}

for($i= $npager ; $i <= $ppager ; $i++){

if( $page_no === $i){
echo "<li class='page-item active'><span class='page-link'>".$i."</span></li>";
} else {
echo "<li class='page-item'><a href='?pid=".$i."' class='page-link'>$i</a></li>";
}

}

if( $page_no < $con_page){
$p_next = $page_no + 1;
echo "<li class='page-item'><a href='?pid=".$p_next."' class='page-link'>次のページへ</a></li>";
}

echo <<<EOF
  </ul>
</nav>
EOF;


?>