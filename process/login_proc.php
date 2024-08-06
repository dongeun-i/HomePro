<?php
session_start(); // 세션 시작

ob_start(); // 출력 버퍼링 시작

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // POST 데이터 출력 (디버깅용)
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if (empty($_POST)) {
        $res_data['success'] = false;
        $res_data['msg'] = '올바르지 못한 접근입니다.';
        echo json_encode($res_data);
        ob_end_flush(); // 버퍼의 내용을 출력
        exit;
    }

    extract($_POST);

    if ($username === 'admin' && $password === 'password') {
        $_SESSION['user_id'] = 1;
        header('Location: /admin');
        ob_end_flush(); // 버퍼의 내용을 출력
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}

ob_end_flush(); // 버퍼의 내용을 출력
?>
