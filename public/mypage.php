<?php
session_start();
require_once '../classes/UserLogic.php';
require_once '../public/function.php';

//ログインしているか判断。していない場合新規登録画面へ返す
$result = UserLogic::checkLogin();

if (!$result) {
    $_SESSION['login_err'] = 'ユーザーを登録してログインしてください。';
    header('Location: signup_form.php');
    return;
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>マイページ</title>
    <style>
        .err {color: red;}
    </style>
</head>
<body>
    <h2>マイページ</h2>
    <p>ログインユーザー：<?php echo h($login_user['name']) ?></p>
    <p>メールアドレス：<?php echo h($_SESSION['email']) ?></p>
    <a href="./login.php">ログアウト</a>
</body>
</html>
