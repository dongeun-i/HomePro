<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Q&A</title>
    <link rel="stylesheet" href="static/css/contact.css">
    <link rel="stylesheet" href="static/css/qa.css">
</head>
<body>
    <section id="list-house" class="form-section" >
        <nav class="breadcrumb">
            <a onclick="navigate('/home')">홈</a> &gt;
            <span class="page-title">Q&A</span>
        </nav>
        <div class="form-header">
            <h2 class="page-title">Q&A</h2>
            <p class="page-subtitle">궁금하신 점을 질문해주세요 !</p>
        </div>
        <div class="tabs">
            <button class="tab-button" onclick="navigate('/contact', 'form1', '내놓기(매도)', '매물 정보를 입력하세요')">내놓기(매도)</button>
            <button class="tab-button" onclick="navigate('/contact', 'form2', '구하기(매수)', '매수 정보를 입력하세요')">구하기(매수)</button>
            <button class="tab-button active">Q&A</button>
        </div>
        <div class="form-container">
            <div class="btn-container">
                <button class="regi-btn" onclick="openRegiQa()">작성하기</button>
            </div>
            <table>
                <colgroup>
                    <col style="width:5%;">
                    <col style="width:30%;">
                    <col style="width:35%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>제목</th>
                        <th>내용</th>
                        <th>작성일</th>
                        <th>작성자</th>
                        <th>답변상태</th>
                    </tr>
                </thead>
                <tbody>
                <?
                $result = Qa::getList($_GET);
                $index = 1;
                if(count($result) > 0){
                    foreach($result as $item){
                        // 작성자의 이름 가운데 부분 '*' 처리
                        $name = $item['name'];
                        $nameLength = mb_strlen($name, 'UTF-8');
                        if ($nameLength > 2) {
                            $name = mb_substr($name, 0, 1, 'UTF-8') . str_repeat('*', $nameLength - 2) . mb_substr($name, -1, 1, 'UTF-8');
                        }

                        ?>
                        <tr class="question-row question-row-<?=$index?> <?=$item['is_secrete'] == 1?'secrete-q-'.$index:'' ?>">
                            <td><?=$index?></td>
                            <?if($item['is_secrete'] == 1){?>
                                <!-- 비밀글일 경우 -->
                                <td colspan="2">비밀글입니다. <button class="show-password" data-id="<?=$index?>">비밀번호 입력</button></td>
                                <td class="center"><?=$name?></td>
                            <?}else{?>
                                <!-- 일반 글일 경우 -->
                                <td class="center"><?=$item['title']?></td>
                                <td class="left"><?=$item['question']?></td>
                                <td class="center"><?=$name?></td>
                            <?}?>
                            <td><?= date('Y-m-d', strtotime($item['regi_dt']))?></td>
                            <td><?= $item['is_answer'] == 1 ? '답변완료' : '미답변'?></td>
                        </tr>

                        <?if($item['is_answer'] == 1){?>
                        <!-- 답변이 있을 경우 -->
                        <tr class="answer-row">
                            <td class="answer"></td>
                            <td colspan="4" class="answer pre">제목 : <?= $item['title']?><br><?= $item['question']?><hr>답변 : <?= $item['answer']?></td>
                        </tr>
                        <?}?>

                        <!-- 비밀번호 입력창 (비밀글일 경우에만 표시) -->
                        <?if($item['is_secrete'] == 1){?>
                            <tr class="password-row" id="password-row-<?=$index?>" style="display: none;">
                                <td colspan="5">
                                    <label for="password-<?=$index?>">비밀번호:</label>
                                    <input type="password" id="password-<?=$index?>" class="password-input">
                                    <button data-password="<?=$item['password']?>">확인</button>
                                </td>
                               
                            </tr>
                            <tr class="question-hidden-row-<?=$index?>" style="display: none;">
                                <td><?=$index?></td>
                                <td class="center"><?=$item['title']?></td>
                                <td class="left"><?=$item['question']?></td>
                                <td class="center"><?=$name?></td>
                                <td><?= date('Y-m-d', strtotime($item['regi_dt']))?></td>
                                <td><?= $item['is_answer'] == 1 ? '답변완료' : '미답변'?></td>
                            </tr>

                            <?if($item['is_answer'] == 1){?>
                            <tr class="answer-hidden-row-<?=$index?>" style="display: none;">
                                <td class="answer"></td>
                                <td colspan="4" class="answer pre">제목 : <?= $item['title']?><br><?= $item['question']?><hr>답변 : <?= $item['answer']?></td>
                            </tr>
                            <?}?>
                        <?}?>

                        <?
                        $index++;
                    }
                } else { ?>
                    <tr><td colspan="5">질문이 없습니다.</td></tr>
                <?}?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
