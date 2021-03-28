<?php

/**
 * XSS対策： エスケープ処理
 *
 */
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * CSRF対策
 * @param void
 * @return string $csrf_token
 */
function setToken() {
    //トークンを生成
    //フォームからそのトークンを送信
    //送信後の画面でそのトークンを紹介
    //とーくんを削除
    
    $csrf_token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $csrf_token;

    return $csrf_token;
}
