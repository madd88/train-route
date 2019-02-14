
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
            success: function (data) {
                if(data.error){
                    alert(data.error);
                }
                else{
                    alert(data.route_list.stop_list[0].stop);
                }
            }
        });
    });

});


