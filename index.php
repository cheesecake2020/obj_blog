<?php
require_once('blog.php');
require_once('functions.php');

ini_set('display_errors', "On");
$blog = new Blog();
// 取得したデータを表示
$blogData = $blog->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ一覧</title>
    <style>
        dt {
            font-weight: 700;
            color: brown;
        }
    </style>
</head>

<body>
    <h1>ブログ一覧</h1>
    <p><a href="form.html">新規作成</a></p>
    <table>
        <tr>
            <th>タイトル</th>
            <th>カテゴリ</th>
            <th>投稿日時</th>
        </tr>
        <?php foreach ($blogData as $collumn) : ?>
            <tr>
                <td><?php echo h($collumn['title']); ?></td>
                <td><?php echo h($blog->setCategoryName($collumn['category'])); ?></td>
                <td><?php echo h($collumn['post_at']); ?></td>
                <td><a href="detail.php?id=<?php echo h($collumn['id']); ?>">詳細</a></td>
                <td><a href="update_form.php?id=<?php echo h($collumn['id']); ?>">編集</a></td>
                <td><a href="blog_delete.php?id=<?php echo h($collumn['id']); ?>">削除</a></td>
            </tr>
            <?php endforeach; ?>
    </table>
</body>

</html>