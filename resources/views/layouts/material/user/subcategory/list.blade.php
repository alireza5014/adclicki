@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست زیر مجموعه اجاره ای من </title>

@endsection
@section('content')


    <div class="card">


        <a href="#" class="btn btn-success btn-xs">
            خرید زیر مجموعه اجاره ای</a>
    </div>
    <div class="col-sm-12">


        <div class="card">
            <h3> بزودی خرید زیر مجموعه اجاره ایی به سایت ادکلیکی اضافه خواهد شد</h3>

            {{--            @include('layouts.material.user.subcategory.table')--}}

        </div>


        <script>
            $(document).ready(function () {

                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();
                    $('#loader').show();
                    var page = $(this).attr('href');
                    fetch_data(page);
                });


            });

            function fetch_data(page) {
                $.ajax({
                    url: page,
                    success: function (data) {
                        $('.card-box').html(data);
                        $('#loader').hide();

                    }
                });
            }

        </script>





@stop