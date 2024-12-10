// Fungsi untuk men-switch tab
function switchTab(tabName) {
    // Menghapus kelas active dari semua tab
    document.querySelectorAll('.tab').forEach(tab => {
        tab.classList.remove('active');
    });

    // Menambahkan kelas active pada tab yang diklik
    const selectedTab = document.getElementById(tabName + '-tab');
    selectedTab.classList.add('active');

    // Pindahkan underline sesuai dengan tab yang aktif
    const underline = document.getElementById('underline');
    setTimeout(() => {
        underline.style.left = selectedTab.offsetLeft + 'px';
        underline.style.width = selectedTab.offsetWidth + 'px';
    }, 100); // Memberi waktu render sebelum mengubah posisi underline
}

// Set default tab yang aktif dan posisi underline saat halaman dimuat
window.onload = function() {
    const activeTab = document.querySelector('.tab.active');
    const underline = document.getElementById('underline');
    if (activeTab) {
        setTimeout(() => {
            underline.style.left = activeTab.offsetLeft + 'px';
            underline.style.width = activeTab.offsetWidth + 'px';
        }, 100); // Memberi waktu render sebelum mengubah posisi underline
    }
};

// Menambahkan event listener pada setiap tab
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        switchTab(tab.id.replace('-tab', '')); // Mengirimkan nama tab tanpa '-tab'
    });
});
