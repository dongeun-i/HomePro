<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>Q&A 게시판</title>
    <style>
        h2 {
            color: #222;
        }
        form {
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
        }
        label {
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }
        .require::before {
            content: '*';
            color: #a00;
            margin-right: 5px;
        }
        input[type="text"], input[type="password"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
            background-color: #f9f9f9;
            box-sizing: border-box;
            max-width: 440px;
        }
        input[type="text"]:focus,
        textarea:focus {
            border-color: #888;
            outline: none;
            background-color: #fff;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .mb {
            margin-bottom: 20px;
        }
        .password-container {
            position: relative;
        }
        .password-container input[type="password"] {
            width: 100%;
            padding-right: 40px;
        }
        .password-container .toggle-password {
            position: absolute;
            top: 58%;
            right: 32px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        #password-container {
            display: none;
            margin-bottom: 20px;
        }
    </style>

</head>
<body>
    <form action="process/qa_proc.php" method="post" autocomplete="off">
        <input type="hidden" name="mode" value="question">

        <label for="name">작성자</label>
        <input type="text" id="name" name="name" autocomplete="off">

        <label for="title" class="require">제목</label>
        <input type="text" id="title" name="title" required autocomplete="off">

        <label for="content" class="require">내용</label>
        <textarea id="content" name="content" rows="5" required autocomplete="off"></textarea>

        <label for="is_secrete" class="mb">
            <input type="checkbox" id="is_secrete" name="is_secrete"> 비밀글로 등록하겠습니다.
        </label>

        <!-- 비밀번호 입력 필드 -->
        <div id="password-container" class="password-container">
            <label for="password" class="require">비밀번호</label>
            <input type="password" id="password" name="password" autocomplete="off">
            <span class="toggle-password" onclick="togglePassword()">확인</span>
        </div>

        <input type="submit" value="제출">
    </form>


</body>
</html>
