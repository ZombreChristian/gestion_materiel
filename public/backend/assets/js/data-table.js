$(document).ready(function() {

    $('#dataTableExample thead tr')
    .clone(true)
    .addClass('filters')
    .appendTo('#dataTableExample thead');
    'use strict';

    $('#dataTableExample').DataTable({

// --------------------
orderCellsTop: true,
fixedHeader: true,
initComplete: function () {
    var api = this.api();

    // For each column
    api
        .columns()
        .eq(0)
        .each(function (colIdx) {
            // Set the header cell to contain the input element
            var cell = $('.filters th').eq(
                $(api.column(colIdx).header()).index()
            );
            var title = $(cell).text();
            $(cell).html('<input type="text" placeholder="' + title + '" />');

            // On every keypress in this input
            $(
                'input',
                $('.filters th').eq($(api.column(colIdx).header()).index())
            )
                .off('keyup change')
                .on('change', function (e) {
                    // Get the search value
                    $(this).attr('title', $(this).val());
                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                    var cursorPosition = this.selectionStart;
                    // Search the column for that value
                    api
                        .column(colIdx)
                        .search(
                            this.value != ''
                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                : '',
                            this.value != '',
                            this.value == ''
                        )
                        .draw();
                })
                .on('keyup', function (e) {
                    e.stopPropagation();

                    $(this).trigger('change');
                    $(this)
                        .focus()[0]
                        .setSelectionRange(cursorPosition, cursorPosition);
                });
        });
},




// ---------------------
        "aLengthMenu": [
            [5, 10, 30, 50, -1],
            [5, 10, 30, 50, "Tout"]
        ],
        "iDisplayLength": 30,
        "dom": '<"top"lfB>rtip',
       

        "buttons": [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copier',
                // className: 'btn btn-primary',
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
                // className: 'btn btn-success',
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                // className: 'btn btn-info',
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                // className: 'btn btn-danger',
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimer',
                // className: 'btn btn-warning',
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            'colvis',
        ],
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
        },
    });


    $('#dataTableExample').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Rechercher...');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
    });
});




$(document).ready(function() {
    'use strict';

    $('#dataTableExample1').DataTable({
        "aLengthMenu": [
            [5, 10, 30, 50, -1],
            [5, 10, 30, 50, "Tout"]
        ],
        "iDisplayLength": 5,
        "dom": '<"top"lfB>rtip',
        "buttons": [
            {
                extend: 'copy',
                text: '<i class="fas fa-copy"></i> Copier',
                
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'csv',
                text: '<i class="fas fa-file-csv"></i> CSV',
               
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
               
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimer',
               
                exportOptions: {
                    columns: ':visible' // Exporte toutes les colonnes visibles
                }
            },
            'colvis',
        ],
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json',
        },
    });

    $('#dataTableExample1').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Rechercher...');
        search_input.removeClass('form-control-sm');
        // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
    });
});






