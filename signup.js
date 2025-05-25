function jsonCheckUsername(json) {
  const container = document.querySelector('.username');
  const span = container.querySelector('span');
  if (!json.exists) {
    container.classList.remove('errorj');
    span.textContent = "";
    formStatus.username = true;
  } else {
    container.classList.add('errorj');
    span.textContent = "Nome utente già utilizzato";
    formStatus.username = false;
  }
}

function jsonCheckEmail(json) {
  const container = document.querySelector('.email');
  const span = container.querySelector('span');
  if (!json.exists) {
    container.classList.remove('errorj');
    span.textContent = "";
    formStatus.email = true;
  } else {
    container.classList.add('errorj');
    span.textContent = "Email già utilizzata";
    formStatus.email = false;
  }
}

function fetchResponse(response) {
  return response.ok ? response.json() : null;
}

function checkUsername() {
  const input = document.getElementById('username');
  const container = document.querySelector('.username');
  const span = container.querySelector('span');

  if (!/^[a-zA-Z0-9_]{1,15}$/.test(input.value)) {
    container.classList.add('errorj');
    span.textContent = "Max 15 caratteri: lettere, numeri o underscore";
    formStatus.username = false;
  } else {
    fetch("check_username.php?q=" + encodeURIComponent(input.value))
      .then(fetchResponse)
      .then(jsonCheckUsername);
  }
}

function checkEmail() {
  const input = document.getElementById('email');
  const container = document.querySelector('.email');
  const span = container.querySelector('span');
  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailPattern.test(input.value)) {
    container.classList.add('errorj');
    span.textContent = "Email non valida";
    formStatus.email = false;
  } else {
    fetch("check_email.php?q=" + encodeURIComponent(input.value))
      .then(fetchResponse)
      .then(jsonCheckEmail);
  }
}

function checkPassword() {
  const input = document.getElementById('password');
  const container = document.querySelector('.password');
  const span = container.querySelector('span');

  if (input.value.length >= 8) {
    container.classList.remove('errorj');
    span.textContent = "";
    formStatus.password = true;
  } else {
    container.classList.add('errorj');
    span.textContent = "La password deve contenere almeno 8 caratteri";
    formStatus.password = false;
  }
}

function checkConfirmPassword() {
  const confirmInput = document.getElementById('confirm-password');
  const password = document.getElementById('password');
  const container = document.querySelector('.confirm-password');
  const span = container.querySelector('span');

  if (confirmInput.value === password.value) {
    container.classList.remove('errorj');
    span.textContent = "";
    formStatus.confirm_password = true;
  } else {
    container.classList.add('errorj');
    span.textContent = "Le password non coincidono";
    formStatus.confirm_password = false;
  }
}

function checkSignup(event) {
  if (!formStatus.username || !formStatus.email || !formStatus.password || !formStatus.confirm_password) {
    event.preventDefault();
    document.getElementById('error-message').textContent = "Correggi gli errori prima di continuare.";
  }
}

const formStatus = {
  username: false,
  email: false,
  password: false,
  confirm_password: false
};

document.getElementById('username').addEventListener('blur', checkUsername);
document.getElementById('email').addEventListener('blur', checkEmail);
document.getElementById('password').addEventListener('blur', checkPassword);
document.getElementById('confirm-password').addEventListener('blur', checkConfirmPassword);
document.getElementById('signup-form').addEventListener('submit', checkSignup);
