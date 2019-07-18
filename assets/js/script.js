const flashData_f = $('.flash-data-f').data('flashdata');
const flashData_s = $('.flash-data-s').data('flashdata');
$(document).ready(function () {
    $('[data-bs-chart]').each(function (index, elem) {
        var chart = new Chart($(elem), $(elem).data('bs-chart'));
    });
    $('#dataTable').dataTable();
    $('#full_table').DataTable({
        "paging": false,
        "bPaginate": false,
        "bInfo": false,
        "searching": false,
    });
    $('#top_prio_table').DataTable({
        "paging": false,
        "bPaginate": false,
        "bInfo": false,
        "searching": false,
    });
    var table = $('#tableRank').DataTable({
        "scrollY": "264px",
        "scrollCollapse": true,
        "paging": false,
        "bPaginate": false,
        "bInfo": false,
        "searching": false,
        rowReorder: true,
        columnDefs: [
            { orderable: true, className: 'reorder', targets: 1 },
            { orderable: false, targets: '_all' }
        ]
    });
    table.order([1, 'asc']).draw();
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
    $('#tampil').on('click', function (e) {
        e.preventDefault;
        // console.log('asd');
        if ($('#table_show').is(':hidden')) {
            $('#button_show_hide').html('Hide Table');
            $("html, body").animate({
                scrollTop: $(".bottomView").offset().top - 15
            }, 1000);
            $('#table_show').slideDown(1000);
        } else {
            $('#button_show_hide').html('Show Table');
            $('#table_show').slideUp(1000);
        }
    });
});