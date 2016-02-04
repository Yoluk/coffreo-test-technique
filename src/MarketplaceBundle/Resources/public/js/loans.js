$(document).ready(function() {
    var table = $('#loans-table').DataTable({
        "order": [[0, 'desc']]
    });
    
    $('#example tbody').on('click', 'tr', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
});