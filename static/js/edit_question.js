const isSecretCheckbox = document.getElementById('is_secrete');
const passwordContainer = document.getElementById('password-container');

// 체크박스 상태에 따라 비밀번호 필드 표시/숨기기
isSecretCheckbox.addEventListener('change', function() {
	if (isSecretCheckbox.checked) {
		passwordContainer.style.display = 'block';
	} else {
		passwordContainer.style.display = 'none';
	}
});

// 비밀번호 표시/숨기기 기능
function togglePassword() {
	const passwordInput = document.getElementById('password');
	const passwordType = passwordInput.getAttribute('type');
	if (passwordType === 'password') {
		passwordInput.setAttribute('type', 'text');
	} else {
		passwordInput.setAttribute('type', 'password');
	}
}