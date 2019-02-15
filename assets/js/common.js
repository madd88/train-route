
$(document).ready(function () {

    $( "#city_from" ).autocomplete({
        source: function(request, response) {
            $.getJSON("/core/ajax.php", { action: 'getCities', term: request.term },
                response);
        },
        minLength: 2,
        search: function( event, ui ) {
            $("#city_from_id").val(0);
        },
        select: function( event, ui ) {
            $("#city_from_id").val(ui.item.id);
            //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
        }
    });

    $( "#city_to" ).autocomplete({
        source: function(request, response) {
            $.getJSON("/core/ajax.php", { action: 'getCities', term: request.term },
                response);
        },
        minLength: 2,
        search: function( event, ui ) {
            $("#city_to_id").val(0);
        },
        select: function( event, ui ) {
            $("#city_to_id").val(ui.item.id);
            //console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
        }
    });
    
    $('#find_route').click(function () {

        var data = $('#route_form').serialize();

        $.ajax({
            type: 'POST',
            url: '/core/ajax.php',
            data: data,
            dataType: 'json',
            beforeSend: function (ui) {
                $('.progress').show();
                $('#route').hide();
                $('#train_info').html("");
                $('h2').hide();
                $('#route').DataTable().destroy();
            },
            success: function (dataResponse) {
                $('.progress').hide();
                if(dataResponse.error){
                    $.notify(dataResponse.error, "error");
                }
                else{

                    var cityFrom   = $("#city_from").val();
                    var cityTo     = $("#city_to").val();
                    var fullRoute  = dataResponse.route_list.stop_list;
                    var startIndex = 0;
                    var stopIndex  = -1;

                    $.each(fullRoute, function (index, value) {
                        if (value.stop == cityFrom) startIndex = index;
                        if (value.stop == cityTo) stopIndex = ++index;
                    });
                    stopIndex = (stopIndex < 0) ? fullRoute.length - 1  : stopIndex;
                    var spl = fullRoute.slice(startIndex, stopIndex);
                    var data = (spl.length > 0) ? spl : fullRoute;

                    $('h2').text('Маршрут');
                    $('#train_info').html('Поезд: ' + dataResponse.train_description.number + "<br/>Основной маршрут:" + dataResponse.train_description.from + " - " + dataResponse.train_description.to);
                    $('#route').show();

                    $('#route').DataTable( {
                        data: data,
                        ordering:  false,
                        pageLength: 50,
                        columns: [
                            { data: 'stop' },
                            { data: 'arrival_time' },
                            { data: 'departure_time' },
                            { data: 'stop_time' }
                        ],
                        language: {
                            "zeroRecords": "Ничего не найдено",
                            "info": "Страница _PAGE_ из _PAGES_",
                            "lengthMenu": "Показать _MENU_ на странице",
                            "infoEmpty": "Записей нет",
                            "search": "Поиск",
                            "paginate": {
                                "first":      "Первая",
                                "last":       "Последняя",
                                "next":       "Вперед",
                                "previous":   "Назад"
                            },
                        }
                    } );

                }
            }
        });
    });

});


