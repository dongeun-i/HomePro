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
</head>
<body>
    <section id="list-house" class="form-section" >
        <nav class="breadcrumb">
            <a onclick="navigate('/home')">홈</a> &gt;
            <span class="page-title">내놓기(매도)</span>
        </nav>
        <div class="form-header">
            <h2 class="page-title">내놓기(매도)</h2>
            <p class="page-subtitle">설명</p>
        </div>
        <div class="tabs">
            <button class="tab-button" onclick="showForm('form1', '내놓기(매도)', '매물 정보를 입력하세요')">내놓기(매도)</button>
            <button class="tab-button" onclick="showForm('form2', '구하기(매수)', '매수 정보를 입력하세요')">구하기(매수)</button>
            <button class="tab-button" onclick="showForm('form3', 'Q&A', '질문을 입력하세요')">Q&A</button>
        </div>
        <div class="form-container">
            <div id="form1" class="form-content">
                <!-- 내놓기(매도) 폼 -->
                <form id="sellForm">
                    <input type="hidden" name="mode" value="sellForm">
                    <div class="form-group">
                        <label for="address1">주소</label>
                        <div class=" adress-container-wrap">
                            <div class="adress-container">
                                <input type="text" id="address1" name="address" placeholder="도로명, 지번" required readonly>
                                <button type="button" onclick="execDaumPostcode('postcode1', 'address1')">주소 검색</button>
                            </div>
                            <div class="adress-container">
                                <input type="text" name="detail_address" placeholder="상세주소" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transaction-type">거래종류</label>
                        <select id="transaction-type" name="category">
                            <option>전체 (매매/전세/월세)</option>
                            <?=
                                CodeSelect::getCodeSelect(2);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="property-type">종류</label>
                        <div class="checkbox-group">
                            <?=CodeRadio::getCodeRadio(3,'type',false)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="property-type">방갯수</label>
                        <div class="checkbox-group">
                            <?=CodeRadio::getCodeRadio(6,'room_type',false)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sale-date">매매예정시기</label>
                        <input type="date" id="sale-date" name="sale_date" placeholder="매매예정시기" required>
                    </div>
                    <div class="form-group">
                        <label for="visit_time">방문날짜/시간</label>
                        <input type="date" id="visit_date" name="visit_date" placeholder="방문날짜" required>
                        <input type="time" id="visit_time" name="visit_time" placeholder="방문시간" required>
                    </div>
                    <div class="form-group">
                        <label for="area">평형</label>
                        <input type="text" id="area" name="area" placeholder="평형" required>
                    </div>
                    <div class="form-group">
                        <label for="requester">이름</label>
                        <input type="text" id="requester" name="requester" placeholder="이름" required>
                    </div>
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" placeholder="이메일">
                    </div>
                    <div class="form-group">
                        <label for="phone">연락처</label>
                        <div class="phone-input">
                            <select name="tel_01">
                                <option>010</option>
                            </select>
                            <input type="text" name="tel_02" placeholder="" required>
                            <input type="text" name="tel_03" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="memo">문의 또는 요청사항</label>
                        <textarea id="memo" name="memo" placeholder="문의 또는 요청사항"></textarea>
                    </div>
                    <button class="submit-btn" type="button" onclick="submitForm('sellForm')" >전송</button>
                </form>
            </div>
            <div id="form2" class="form-content" style="display: none;">
                <!-- 구하기(매수) 폼 -->
                <form id="buyForm">
                    <input type="hidden" name="mode" value="buyForm">

                    <div class="form-group">
                        <label for="address1">주소</label>
                        <div class=" adress-container-wrap">
                            <div class="adress-container">
                                <input type="text" id="address2" placeholder="도로명, 지번" name="address" readonly>
                                <button type="button" onclick="execDaumPostcode('postcode1', 'address2')">주소 검색</button>
                            </div>
                            <div class="adress-container">
                                <input type="text" name="detail_address" placeholder="상세주소">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="transaction-type">거래종류</label>
                        <select id="transaction-type" name="category">
                            <option>전체 (매매/전세/월세)</option>
                            <?=
                                codeSelect::getCodeSelect(4);
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="property-type">종류</label>
                        <div class="checkbox-group">
                            <?=codeRadio::getCodeRadio(5,'type',true)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="property-type">방갯수</label>
                        <div class="checkbox-group">
                            <?=CodeRadio::getCodeRadio(7,'room_type',false)?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="buy-date">매매예정시기</label>
                        <input type="date" id="order_date"  name="order_date" placeholder="매매예정시기">
                    </div>
                    <div class="form-group">
                        <label for="visit-time">방문날짜/시간</label>
                        <input type="date" id="visit_date" name="visit_date" placeholder="방문날짜" required>
                        <input type="time" id="visit_time" name="visit_time" placeholder="방문시간" required>
                    </div>
                    <div class="form-group">
                        <label for="area">면적</label>
                        <input type="text" id="area" name="area" placeholder="면적">
                    </div>
                    <div class="form-group">
                        <label for="requester">이름</label>
                        <input type="text" id="requester" name="requester" placeholder="이름">
                    </div>
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" placeholder="이메일">
                    </div>
                    <div class="form-group">
                        <label for="phone">연락처</label>
                        <div class="phone-input">
                            <select name="tel_01">
                                <option>010</option>
                            </select>
                            <input type="text" name="tel_02" placeholder="" required>
                            <input type="text" name="tel_03" placeholder="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="memo">문의 또는 요청사항</label>
                        <textarea id="memo" name="memo" placeholder="문의 또는 요청사항"></textarea>
                    </div>
                    <button class="submit-btn" type="button" onclick="submitForm('buyForm')" >전송</button>
                </form>
            </div>
            <div id="form3" class="form-content" style="display: none;">
                <!-- Q&A 폼 -->
                <form id="qaForm">
                    <input type="hidden" name="mode" value="qa">
                    <div class="form-group">
                        <label for="question">질문</label>
                        <textarea id="question" placeholder="질문을 입력하세요"></textarea>
                    </div>
                    <button class="submit-btn" type="button" onclick="submitForm('qaForm')" >전송</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
