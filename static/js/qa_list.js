function openAnswerQa() {
    // 체크된 라디오 버튼 찾기
    const selectedRadio = document.querySelector('input[name="che_val"]:checked');

    if (!selectedRadio) {
        // 체크된 항목이 없으면 경고 메시지 표시
        alert("체크된 항목이 없습니다. 체크해 주세요.");
        return;
    }

    // 선택된 라디오 버튼의 값 (ID)
    const selectedId = selectedRadio.value;

    // 선택된 ID를 사용하여 작업 수행 (예: 폼 열기)
    // 여기에 원하는 작업을 구현하세요.
    console.log("선택된 ID:", selectedId);
    window.open(`/edit_answer?id=${selectedId}`,"_blank", "width=500,height=500");

    // 예를 들어, 선택된 ID를 폼에 전달하여 팝업을 여는 경우
    // document.getElementById("hiddenInputId").value = selectedId;
    // document.getElementById("form").submit();
}