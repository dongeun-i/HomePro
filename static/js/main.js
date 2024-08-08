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
function showList(id,title,subtitle){
    const page_container = document.querySelectorAll('.list-content');
    page_container.forEach(form => {
        form.style.display = 'none';
        form.classList.remove('active');
    });

    const activeList = document.getElementById(id);
    activeList.style.display = 'block';
    activeList.classList.add('active');

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
    // if (!form.checkValidity()) {
    //     alert('모든 필수 필드를 입력해주세요.');
    //     return false;
    // }

    // 폼 데이터를 가져오기
    var formData = new FormData(form);
    $.ajax({
        url: 'process/contact_proc.php',
        data: formData,
        type: 'POST',
        dataType:'json',
        processData: false, // 데이터 직렬화 하지 않음
        contentType: false, // 기본 Content-Type 설정 해제
        success: function (result) {
            console.log(result);
            alert(result.msg);
            if(result.success)navigate('/home');
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });

    return false; // 폼이 실제로 제출되지 않도록 함
}

function login(){
    var form = document.getElementById('loginForm');
    var formData = new FormData(form);
    $.ajax({
        url: 'process/login_proc.php',
        data: formData,
        type: 'POST',
        dataType:'json',
        processData: false, // 데이터 직렬화 하지 않음
        contentType: false, // 기본 Content-Type 설정 해제
        success: function (result) {
            console.log(result);
            alert(result.msg);
        },
        error: function (xhr, status, error) {
            console.error('Error:', status, error);
        }
    });
    return false;
}