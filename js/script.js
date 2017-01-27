// autocomplet : Cette fonction va être executé à chaque fois que le texte va changer
function autocomplet() {
    var keyword = $('#country_id').val();
    $.ajax({
        url: 'ajax_refresh.php',
        type: 'POST',
        data: {keyword:keyword},
        success:function(data){
            $('#country_list_id').show();
            $('#country_list_id').html(data);
        }
    });
}

// set_item :cette fonction va être executé quand un item sera selectionné
function set_item(item) {
    // change input value
    $('#country_id').val(item);
    // hide proposition list
    $('#country_list_id').hide();
}

$(document).ready(function(){
    
    $('html').click(function(){
        $('#country_list_id').hide();
    });

    $('#country_id').click(function(){
        $('#country_list_id').show();
    });

});

$('#sandbox-container .input-daterange').datepicker({
    todayBtn: "linked",
    clearBtn: true,
    language: "fr",
    keyboardNavigation: false,
    forceParse: false
});