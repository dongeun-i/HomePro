function showForm(formId, title, subtitle) {
    const forms = document.querySelectorAll('.form-content');
    forms.forEach(form => {
        form.style.display = 'none';
        form.classList.remove('active');
    });

    const activeForm = document.getElementById(formId);
    activeForm.style.display = 'block';
    activeForm.classList.add('active');

    const buttons = document.querySelectorAll('.tab-button');
    buttons.forEach(button => {
        button.classList.remove('active');
    });

    const activeButton = document.querySelector(`.tab-button[onclick="showForm('${formId}', '${title}', '${subtitle}')"]`);
    if (activeButton) {
        activeButton.classList.add('active');
    }
    const pageTitleElements = document.querySelectorAll('.page-title');
    pageTitleElements.forEach(el => el.textContent = title);

    const pageSubtitleElements = document.querySelectorAll('.page-subtitle');
    pageSubtitleElements.forEach(el => el.textContent = subtitle);
}


function execDaumPostcode(postcodeId, addressId) {
    new daum.Postcode({
        oncomplete: function(data) {
            const postcode = document.getElementById(postcodeId);
            const address = document.getElementById(addressId);

            // postcode.value = data.zonecode;
            address.value = data.address;
        }
    }).open();
}

function submitForm(formId) {
    var form = document.getElementById(formId);

    // 유효성 검사
    if (!form.checkValidity()) {
        alert('모든 필수 필드를 입력해주세요.');
        return false;
    }

    // 폼 데이터를 가져오기
    var formData = new FormData(form);
    console.log(formData);
    return false;
    // Ajax 요청 보내기
    fetch('process/contact_proc.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert('폼이 성공적으로 제출되었습니다.');
        console.log(result);
    })
    .catch(error => {
        console.error('오류가 발생했습니다:', error);
    });

    return false; // 폼이 실제로 제출되지 않도록 함
}
