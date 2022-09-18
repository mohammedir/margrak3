@extends("_manageLayout")
@section("body")
    <div class="col-sm-10 col-xs-12">
        <section class="manage-content">
            <form action="" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <label for="agent">عرض حسب</label>
                        <select class="form-control asset select2" name="graph" id="graph">
                            <option selected value="year">السنة</option>
                            <option {{$graph == "month" ? "selected" : ""}} value="month">الشهر</option>
                            <option {{$graph == "day" ? "selected" : ""}} value="day">يوم</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="search">&nbsp;<span style="color: white;">`</span></label><br>
                        <input class="btn btn-primary" id="search" type="submit" value="بحث">
                    </div>
                </div>
            </form>
            <br>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> عدد الإعلانات التي يتم نشرها من قبل الأعضاء</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_1" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> &nbsp;</div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> عدد الإعلانات بالقسم</span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_5" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> &nbsp;</div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> الإعلانات الأكثر مشاهدة </span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_12" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> &nbsp;</div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> عدد الأعضاء فعال / محظور </span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_123" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> عدد الإعلانات فعال / غير فعال </span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_1235" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> &nbsp;</div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-bar-chart font-green-haze"></i>
                                    <span class="caption-subject bold uppercase font-green-haze"> أكثر الأقسام زيارة </span>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="fullscreen"> </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div id="chart_1234" class="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row"> &nbsp;</div>
        </section>
    </div>

    <script>
        $(document).ready(function () {
            var data = {!! json_encode($effecancy) !!};
            var data1 = {!! json_encode($effecancy1) !!};
            var data3 = {!! json_encode($enabled_user) !!};
            var data4 = {!! json_encode($categories_visits) !!};
            var data5 = {!! json_encode($adds_enabled) !!};
            var data6 = {!! json_encode($categories_adds) !!};
            var my_data = [];
            var my_data1 = [];
            var my_data3 = [];
            var my_data4 = [];
            var my_data5 = [];
            var my_data6 = [];
            for (var i = 0; i < data6.length; i++) {
                my_data6[i] = {
                    "year": data6[i].monthyear,
                    "income": data6[i].data,
                    "expenses": data6[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            for (var i = 0; i < data4.length; i++) {
                my_data4[i] = {
                    "year": data4[i].monthyear,
                    "income": data4[i].data,
                    "expenses": data4[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            for (var i = 0; i < data.length; i++) {
                my_data[i] = {
                    "year": data[i].monthyear,
                    "income": data[i].data,
                    "expenses": data[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            for (var i = 0; i < data1.length; i++) {

                my_data1[i] = {
                    "year": data1[i].monthyear,
                    "income": data1[i].data,
                    "expenses": data1[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            for (var i = 0; i < data3.length; i++) {
                var text = "";
                if (data3[i].monthyear == 1) {
                    text = "فعال";
                } else {
                    text = "محظور";
                }
                my_data3[i] = {

                    "year": text,
                    "income": data3[i].data,
                    "expenses": data3[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            for (var i = 0; i < data5.length; i++) {
                var text = "";
                if (data5[i].monthyear == 1) {
                    text = "فعال";
                } else {
                    text = "غير فعال";
                }
                my_data5[i] = {

                    "year": text,
                    "income": data5[i].data,
                    "expenses": data5[i].data,
                    "alpha": 0.8,
                    "dashLengthLine": 5,

                };
            }
            var ChartsAmcharts = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_1", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();
            var ChartsAmcharts1 = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_12", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data1,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();
            var ChartsAmcharts2 = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_123", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data3,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();
            var ChartsAmcharts3 = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_1234", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data4,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();
            var ChartsAmcharts4 = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_1235", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data5,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();
            var ChartsAmcharts5 = function () {
                var initChartSample1 = function () {
                    var chart = AmCharts.makeChart("chart_5", {
                        "type": "serial",
                        "theme": "light",
                        "pathToImages": App.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                        "autoMargins": false,
                        "marginLeft": 30,
                        "marginRight": 8,
                        "marginTop": 10,
                        "marginBottom": 26,

                        "fontFamily": 'Open Sans',
                        "color": '#888',

                        "dataProvider": my_data6,
                        "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                        "startDuration": 1,
                        "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'><b>[[title]] [[category]]: [[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                        "categoryField": "year",
                        "categoryAxis": {
                            "gridPosition": "start",
                            "axisAlpha": 0,
                            "tickLength": 0
                        }
                    });

                    $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                        chart.invalidateSize();
                    });
                }

                return {
                    //main function to initiate the module

                    init: function () {

                        initChartSample1();
                    }

                };

            }();

            jQuery(document).ready(function () {
                ChartsAmcharts.init();
                ChartsAmcharts1.init();
                ChartsAmcharts2.init();
                ChartsAmcharts3.init();
                ChartsAmcharts4.init();
                ChartsAmcharts5.init();
            });
        });
    </script>
@endsection