$(document).ready(function () {

    //Initialisation of the loans datatable
    var table = $('#loans-table').DataTable({
        "order": [[0, 'desc']],
        "paging": false,
        "info": false,
        "searching": false,
        "autoWidth": false,
    });

    //Attaching an event listener triggered when an user click on a loan's row
    $('#loans-table tbody').on('click', 'tr.loan', function () {

        var tr = $(this).closest('tr');
        var row = table.row(tr);

        //Finding if a row was previously expanded
        var rowExpanded = null;
        table.rows().every(function () {
            if (this.child.isShown()) {
                rowExpanded = this;
            }
        });

        //If a row was already expanded...
        if (rowExpanded !== null)
        {
            //... this row is hidden
            var idSliderExpanded = 'bidsforloan-' + rowExpanded.node().getAttribute("data-loanid");
            $('#' + idSliderExpanded).slideUp(function () {
                rowExpanded.child.hide();
            }).closest('tr').prev().removeClass('expanded');
        }

        //If the row clicked on isn't the one wich was expanded, the row will be expanded
        if (rowExpanded === null || (rowExpanded !== null && row.index() !== rowExpanded.index())) {

            var loanId = row.node().getAttribute("data-loanid");
            var idSlider = 'bidsforloan-' + loanId;

            //If the details haven't been fetched yet...
            if (typeof row.child() === 'undefined') {

                //... they are fetched using ajax
                row.child('<div id="' + idSlider + '"></div>', 'no-padding');
                $.ajax({
                    url: '/bidsforloan/' + loanId,
                    type: 'GET',
                    dataType: 'json'})
                        .done(function (data) {
                            $('#' + idSlider).append($.parseJSON(data))
                                .find('table').DataTable({
                                    "order": [[0, 'desc']],
                                    "paging": false,
                                    "info": false,
                                    "searching": false,
                                    "autoWidth": false,
                            });
                        })
                        .error(function (result) {
                            $('#' + idSlider).append($.parseJSON(result.responseText));
                        });
            }

            //The row is expanded to show the details
            row.child.show();
            $('#' + idSlider).slideDown()
                    .closest('tr').prev().addClass('expanded');
        }
    });
});