<?php
require_once('blog.php');
$blogs = $_POST;
ini_set('display_errors',"On");

$blog = new Blog();
$blog->blogValidate($blogs);
$blog->blogUpdate($blogs);
?>
<p><a href="index.php">戻る</a></p>