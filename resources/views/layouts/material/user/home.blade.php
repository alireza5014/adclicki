@extends('layouts.material.layout')

@section('header')

    <title>داشبورد</title>
    @parent
@endsection
@section('content')

    <header class="user__info card">
        <h1>داشبورد</h1>


        <div class="actions">
            <a href="" class="actions__item zmdi zmdi-trending-up"></a>
            <a href="" class="actions__item zmdi zmdi-check-all"></a>

            <div class="dropdown actions__item">
                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                <div class="dropdown-menu dropdown-menu-left">
                    <a href="" class="dropdown-item"> تازه سازی</a>
                    <a href="" class="dropdown-item"> مدیریت ویجت ها</a>
                    <a href="" class="dropdown-item"> تنظیمات</a>
                </div>
            </div>
        </div>
    </header>

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

