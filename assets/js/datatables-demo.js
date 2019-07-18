// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable();
  var table = $('#tableRank').DataTable({
    "bPaginate": false,
    "bLengthChange": false,
    "bFilter": true,
    "bInfo": false,
    "bAutoWidth": false,
    "searching": false,
    rowReorder: true,
    columnDefs: [
      { orderable: true, className: 'reorder', targets: 1 },
      { orderable: false, targets: '_all' }
    ]
  });
  table
    .order([1, 'asc'])
    .draw()
});
