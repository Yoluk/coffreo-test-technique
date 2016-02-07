$(document).ready(function () {

    var table = $('#loans-table').DataTable({
        "order": [[0, 'desc']],
        "paging": false,
        "info": false,
        "searching": false
    });

    $('#loans-table tbody').on('click', 'tr', function () {

        console.log('---click----');

        var tr = $(this).closest('tr');
        var row = table.row(tr);

        //Finding if a row was previously expanded
        var rowExpanded = null;
        table.rows().every(function (rowIdx, tableLoop, rowLoop) {
            if (this.child.isShown()) {
                console.log($(this).attr('class'));
                rowExpanded = this;
            }
        });

        //If a row was already expanded
        if (rowExpanded !== null)
        {
//            console.log('-----------------');
//            console.log(rowExpanded.toJQuery().get(0));

//            $('div.slider', rowExpanded.child()).slideUp( function () {
            
            var idSliderExpanded = 'bidsforloan-'+rowExpanded.node().getAttribute("data-loanid");
            $('#'+idSliderExpanded).slideUp(function () {
                console.log('HIDE');
                rowExpanded.child.hide();
//                rowExpanded.toJQuery().removeClass('shown');
            });
        }

        //If the row clicked on isn't the one wich was expanded
        if (rowExpanded === null || (rowExpanded !== null && row.index() !== rowExpanded.index())) {
            console.log('SHOW');

            var loanId = row.node().getAttribute("data-loanid");
            var idSlider = 'bidsforloan-'+loanId;
            
            console.log(row.child());
            if (typeof row.child() === 'undefined') {
                
                console.log('no child');
                
                row.child('<div id="'+idSlider+'" class="slider"></div>', 'no-padding');
                console.log(row.child);
//                tr.addClass('shown');
                $.ajax({
                    url: '/bidsforloan/' + loanId,
//                url: '/bidsforloan/0',
                    type: 'GET',
                    dataType: 'json'})
                        .done(function (data) {
                            $('#'+idSlider).append($.parseJSON(data));//.slideDown();
//                            console.log(row);
//                            row.child.show();
//                            console.log(row.child.show());
//                            row.child.show();
//                            $('#'+idSlider).slideDown();
                        })
                        .error(function (result) {
                            $('#'+idSlider).append($.parseJSON(result.responseText));//.slideDown();
//                            row.child.show();
                        })
                        .always(function () {
                            table.row(tr).child.show().toJQuery().slideDown();
                        });
//            $('#'+idSlider).show();
//                row.child.show().toJQuery().slideDown();
//                console.log(row.child());
            }
            row.child.show();
            $('#'+idSlider).slideDown();
//            else {
//                console.log('child loaded');
//                row.child.show();
//                $('#'+idSlider).slideDown();
//            }
//            $('div.slider', row.child()).slideDown();
        }

//        function getBidsForLoan(idLoan) {
//
//            var result = 'TODO';
//
//            var jqxhr = $.ajax("/bidsforloan/" + idLoan)
//                    .done(function () {
//                        console.log(result);
//                        result = "success";
//                        console.log(result);
//                    })
//                    .fail(function () {
//                        result = "error";
//                    })
//                    .always(function () {
//                        result = "complete";
//                    });
//
//            return result;
//        }
    });
});

//
//function showDetails() {
//    
//}
//
//function hideDetails() {
//    
//}

