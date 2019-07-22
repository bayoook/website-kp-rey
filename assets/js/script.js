const flashData_f = $('.flash-data-f').data('flashdata');
const flashData_s = $('.flash-data-s').data('flashdata');
$(document).ready(function () {
    chart = $('canvas');
    console.log('chart :', chart);
    $('[data-bs-chart]').each(function (index, elem) {
        var chart = new Chart($(elem), $(elem).data('bs-chart'));
    });
    $('#dataTable').dataTable();
    $('#full_table').DataTable({
        "paging": false,
        "bInfo": false,
        "searching": false,
    });
    $('#history_table').DataTable({
        "searching": false,
    });
    $('#top_prio_table').DataTable({
        "paging": false,
        "bInfo": false,
        "searching": false,
    });
    $('#example').DataTable({
        order: [
            [2, 'asc']
        ],
        rowGroup: {
            dataSrc: 2
        }
    });
    var table = $('#tableRank').DataTable({
        "scrollY": "264px",
        "scrollCollapse": true,
        "paging": false,
        "bInfo": false,
        "searching": false,
        rowReorder: true,
        columnDefs: [{
            orderable: true,
            className: 'reorder',
            targets: 1
        },
        {
            orderable: false,
            targets: '_all'
        }
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
    $(".form_upload").submit(function (e) {
        const href = $(this).attr('action');
        Swal.fire({
            showConfirmButton: false,
            allowOutsideClick: false,
            title: 'Upload',
            html: 'Please wait this may take a few minutes',
            onBeforeOpen: () => {
                Swal.showLoading()
            }
        })
    });
    $('.delete-button').on('click', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const user = $(this).attr('value');
        const status = $(this).attr('status');
        Swal.fire({
            title: "Apakah anda yakin",
            text: "akan menghapus " + status + " " + user + "?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus ' + status
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
                setCookie('table', '', '')
                setCookie('full', '', '')
                setCookie('average', '', '')
                setCookie('priority', '', '')
                setCookie('ranking', '', '')
                setCookie('chart', '', '')
                document.location.href = href;
            }
        });
    });
    $('.card-header button').on('click', function (e) {
        name = $(this).attr('name');
        interfal = 700
        if ($(this).parent().next().is(':visible')) {
            $(this).parent().next().slideUp(interfal);
            if (name == 'chart')
                $(this).html('Show Chart');
            else $(this).html('Show Table');
            setCookie(name, 'hide', 1);
        }
        else {
            $(this).parent().next().slideDown(interfal);
            if (name == 'chart')
                $(this).html('Hide Chart');
            else $(this).html('Hide Table');
            setCookie(name, 'show', 1);
            if (name == 'ranking')
                table.order([1, 'asc']).draw();
            if (name != 'ranking' && name != 'chart')
                $("html, body").animate({
                    scrollTop: $(this).parent().parent().offset().top - 15
                }, interfal);
        }
    })

});
check_sh('chart'); check_sh('ranking'); check_sh('full'); check_sh('priority'); check_sh('average');
function check_sh(cname) {
    button_sh = $(".card-header button[name*='" + cname + "']")
    if (getCookie(cname) == 'hide') {
        if(cname == 'chart')
            button_sh.html('Show Chart')
        else button_sh.html('Show Table');
        button_sh.parent().next().hide()
    } else {
        if(cname == 'chart')
            button_sh.html('Hide Chart')
        else button_sh.html('Hide Table');
        button_sh.parent().next().show()
    }
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
