<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/myCss.css') }}">
    <script src="{{ URL::asset('js/jquery-1.12.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootbox.js') }}"></script>
</head>
<body>

    <div class="row" style="padding-top:2%;">
    <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 center-block" style="float:none;">
        <form id="property-form" role="form" enctype="multipart/form-data" action="search.php" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xm-12 searchblock">
                    <input class="form-control search" type="text" value="" id="searchtext" name="searchtext" placeholder="Search by address, zip code, city, community, or landmark" required="" style="border-radius:0px; height:50px;" autocomplete="off">
                    <button type="submit" id="submitsearch" value="Search" style="border-radius:0px; height:50px;">Search</button>
                </div>
            </div>

            <div class="row hidden-xs" style="margin-top:10px;">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 center-block">
                    <div class="form-group">
                        <div class="dropdown" id="property-type-button">
                            <button style="height: 47px;
                                           background: inherit;
                                           background-color: rgba(13, 13, 13, 0.498039215686275);
                                           box-sizing: border-box;
                                           border-width: 3px;
                                           border-style: solid;
                                           border-color: rgba(255, 255, 255, 1);
                                           font-family: 'OpenSans-Bold', 'Open Sans Bold', 'Open Sans';
                                           font-weight: 700;
                                           font-style: normal;
                                           font-size: 16px; color: #FFFFFF; width:100%;
                                           border-radius:0;
                                           text-align:center;"
                                           data-toggle="dropdown"
                                           class="dropdown-toggle">
                                <span class="dropdown-label" style="float:none; font-weight: bold;">For Sale</span>
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-select" id="property-type">
                                <li class="type-radio ">
                                    <input type="radio" name="type" value="">
                                    <a>All</a>
                                </li>
                                <li class="type-radio active">
                                    <input type="radio" name="type" value="purchase" checked="">
                                    <a>For Sale</a>
                                </li>
                                <li class="type-radio ">
                                    <input type="radio" name="type" value="rent">
                                    <a >For Rent</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                <!-- price range -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8 center-block">
                    <div class="form-group">
                        <div class="dropdown price-caret">
                            <button style="height: 47px;background: inherit;background-color: rgba(13, 13, 13, 0.498039215686275);box-sizing: border-box;border-width: 3px;border-style: solid;border-color: rgba(255, 255, 255, 1);font-family: 'OpenSans-Bold', 'Open Sans Bold', 'Open Sans';font-weight: 700;font-style: normal;font-size: 16px;color: #FFFFFF; width:100%; border-radius:0;" data-toggle="dropdown" class="btn btn-o btn-white dropdown-toggle">
                                <span class="" style="float:none; font-weight: bold;">Price Range&nbsp;</span> <span class="caret"></span>
                            </button>
                            <div hidden="" id="price-range-dropdown">
                                <input type="text" id="amount1" readonly="" style=" background: transparent; border:0; color:white; font-weight:bold;width:100%;height:auto;text-align:center;padding-top:3%;">
                                <input type="hidden" id="amount" name="pricerange" data-min="" data-max="900000" value="0 - 10000000">
                                <div id="slider-range" style="margin-top: 50px;" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                                <div id="slider-range-rent" style="display:none;" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 0%;"></span><span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0" style="left: 100%;"></span></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- end price range -->


                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 center-block">
                    <div class="form-group">
                        <div class="dropdown" id="bedroom-type-button">
                            <button style="height: 47px;background: inherit;background-color: rgba(13, 13, 13, 0.498039215686275);box-sizing: border-box;border-width: 3px;border-style: solid;border-color: rgba(255, 255, 255, 1);font-family: 'OpenSans-Bold', 'Open Sans Bold', 'Open Sans';font-weight: 700;font-style: normal;font-size: 16px;color: #FFFFFF; width:100%; border-radius:0;" data-toggle="dropdown" class="btn btn-o btn-white dropdown-toggle">
                                <span class="dropdown-label" style="float:none; font-weight: bold;">Bedrooms&nbsp;</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-select" id="bedroom-type-dropdown">
                                <li><input type="radio" name="bedrooms" value="1"><a style="font-weight: bold;">1+ Beds&nbsp;</a></li>
                                <li><input type="radio" name="bedrooms" value="2"><a style="font-weight: bold;">2+ Beds&nbsp;</a></li>
                                <li><input type="radio" name="bedrooms" value="3"><a style="font-weight: bold;">3+ Beds&nbsp;</a></li>
                                <li><input type="radio" name="bedrooms" value="4"><a style="font-weight: bold;">4+ Beds&nbsp;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 center-block">
                    <div class="form-group">
                        <div class="dropdown" id="bathroom-type-button">
                            <button style="height: 47px;background: inherit;background-color: rgba(13, 13, 13, 0.498039215686275);box-sizing: border-box;border-width: 3px;border-style: solid;border-color: rgba(255, 255, 255, 1);font-family: 'OpenSans-Bold', 'Open Sans Bold', 'Open Sans';font-weight: 700;font-style: normal;font-size: 16px;color: #FFFFFF; width:100%; border-radius:0;" data-toggle="dropdown" class="btn btn-o btn-white dropdown-toggle">
                                <span class="dropdown-label" style="float:none; font-weight: bold;">Bathrooms&nbsp;</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-select" id="bathroom-type-dropdown">
                                <li><input type="radio" name="bathrooms" value="1"><a style="font-weight: bold;">1+ Baths&nbsp;</a></li>
                                <li><input type="radio" name="bathrooms" value="2"><a style="font-weight: bold;">2+ Baths&nbsp;</a></li>
                                <li><input type="radio" name="bathrooms" value="3"><a style="font-weight: bold;">3+ Baths&nbsp;</a></li>
                                <li><input type="radio" name="bathrooms" value="4"><a style="font-weight: bold;">4+ Baths&nbsp;</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>