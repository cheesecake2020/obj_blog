<?php
session_start();
require_once('../classes/UserLogic.php');
$user = new UserLogic();
require_once('../functions.php');
ini_set('display_errors',"On");
// ログインしているか判定、していなかったら新規登録画面へ返す
$result = UserLogic::checklogin();
$result = $user->getById($_GET['id']);
if(!$result){
    $_SESSION['login_err'] = 'ユーザーを登録してログインしてください';
    header('Location:http://localhost:8889/blog/public/signup_form.php');
        return;
}
$login_user = $_SESSION['login_user'];
var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>マイページ</title>
</head>
<body>
    <main>
        <h2>マイページ</h2>
        <p>ログインユーザー：<?php echo h($login_user['name']);?></p>
        <p>メールアドレス：<?php echo h($login_user['email']);?></p>
        <form action="logout.php" method="POST">
            <input type="submit" value="ログアウト" name="logout">
        </form>
    </main>
</body>
</html>