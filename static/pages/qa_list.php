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
                <button class="regi-btn" onclick="openAnswerQa()">답변하기</button>
            </div>
            <table>
                <colgroup>
                    <col style="width:5%;">
                    <col style="width:5%;">
                    <col style="width:35%;">
                    <col style="width:40%;">
                    <col style="width:10%;">
                    <col style="width:10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>선택</th>
                        <th>번호</th>
                        <th>제목</th>
                        <th>내용</th>
                        <th>작성일</th>
                        <th>답변상태</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $result = Qa::getList($_GET);
                        $index = 1;
                        if(count($result)>0){
                        foreach($result as $item){
                    ?>
                    <tr class="question-row">
                        <td><input type="radio" name="che_val" value="<?=$item['id']?>" id="radio-<?=$index?>"></td>
                        <td><?=$index?></td>
                        <td class="center"><?=$item['title']?></td>
                        <td class="center"><?=$item['question']?></td>
                        <td><?= date('Y-m-d',strtotime($item['regi_dt']))?></td>
                        <td><?= $item['is_answer']==1 ? '답변완료':'미답변'?></td>
                    </tr>
                        <?if($item['is_answer']==1){?>
                        <tr class="answer-row">
                            <td  class="answer"></td>
                            <td colspan="4" class="answer pre">제목 : <?= $item['title']?><br><?= $item['question']?><hr>답변 :<?= $item['answer']?></td>
                        </tr>
                        <?}?>
                    <?
                    $index ++;
                    }}else{?>
                        <tr><td colspan=5>질문이 없습니다.</td></tr>
                    <?}?>
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>
