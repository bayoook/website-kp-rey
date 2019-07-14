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
const tampil = $('.tampil');
if(tampil){
    var table2 = document.getElementById('table');
    var butShow = document.getElementById('tampil');
    var butSpan = document.getElementById('butSpan');
    butShow.onclick = displayTable;
    const table = $('#table');
    var batas = $(".bottomView").offset();
    function displayTable() {
        if (table2.style.display != "none") {
            table.slideUp(1000);
            // console.log('asd : ', $('html, body').get(0).scrollHeight - table.get(0).scrollHeight - $('footer').get(0).scrollHeight - 44);
            // table2.style.display = "none";
            butSpan.innerHTML = "Show Table"
        } else {
            $("html, body").animate({
                scrollTop: batas.top - 15
                // scrollTop: 640
            }, 1000);
            table.slideDown(1000);
            // table2.style.display = "";
            butSpan.innerHTML = "Hide Table";
        }
    }
}

