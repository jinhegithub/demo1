$(document).ready(function() {

    var $ib_data_panel = $("#ib_data_panel");

    $ib_data_panel.block({ message:block_msg });

    var $cid = $('#cid');

    var $account = $("#account");

    var $vehicle_num=$("#vehicle_num");
    
    $cid.select2({
        theme: "bootstrap"
    });

    $account.select2({
        theme: "bootstrap"
    });

    $vehicle_num.select2({
        theme:"bootstrap"
    });

    $('#tr_type').select2({
        theme:"bootstrap"
    });

    var _url = $("#_url").val();

    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    var $reportrange = $("#reportrange");

    $reportrange.daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        locale: {
            format: 'YYYY/MM/DD'
        }
    }, cb);

    cb(start, end);


    var ib_dt = $('#ib_dt').DataTable( {
        "processing": true,
        "paging": true,
        "serverSide": true,
        "ajax": {
            "url": base_url + "transactions/tr_vehicle_list/",
            "type": "POST",
            "cache": false,
            "data": function ( d ) {

                 d.tr_type = $('#tr_type').val();
                 d.ex_category=$('#ex_category').val();
                 d.in_category=$('#in_category').val();
                 d.vehicle_num=$('#vehicle_num').val();
                 d.reportrange = $reportrange.val();
                 d.cid = $cid.val();
                 d.account = $account.val();

            }
        },
        "pageLength": 10,
        responsive: true,
        dom: "<'row'<'col-sm-6'i><'col-sm-6'B>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'><'col-sm-7'p>>",
        fixedHeader: {
            headerOffset: 50
        },
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            {
                extend:    'colvis',
                text:      '<i class="fa fa-columns"></i>',
                titleAttr: 'Columns'
            },
            {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy'
            },
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            },
            {
                extend:    'print',
                text:      '<i class="fa fa-print"></i>',
                titleAttr: 'Print'
            },
            {
                extend:    'pageLength',
                text:      '<i class="fa fa-bars"></i>',
                titleAttr: 'Entries'
            }
        ],
        "columnDefs": [
            { "orderable": false, "targets":11 }
        ],
        "order": [[ 0, 'desc' ]],
        "scrollX": true,
        "initComplete": function () {
            $ib_data_panel.unblock();
            
        }
    } );


    var init_data=function(){
        $.post(_url + "transactions/get_tr_searchdata/vehicle", $("#frm_search").serialize())
            .done(function (data) {
                if (data) {
                    // console.log(data);
                    $('#total_entries').html(data.total_records);
                    $('#debit').html(data.total_dr);
                    $('#credit').html(data.total_cr);
                }

            });
    };

    init_data();

    var $ib_filter = $("#ib_filter");



    $ib_filter.on('click', function(e) {
        e.preventDefault();

        $.post(_url + "transactions/get_tr_searchdata/vehicle", $("#frm_search").serialize())
            .done(function (data) {
                if(data){
                    // console.log(data);
                    $('#total_entries').html(data.total_records);
                    $('#debit').html(data.total_dr);
                    $('#credit').html(data.total_cr);
                }
            });


        $ib_data_panel.block({ message:block_msg });

        ib_dt.ajax.reload(
            function () {
                $ib_data_panel.unblock();
            }
        );

    });

    // $('#ib_search').keyup(function(){
    //     ib_dt.search($(this).val()).draw() ;
    //
    // })


} );

