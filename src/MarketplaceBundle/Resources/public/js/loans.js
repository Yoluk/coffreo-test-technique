$(document).ready(function() {
    var table = $('#loans-table').DataTable({
        "order": [[0, 'desc']]
    });
    
    $('#loans-table tbody').on('click', 'tr', function () {
        var tr = $(this).closest('tr');
        var row = table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            $('div.slider', row.child()).slideUp( function () {
                row.child.hide();
                tr.removeClass('shown');
            } );
        }
        else {
            // Open this row
            row.child( '<div class="slider" style="display: none">TODO</div>', 'no-padding' ).show();
            tr.addClass('shown');
            
            $('div.slider', row.child()).slideDown();
 
        }
        
    });
});