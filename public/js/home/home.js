
    $( document ).ready(function() {
        $(document).on('click', '.delAction', function(e){

            bootbox.confirm("Are you sure you want to delete this product?", function(confirmed) {
                if(confirmed==true)
                {
                    e.stopPropagation();


                    var $elem = $(e.target);
                    var $var=$elem.attr("alt");
                    $(location).attr('href', $var);
                }
            });

        });

        $(function () {
            $("img").click(function() {
                $(this).css('border', "solid 6px red");
            });
        });

    });

