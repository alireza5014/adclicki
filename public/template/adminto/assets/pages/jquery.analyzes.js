$.ajax({

    type: "GET",
    url: "analyzes/analyzes_summary/all",
    // data: '{"id":"12"}',
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    success: function (data) {

        //  alert(data.count_happy_memories);

        !function ($) {
            "use strict";
            var Dashboard1 = function () {
                this.$realData = []
            };
            Dashboard1.prototype.createDonutChart = function (element, data, colors) {
                Morris.Donut({
                    element: element,
                    data: data,
                    resize: true, //defaulted to true
                    colors: colors
                });
            },
                Dashboard1.prototype.createLineChart = function (element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
                    Morris.Line({
                        element: element,
                        data: data,
                        xkey: xkey,
                        ykeys: ykeys,
                        labels: labels,
                        fillOpacity: opacity,
                        pointFillColors: Pfillcolor,
                        pointStrokeColors: Pstockcolor,
                        behaveLikeLine: true,
                        gridLineColor: '#eef0f2',
                        hideHover: 'auto',
                        resize: true, //defaulted to true
                        pointSize: 0,
                        lineColors: lineColors
                    });
                },

                Dashboard1.prototype.init = function () {

                    var $data = data.receive_user;
                    $('#total_reciver').html('تعداد کل : ' + data.total_receive);
                    this.createLineChart('receive_user', $data, 'y', ['a'], ['ورودی های این روز'], ['0.9'], ['#ffffff'], ['#999999'], ['#43b7e4']);


                    var $data = data.unique_ip_view;
                    $('#total_reciver').html('تعداد کل : ' + data.total_unique_ip_view);
                    this.createLineChart('unique_ip_view', $data, 'y', ['a'], ['ورودی های این روز'], ['0.9'], ['#ffffff'], ['#999999'], ['#43b7e4']);





                    var $morris_donut_os = data.os;

                    var $morris_donut_browser = data.browser;
                    var $morris_donut_device = data.device;
                    //
                    $('#total_os').html('تعداد کل : ' + data.total);
                    $('#total_browser').html('تعداد کل : ' + data.total);
                    $('#total_device').html('تعداد کل : ' + data.total_user);



                    this.createDonutChart('morris-donut-os', $morris_donut_os, ['#BC3F44', '#7F88FF', "#1dbc71"]);
                    this.createDonutChart('morris-donut-browser', $morris_donut_browser, ['#bc4883', '#96b5ff', "#bc1582"]);
                    this.createDonutChart('morris-donut-device', $morris_donut_device, ['#bc4883', '#bc1582', "#96b5ff"]);

                    },
                //init
                $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
        }(window.jQuery),

//initializing
            function ($) {
                "use strict";
                $.Dashboard1.init();
            }(window.jQuery);
    },
    error: function (data) {
        //  alert("fail");

    }
});

