@extends('layouts.adminto.layout')

@section('header')

    <title>داشبورد</title>
    @parent
@endsection


@section('content')

    <div class="card-box">
        <div class='m-r-15 m-l-15 card-box'><p class="text-danger"> نحوه جذب زیر مجموعه:<p> <p> لینک زیر را به دوستانتان ارسال کنید. بعد از ثبت نام از طریق این لینک زیر مجموعه شما خواهند شد   و ۲۰   در صد از درآمد آنها به شما تعلق خواهد گرفت. </p>
            <code   dir='ltr'  class='form-control text-danger' style='min-width: 20%'> {{url('user/register').'?referer_id='.auth('user')->user()->id}}</code>
        </div>
        <div class="row">

            @foreach($data as $key=>$value)
                <div class="col-lg-3 col-md-4">
                    <div class="card-box bg-warning  ">


                        <h4 class="header-title m-t-0 m-b-20">      {{$key}}</h4>

                        <div class="widget-chart-1">


                            <div class="widget-detail">

                                <h2 class="p-t-0 m-b-0"> {{convert_to_digit($value)}}</h2>

                            </div>


                        </div>
                    </div>
                </div><!-- end col -->

            @endforeach


        </div>

    </div>



@stop

@section('footer')
    @parent




@endsection

