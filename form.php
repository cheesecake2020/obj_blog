<?php 
require_once('../functions.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>ブログフォーム</h2>
    <form action="blog_create.php" method="POST">
        <p>ブログタイトル</p>
        <input type="text" name="title" id="title">
        <p>ブログ本文</p>
        <textarea name="content" id="content" cols="30" rows="10"></textarea>
        <br>
        <p>カテゴリ</p>
        <select name="category" id="">
            <option value="1">日常</option>
            <option value="2">プログラミング</option>
        </select>
        <br>
        <input type="radio" name="publish_status" id="" value="1" checked>公開
        <input type="radio" name="publish_status" id="" value="2">非公開
        <br>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken());?>">
        <button type="submit">送信</button>
    </form>
</body>

</html>