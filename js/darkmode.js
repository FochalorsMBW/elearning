const body = document.body;
const toggleButton = document.getElementById("toggleButton");
const toggleIcon = document.getElementById("toggleIcon");

// Fungsi untuk mengaktifkan dark mode
function enableDarkMode() {
    body.setAttribute("data-bs-theme", "dark");
    body.classList.replace("bg-light", "bg-dark");
    body.classList.replace("text-dark", "text-light");
    body.classList.add("dark-mode");
    body.classList.remove("light-mode");
    toggleIcon.classList.replace("bi-sun-fill", "bi-moon-fill");
    localStorage.setItem("theme", "dark"); // Simpan preferensi pengguna
    updateThemeLinks('dark');
}

// Fungsi untuk mengaktifkan light mode
function enableLightMode() {
    body.setAttribute("data-bs-theme", "light");
    body.classList.replace("bg-dark", "bg-light");
    body.classList.replace("text-light", "text-dark");
    body.classList.add("light-mode");
    body.classList.remove("dark-mode");
    toggleIcon.classList.replace("bi-moon-fill", "bi-sun-fill");
    localStorage.setItem("theme", "light"); // Simpan preferensi pengguna
    updateThemeLinks('light');
}

// Fungsi untuk memperbarui warna link sesuai tema
function updateThemeLinks(theme) {
    const themeLinks = document.querySelectorAll('.theme-link');
    themeLinks.forEach(link => {
        if (theme === 'dark') {
            link.classList.remove('text-dark');
            link.classList.add('text-light');
        } else {
            link.classList.remove('text-light');
            link.classList.add('text-dark');
        }
    });
}

// Cek preferensi pengguna dari localStorage saat halaman dimuat
const savedTheme = localStorage.getItem("theme");
if (savedTheme === "dark") {
    enableDarkMode();
} else {
    enableLightMode();
}

// Tambahkan event listener pada tombol toggle
toggleButton.addEventListener("click", () => {
    if (body.getAttribute("data-bs-theme") === "light") {
        enableDarkMode();
    } else {
        enableLightMode();
    }
});
