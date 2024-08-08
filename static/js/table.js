// 테이블 생성 및 DataTables 적용 함수
function createDataTable(containerId) {
    // 테이블 요소 생성
	console.log(containerId);
    let table =$(`#${containerId}`);
	table.DataTable({
		"scrollX": true, // 가로 스크롤 활성화
		"searching": true,  // 검색 기능 활성화
		"paging": true,     // 페이지네이션 활성화
		"info": true,       // 정보 텍스트 활성화 (전체 행 수 등)
		"lengthChange": true, // 페이지네이션 시 표시할 행 수 선택 활성화
		"pageLength": 5,    // 초기 페이지 당 행 수
		"ordering": true,   // 컬럼 정렬 기능 활성화
		"language": {
			"search": "검색: ",
			"lengthMenu": "페이지 당 _MENU_ 개씩 보기",
			"info": "_TOTAL_개의 데이터 중 _START_에서 _END_까지 표시",
			"paginate": {
				"first": "처음",
				"last": "마지막",
				"next": "다음",
				"previous": "이전"
			},
			"infoFiltered": "(총 _MAX_개의 데이터에서 필터링됨)",
			"columnDefs": [
				{ "width": "8%", "targets": 0 },
				{ "width": "8%", "targets": 1 },
				{ "width": "12%", "targets": 2 },
				{ "width": "15%", "targets": 3 },
				{ "width": "15%", "targets": 4 },
				{ "width": "10%", "targets": 5 },
				{ "width": "10%", "targets": 6 },
				{ "width": "10%", "targets": 7 },
				{ "width": "10%", "targets": 8 },
				{ "width": "10%", "targets": 9 },
				{ "width": "20%", "targets": 10 },
				{ "width": "10%", "targets": 11 },
				{ "width": "10%", "targets": 12 }
			]
		}
	});
}