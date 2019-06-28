@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست withdrawals </title>

@endsection
@section('content')


        <div class="col-sm-12">


            <div class="card">


                @include('layouts.material.user.withdrawals.table')

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




            <script>

                function setModal(id, title) {

                    $('#ads_title').text(title);
                    $('#ads_id').val(id);
                }


            </script>

@stop