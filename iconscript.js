document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const passwordToggle1 = document.getElementById('password-addon-1');
    const passwordToggle2 = document.getElementById('password-addon-2');

    passwordToggle1.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    passwordToggle2.addEventListener('click', function() {
      const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPasswordInput.setAttribute('type', type);
      this.querySelector('i').classList.toggle('fa-eye-slash');
    });
  });