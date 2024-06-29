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

            postcode.value = data.zonecode;
            address.value = data.address;
        }
    }).open();
}
