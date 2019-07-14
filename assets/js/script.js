const flashData_f = $('.flash-data-f').data('flashdata');
const flashData_s = $('.flash-data-s').data('flashdata');
if (flashData_s) {
    Swal.fire({
        title: 'Sukses',
        html: flashData_s,
        type: 'success'
    });
}
if (flashData_f) {
    Swal.fire({
        title: 'Gagal',
        html: flashData_f,
        type: 'error',
    });
}
$('.delete-button').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
    const user = $(this).attr('value');
    Swal.fire({
        title: "Apakah anda yakin",
        text: "akan menghapus user " + user + "?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus User'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});
$('.user-logout').on('click', function (e) {
    e.preventDefault();
    const href = $(this).attr('href');
    Swal.fire({
        title: 'Logout ?',
        text: "Apakah anda yakin ingin logout?",
        type: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    });
});

