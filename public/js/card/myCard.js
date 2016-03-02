$( document ).ready(function() {

    //executed when user wants to buy a product
    $(document).on('click', '.buy', function(e){

        bootbox.confirm("Are you sure you want to buy this product?", function(confirmed) {

            if(confirmed==true)
            {
                e.stopPropagation();

                var $elem = $(e.target);
                var $var=$elem.attr("alt");
                $(location).attr('href', 'buy?product_id='+$var);

            }
        });

        // var $row = $elem.closest('tr');

    });


    //executed when user wants to delete a product
    $(document).on('click', '.del', function(e){

        bootbox.confirm("Are you sure you want to delete this product?", function(confirmed) {
            if(confirmed==true)
            {
                e.stopPropagation();

                var $elem = $(e.target);
                var $var=$elem.attr("alt");
                $(location).attr('href', 'cartRem?decrease=1&product_id='+$var);
            }
        });

    });

});
/**
 * Created by puchik on 01.03.2016.
 */
