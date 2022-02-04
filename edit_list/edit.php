<?php
session_cache_limiter('public');
session_start();  
//キャッシュリミッターは空白インデント無しで先頭に記載する。
//キャッシュリミッターにより戻るボタンで入力フォームにデータ保持
?>
<?php

require_once("./edit/edit_func.php");

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="referrer" content="no-referrer">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <title>タイトル</title>

<script type="text/javascript" src="***/edit/edit_js.js" charset="UTF-8">
</script>

</head>
<body>
<nav class="navbar navbar-light bg-light mb-3">
<div class="container">
  <a class="navbar-brand" href="***/edit.php">登録情報一覧</a>

<form method="get" action="">
<div class="input-group">
<input type="text" name="q" class="form-control" id="searchbox" placeholder="検索" >
<div class="input-group-append">
<button type='submit' class="btn btn-primary" >検索</button>
</div>
</div>

</form>

<form method="post" action="">
<button type='submit' class="btn btn-primary" name="overt">締め切り検索</button>
</form>

  <a class="btn btn-primary" href="***/test.php">新規登録</a>
</div>
</nav>

<div class="container">

<?php if(!empty($searchkey) && $_SERVER["REQUEST_METHOD"] === "GET"): ?>
<?php

require_once("./edit/edit_search.php");

?>
<?php elseif(isset($editkey) &&  $editkey === "求人追加"): ?>
<?php

require_once("./edit/edit_add.php");

?>
<?php elseif(isset($editkey) &&  $editkey === "求人データを編集する"): ?>
<?php

require_once("./edit/edit_job.php");

?>
<?php elseif(isset($editkey) &&  $editkey === "企業データを編集する"): ?>
<?php

require_once("./edit/edit_comp.php");

?>
<?php elseif(isset($editkey) &&  $editkey === "求人データを削除する"): ?>
<?php

require_once("./edit/edit_jobdel.php");

?>
<?php elseif($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['overt'])): ?>
<?php

require_once("./edit/edit_overt.php");

?>
<?php elseif($_SERVER["REQUEST_METHOD"] === "POST" && isset($delkey) && $delkey !== "削除する" && $delkey !== "削除しない"): ?>
<?php

require_once("./edit/edit_del.php");

?>
<?php elseif($_SERVER["REQUEST_METHOD"] === "POST" && $delkey === "削除する" && $_SESSION['delchk'] === "true"): ?>
<?php

require_once("./edit/edit_del_file.php");

?>
<?php elseif($_SERVER["REQUEST_METHOD"] === "POST" && isset($editkey) &&  $editkey !== "編集実行" && $editkey !== "編集する"): ?>
<?php

require_once("./edit/edit_select.php");

?>

<?php elseif($_SERVER["REQUEST_METHOD"] === "POST" && isset($editkey) &&  $_SESSION['editchk'] === "true" &&  $editkey === "編集実行"): ?>
<?php

require_once("./edit/edit_file_write.php");

?>
<?php else : ?>
<?php

require_once("./edit/edit_top.php");

?>
<?php endif; ?>
</div>

<footer style="height:400px;" class="bg-light mt-5">

<div class="w-100 h-100 d-flex align-items-center">
<div class="mx-auto">Copyright © All Rights Reserved.</div>
</div>

</footer>

</body>
