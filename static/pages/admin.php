
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>집프로 부동산</title>
</head>
<body>
	<section class="admin-container">
		<h1 class="title">집프로 부동산 관리자</h1>
		<p class="sub-text">집프로 부동산에 오신 것을 환영합니다.</p>
		<div class="buttons">
			<button onclick="navigate('/sales_list', null, '내놓기(매도) 확인', '매물 정보')">매도 확인</button>
			<button onclick="navigate('/order_list', null, '구하기(매수) 확인', '매수 정보')">매수 확인</button>
			<button onclick="navigate('/qa_list', null, 'Q&A', '')">Q&A</button>	
		</div>
	</section>
</body>
</html>
