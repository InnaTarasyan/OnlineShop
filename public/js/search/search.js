$(function() {


    $("#priceLabel").click(function(){
        //$("#priceDiv").slideToggle("fast");
        $("#priceDiv").toggle("slide");
    });

    $("#countLabel").click(function(){
        $("#countDiv").toggle("slide");
    });

    $( "#slider-range1" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 0, 0 ],
        slide: function( event, ui ) {
            $( "#count" ).val( ui.values[ 0 ] + " -" + ui.values[ 1 ] );
        }
    });
    $( "#count" ).val( $( "#slider-range1" ).slider( "values", 0 ) +
        " -" + $( "#slider-range1" ).slider( "values", 1 ) );

    $( "#slider-range2" ).slider({
        range: true,
        min: 0,
        max: 500,
        values: [ 0, 0 ],
        slide: function( event, ui ) {
            $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
        }
    });
    $( "#amount" ).val( "$" + $( "#slider-range2" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range2" ).slider( "values", 1 ) );


    var page;
    $("#submitSearch").bind('click', function (e, arg1) {


        var data = $("#searchText").val();
        var category = $('#categories option:selected').attr('value');

        var price = $("#amount").val().match(/[0-9\.]+/g);
        price = price + '';
        var array = price.split(',');
        var price1 = array[0];
        var price2 = array[1];

        var count = $("#count").val().match(/[0-9\.]+/g);
        count = count + '';
        var arrayCounts = count.split(',');
        var count1 = arrayCounts[0];
        var count2 = arrayCounts[1];
        var $_token = $("[name='_token']").val();
        var postDate = {
            data: data,
            category: category,
            price1: price1,
            price2: price2,
            count1: count1,
            count2: count2,
            _token: $_token,
            page: page,
        };


        $.ajax({
            type: "POST",
            url: "find",
            dataType: 'json',
            data: postDate,
            async: false,
            success: function (html) {

                if(html.status.toString()=="Success"){
                    $('#res').css('visibility', 'hidden');
                }
                else if(html.status.toString()=="Fail")
                {
                    $("#res").html("<b>Nothing Found</b>");
                    $('#res').css('visibility', 'visible');
                }
                if (html.html == null) {
                    $('#result').css('visibility', 'hidden');
                } else {
                    $('#result').css('visibility', 'visible');
                }

                var result;
                result = html.html;

                $("#result").html(result);
                console.log('ok');
            },
            error: function (response) {
                console.log(response);
            }
        })
    });

    $(document).on('click','.pagination li a',function(e){
        e.preventDefault();
        e.stopPropagation();

        page = $(this).text();

        if($(this).attr("rel")=="next")
        {
            page=  parseInt($(this).parent().siblings('.active').text())+1;

        }else if($(this).attr("rel")=="prev") {

            page=parseInt($(this).parent().siblings('.active').text())-1;
        }

        $("#submitSearch").trigger('click', [page]);

    });
});
