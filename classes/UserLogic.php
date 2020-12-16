<?php
require_once('../dbconnect.php');

class UserLogic extends Dbc
{

    /**
     * ユーザを登録する
     * @param array $userData
     * @return bool $result
     */
    public static function createUser($userData)
    {
        $result = false;
        $pdo = new Dbc();
        $sql = 'INSERT INTO users (name,email,password) VALUES (?,?,?)';
        // ユーザーデータを配列に入れる
        $arr = [];
        $arr[] = $userData['username'];
        $arr[] = $userData['email']; //email
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT); //password
        try {
            $stmt = $pdo->dbConnect()->prepare($sql);
            $result = $stmt->execute($arr);
            return $result;
        } catch (\Exception $e) {
            echo $e;
            return $result;
        }
    }

    /**
     * ログイン処理
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function login($email, $password)
    {
        // 結果
        $result = false;
        //ユーザーをemailから検索して取得
        $user = self::getUserByEmail($email);
        if (!$user) {
            $_SESSION['msg'] = 'メールアドレスが一致しません';
            return $result;
        }
        // パスワードの紹介
        if (password_verify($password, $user['password'])) {
            // ログイン成功
            session_regenerate_id(true); //新しいセッションを作る
            $_SESSION['login_user'] = $user;
            $result = true;
            return $result;
        } else {
            $_SESSION['msg'] = 'パスワードが一致しません';
            return $result;
        };
    }

    /**
     * emailからユーザーを取得
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail($email)
    {
        $pdo = new Dbc();
        // SQLの準備
        $sql = 'SELECT * FROM users WHERE email = ?';
        // emailを配列に入れる
        $arr = [];
        $arr[] = $email;

        try {
            $stmt = $pdo->dbConnect()->prepare($sql);
            $stmt->execute($arr);
            // SQLの実行
            // SQLの結果を返す
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
    }

    /**
     * ログイン☑
     * @param void
     * @return bool $result
     */
    public static function checklogin()
    {
        $result = false;
        // セッションにログインユーザーが入っていなかったらfalse
        if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {

            return $result = true;
        }
        return $result;
    }

    /**
     * ログアウト処理
     * @param void
     * @return bool $result
     */
    public static function logout()
    {
        $_SESSION = array();
        // セッションを切断するにはセッションクッキーも削除する。
        // Note: セッション情報だけでなくセッションを破壊する。
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
            session_destroy();
        }
    }

     /**
     * プロフィール表示
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function viewprofile($email)
    {
        $pdo = new Dbc();
        // SQLの準備
        $sql = 'SELECT * FROM users WHERE email = ?';
        // emailを配列に入れる
        $arr = [];
        $arr[] = $email;

        try {
            $stmt = $pdo->dbConnect()->prepare($sql);
            $stmt->execute($arr);
            // SQLの実行
            // SQLの結果を返す
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            echo $e;
            return false;
        }
    }
}
