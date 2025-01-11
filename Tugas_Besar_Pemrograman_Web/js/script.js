const container = document.getElementById('containers');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

function showSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display ='flex'
}  

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar')
    sidebar.style.display ='none'
}  


document.getElementById('loginForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const NO_INDUK = document.getElementById('NO_INDUK').value;
    const PASSWORD = document.getElementById('PASSWORD').value;

    fetch('loginpljr.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `NO_INDUK=${encodeURIComponent(NO_INDUK)}&PASSWORD=${encodeURIComponent(PASSWORD)}`
    })
    .then(response => response.json())
    .then(data => {
        const errorMessage = document.getElementById('errorMessage');
        if (data.success) {
            window.location.href = data.redirect;
        } else {
            errorMessage.textContent = data.message;
            errorMessage.style.display = 'block';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

function validateForm() {
    var password = document.getElementById("PASSWORD").value;
    var confirmPassword = document.getElementById("CONFIRM_PASSWORD").value;
    var errorMessage = document.getElementById("error-message");

    if (password !== confirmPassword) {
        errorMessage.style.display = "inline";
        return false;
    } else {
        errorMessage.style.display = "none";
        return true;
    }
}

document.getElementById('bahan_ajar').addEventListener('change', function() {
    const selectedId = this.value;
    if (selectedId) {
        window.location.href = 'daftartugas.php?id=' + selectedId;
    }
});


    