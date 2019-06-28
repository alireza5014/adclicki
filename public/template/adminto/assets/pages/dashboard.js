$.ajax({

    type: "GET",
    url: "home/visit_chart",
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

                    var $data = data.visit;
                    $('#total_visit').html('تعداد کل : ' + data.total_visit);
                    this.createLineChart('visit', $data, 'y', ['a'], ['بازدید های این روز'], ['0.9'], ['#ffffff'], ['#999999'], ['#43b7e4']);

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
        alert("fail");

    }
});

