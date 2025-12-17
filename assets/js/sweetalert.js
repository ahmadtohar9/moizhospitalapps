function showSweetAlert(type, message) {
    let iconType = '';
    let titleText = '';

    // Set icon dan title berdasarkan tipe
    if (type === 'success') {
        iconType = 'success';
        titleText = 'Sukses';
    } else if (type === 'error') {
        iconType = 'error';
        titleText = 'Gagal';
    } else if (type === 'warning') {
        iconType = 'warning';
        titleText = 'Peringatan';
    } else if (type === 'info') {
        iconType = 'info';
        titleText = 'Informasi';
    }

    // Tampilkan SweetAlert
    Swal.fire({
        icon: iconType,
        title: titleText,
        text: message,
        timer: 3000, // Durasi tampil (ms)
        showConfirmButton: false // Tidak menampilkan tombol OK
    });
}
