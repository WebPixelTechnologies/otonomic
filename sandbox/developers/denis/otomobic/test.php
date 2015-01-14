<?php
$url = "http://wp.otonomic.com/migration/helpers/FacebookReviews.php?url=https://m.facebook.com/page/reviews.php?id=".$_GET['fb_id'];
$data = file_get_contents($url);
echo json_encode($data);
?>