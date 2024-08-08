<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/config/index.php';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내놓기 / 구하기</title>
    <link rel="stylesheet" href="static/css/contact.css">
    <link rel="stylesheet" href="static/css/table.css">
</head>
<body>
    <section class="sales-section" >
        <nav class="breadcrumb">
            <a onclick="navigate('/admin')">관리자홈</a> &gt;
            <span class="page-title">내놓기(매도)</span>
        </nav>
        <div class="form-header">
            <h2 class="page-title">내놓기(매도)</h2>
            <p class="page-subtitle">설명</p>
        </div>
        <div class="tabs">
            <button class="tab-button" onclick="navigate('/sales_list')">내놓기(매도)</button>
            <button class="tab-button" onclick="navigate('/order_list')">구하기(매수)</button>
            <button class="tab-button" onclick="navigate('/qa_list')">Q&A</button>
        </div>
        <div class="table-wrap">
            <table id="sales_list" class="table table-striped display" style="width:100%">
                <colgroup>
                    <col style="width: 8%;">
                    <col style="width: 8%;">
                    <col style="width: 12%;">
                    <col style="width: 15%;">
                    <col style="width: 15%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                    <col style="width: 20%;">
                    <col style="width: 10%;">
                    <col style="width: 10%;">
                </colgroup>
                <thead>
                    <tr>
                        <th>거래종류</th>
                        <th>종류</th>
                        <th>매매예정시기</th>
                        <th>주소</th>
                        <th>상세주소</th>
                        <th>평수</th>
                        <th>방갯수</th>
                        <th>요청자명</th>
                        <th>이메일</th>
                        <th>연락처</th>
                        <th>요청사항</th>
                        <th>방문날짜</th>
                        <th>등록일시</th>
                    </tr>
                </thead>
                <tbody>
                    <?
                        $result = Sales::getList($_GET);
                        foreach($result as $item){
                    ?>
                    <tr>
                        <td>매매</td>
                        <td><?= $item['building_type_txt'];?></td>
                        <td><?= $item['sales_dt'];?></td>
                        <td><?= $item['address'];?></td>
                        <td><?= $item['detail_address'];?></td>
                        <td><?= $item['area'];?></td>
                        <td><?= $item['room_type_txt'];?></td>
                        <td><?= $item['requester'];?></td>
                        <td><?= $item['email'];?></td>
                        <td><?= $item['tel'];?></td>
                        <td><?= $item['memo'];?></td>
                        <td><?= $item['meeting_dt'];?></td>
                        <td><?= $item['regi_dt'];?></td>
                    </tr>
                    <?}?>
            </tbody>
        </table>
        </div>
    </section>
</body>
</html>
