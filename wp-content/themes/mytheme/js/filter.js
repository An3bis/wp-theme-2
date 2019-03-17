jQuery(document).ready(function($){
    var taxo = jQuery('select option');

    $('#filter-btn').on('click', function(){
        var data = {
            action : 'action', 
            taxe : taxo,
            cat : "Mytest",
            sep : 22
        };

        jQuery.post(ajaxurl, data, function (response) {
            
        });
    });
});