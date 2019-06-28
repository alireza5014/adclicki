@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست تبلیغات کلیکی </title>
    <style>
        .p_wink {
            color: #ff0e13;
            animation: notification-container 1s linear infinite;
        }

        @keyframes notification-container {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
@endsection
@section('content')

    <div class="col-md-12 ">


        <div class="card">


            <div class="card-block">


                @include('layouts.material.user.message.table')

            </div>
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


    </div>
@stop