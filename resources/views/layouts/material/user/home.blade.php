@extends('layouts.material.layout')

@section('header')

    <title>داشبورد</title>
    @parent
@endsection
@section('content')


    <div class='m-r-15 m-l-15 card-box alert alert-danger'>
        <p class="text-white"> با سلام. کاربر پرداخت کننده سایت ادکلیکی تغییر یافت .از این پس پرداخت ها به موقع انجام خواهد شد. </p>
    </div>
<div class="user__info card">
    <div class="row group  ">

        @foreach($data as $key=>$value)

            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="quick-stats__item bg-info">
                    <div class="quick-stats__info">
                        <h3>{{convert_to_digit($value)}}</h3>
                        <h5 class="text-white"> {{$key}}</h5>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">3,5</div>
                </div>
            </div>


        @endforeach


    </div>

</div>


@stop

@section('footer')
    @parent



@endsection

