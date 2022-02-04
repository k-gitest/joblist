<?php

session_cache_limiter('public');
session_start(); 

/*
header('Expires:');
header('Cache-Control:');
header('Pragma:'); 
*/

header('Expires: Tue, 1 Jan 2017 00:00:00 GMT');
header('Last-Modified:' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
header('Cache-Control:no-cache,no-store,must-revalidate,max-age=0');
header('Cache-Control:pre-check=0,post-check=0',false);
header('Pragma:no-cache');

require_once( './job_content/job_content_funcs.php' );

date_default_timezone_set('Asia/Tokyo');

?>
<?php if(empty($arr)): ?>
<?php

require_once( './job_content/job_content_emp_arr.php' );

?>
<?php elseif($_GET['job'] === "" && $_GET['place'] === "" && $_GET['money'] === "" && empty($_GET['exp']) &&  empty($_GET['cstyle']) && empty($_GET['english']) && empty($_GET['kisotu']) && empty($_GET['aca']) && empty( $_GET['age'] ) && empty($_GET['rimit']) || $_GET['scale'] === "" && $_GET['system'] === "" && $_GET['welfare'] === "" && empty($_GET['kinzoku']) &&  empty($_GET['risyok']) && empty($_GET['bonus']) && empty($_GET['paidh']) && empty($_GET['income']) && empty($_GET['public']) || $_GET['jq'] === "" ): ?>
<?php

require_once( './job_content/job_content_sele_empty.php' );

?>
<?php elseif(isset($_GET['scale']) || isset($_GET['system']) || isset($_GET['welfare']) || isset($_GET['kinzoku']) || isset($_GET['risyok']) || isset($_GET['bonus']) || isset($_GET['paidh']) || isset($_GET['income']) || isset($_GET['public'])): ?>
<?php

require_once( './job_content/job_content_feature.php' );

?>
<?php elseif(isset($_GET['job']) || isset($_GET['place']) || isset($_GET['money']) || isset($_GET['exp']) || isset($_GET['cstyle']) || isset($_GET['english']) || isset($_GET['kisotu']) || isset($_GET['aca']) ||  isset( $_GET['age'] ) || isset($_GET['rimit'])): ?>
<?php

require_once( './job_content/job_content_sele_isset.php' );

?>
<?php elseif(!empty($_GET['jq'])): ?>
<?php

require_once( './job_content/job_content_jq.php' );

?>
<?php elseif(isset($_GET['j'])): ?>
<?php

require_once( './job_content/job_content_job.php' );

?>
<?php elseif(isset($_GET['c'])): ?>
<!DOCTYPE html>
<?php

require_once( './job_content/job_content_comp.php' );

?>
<?php else : ?>
<?php

require_once( './job_content/job_content_top.php' );

?>
<?php endif; ?>
</div>
<div class="text-center">
<a href="#" class="btn btn-outline-primary">検索トップへ</a>
<a href="#gotop" class="btn btn-outline-primary">上へ戻る</a>
</div>
</div>

<footer class="bg-primary mt-5">
<div class="footer bg-primary">
Copyright © All Rights Reserved.
</div>
</footer>

</body>