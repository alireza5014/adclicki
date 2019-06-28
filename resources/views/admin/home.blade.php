@extends('layouts.adminto.layout')

@section('header')
    <link rel="stylesheet" href="{{asset('template/adminto/assets/plugins/morris/morris.css')}}">
    <title>داشبورد</title>
    @parent
@endsection
@section('content')



    <div class="card-box  m-t-5">
        <div class="row">
            @foreach($data as $key=>$value)
                <div class="col-lg-3 col-md-3 col-xs-6">
                    <div class="card-box">


                        <h4 class="header-title m-t-0 m-b-30">   {{$key}}</h4>

                        <div class="widget-chart-1">


                            <div class="widget-detail">

                                <h2 class="p-t-0 m-b-0">  {{convert_to_digit($value)}}</h2>
                                {{--<p class="text-muted"> نفر</p>--}}
                            </div>

                            <div class="progress progress-bar-success-alt progress-sm m-b-0">

                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

            @endforeach

        </div><!-- end col -->


    </div>


    <div class="card-box">
        <h4 class="header-title m-t-0 m-b-30">    نموار یازدید آگهی
            <span> <code   id="total_visit"></code> </span></h4>

        <div class="text-center">
            <ul class="list-inline chart-detail-list">

            </ul>
        </div>
        <div id="visit" style="height: 300px;"></div>
    </div>



@stop

@section('footer')
    @parent
    <script src="{{asset('template/adminto/assets/plugins/morris/morris.min.js')}}"></script>
    <script src="{{asset('template/adminto/assets/plugins/raphael/raphael-min.js')}}"></script>
    <!-- Dashboard init -->
    <script src="{{asset('template/adminto/assets/pages/dashboard.js')}}"></script>

@endsection

