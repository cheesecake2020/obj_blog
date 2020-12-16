<?php
session_start();

require_once('../classes/UserLogic.php');
$result = UserLogic::checklogin();
if($result){
    header('Location:http://localhost:8889/blog/public/mypage.php');
    return;
}
$err =$_SESSION;
// セッションを消す
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ログイン画面</title>
</head>
<body>
<main>

    <h2>ログインフォーム</h2>
    <?php if(isset($login_err)):?>
        <p class="err"><?php echo $login_err;?></p>
    <?php endif;?>
    <form action="login.php" method="POST">
    <div>
    <label for="email">メールアドレス：<input type="email" name="email"></label>
    <?php if(isset($err['email'])):?>
        <p class="err"><?php echo $err['email'];?></p>
    <?php endif;?>

    </div>
    <div>
    <label for="password">パスワード：<input type="password" name="password"></label>
    <?php if(isset($err['password'])):?>
        <p class="err"><?php echo $err['password'];?></p>
    <?php endif;?>
    </div>
    <button type="submit">ログイン</button>
    </form>
    <a href="signup_form.php">新規登録はこちら</a>
</main>
</body>
</html>