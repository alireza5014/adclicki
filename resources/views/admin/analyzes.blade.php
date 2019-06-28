@extends('layouts.adminto.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('template/adminto/assets/plugins/morris/morris.css')}}">
    <title>analyzes</title>
    @parent
@endsection
@section('content')

    <div class="card-box">
        <div class="row">
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> نمودار درصد سیستم عامل   </h4>

                    <div id="morris-donut-os" style="height: 300px;">  </div>
                    <p  id="total_browser"></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> نمودار درصد مرورگرها   </h4>

                    <div id="morris-donut-browser" style="height: 300px;">   </div>
                    <p id="total_os"></p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30"> نمودار درصد پلتفرم عضویت کاربران  </h4>


                    <div id="morris-donut-device" style="height: 300px;"> </div>
                    <p id="total_device"></p>


                </div>
            </div>


            <div class="col-lg-12">

                <div class="form-group  alert alert-info">
                    <label for="site" class="col-sm-3 control-label"> سایت </label>
                    <div class="col-sm-6">
                        <select id="site" name="site" class="form-control">
                            <option value="all">ALL</option>
                            @foreach($os as $o)
                                <option value="{{$o}}">{{$o}}</option>

                            @endforeach

                        </select>

                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="card-box">
                    <h4 class="header-title m-t-0 m-b-30">  تعداد کل ورودی های  یکتا سیستم عامل
                         <span> <code
                                    id="total_unique_ip_view"></code> </span></h4>

                    <div class="text-center">
                        <ul class="list-inline chart-detail-list">
                            <li>
                                <h5 id="total_unique_ip_view" style="color: #253cff;"><i class="fa fa-circle m-r-5"></i>
                                     all </h5>
                            </li>
                        </ul>
                    </div>
                    <div id="unique_ip_view" style="height: 300px;"></div>
                </div>


                <h4 class="header-title m-t-0 m-b-30"> تعداد کل ورودی های سیستم عامل    <span> <code
                                id="total_reciver"></code> </span></h4>

                <div class="text-center">
                    <ul class="list-inline chart-detail-list">
                        <li>
                            <h5 id="receive_title" style="color: #253cff;"><i class="fa fa-circle m-r-5"></i>
                                    all </h5>
                        </li>
                    </ul>
                </div>
                <div id="receive_user" style="height: 300px;"></div>
            </div>


        </div>
    </div>
    </div>

@stop

@section('footer')
    @parent
    <script>
        $("#site").change(function () {
            var os = $(this).val();
            $('h5#receive_title').empty().append('    ورودی های سیستم عامل ' + os);
            $('div#receive_user').empty();

            $('h5#total_unique_ip_view').empty().append('ورودی های سیستم عامل ' + os);
            $('div#unique_ip_view').empty();
            $.get('analyzes/analyzes_summary/' + os, function (data) {
                !function ($) {
                    "use strict";
                    var Dashboard1 = function () {
                        this.$realData = []
                    };
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
                            $('#total_reciver').html('تعداد کل  : ' + data.total_receive);
                            this.createLineChart('receive_user', $data, 'y', ['a'], ['ورودی های این روز  '], ['0.9'], ['#ffffff'], ['#999999'], ['#253cff']);


                               var $data1 = data.unique_ip_view;
                            $('#total_unique_ip_view').html('تعداد کل  : ' + data.total_unique_ip_view);
                            this.createLineChart('unique_ip_view', $data1, 'y', ['a'], ['ورودی های این روز  '], ['0.9'], ['#ffffff'], ['#999999'], ['#253cff']);
                        },
                        //init
                        $.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
                }(window.jQuery),
//initializing
                    function ($) {
                        "use strict";
                        $.Dashboard1.init();
                    }(window.jQuery);

            });
        });
    </script>
    <script src="{{asset('template/adminto/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/raphael/raphael-min.js')}}"></script>
    <!-- Dashboard init -->
    <script src="{{asset('template/adminto/assets/pages/jquery.analyzes.js')}}"></script>


@endsection

