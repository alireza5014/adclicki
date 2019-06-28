@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست payment </title>

@endsection
@section('content')

    <div class="col-md-12 col-xs-12">


        <div class="card">


            <div class="card-block">


                @include('layouts.material.user.payments.table')

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

                function active(id) {

                    event.preventDefault();
                    $('#loader' + id).show();

                    $.ajax({
                        url: 'active/' + id,
                        success: function (data) {
                            if (data.status) {
                                $('#loader' + id).hide();

                                var status;
                                (data.publish === 1) ? status = ['text-success', 'text-danger'] : status = ['text-danger', 'text-success'];
                                $('#active_' + id).children("i").addClass(status[0]).removeClass(status[1]);

                            }


                        }
                    });

                }


            </script>


            <script>
                $('#view_request_btn').on('click', function () {


                    $('#loader40').show();
                    $('#count_errors').text('');


                    $.ajax({
                        url: "{{route('user.view_request.save')}}",
                        type: "POST",
                        data: {
                            "_token": '<?php echo csrf_token()?>',

                            "count": $('#count').val(),
                            "ads_id": $('#ads_id').val(),


                        },
                        success: function (data) {
                            $('#loader40').hide();
                            if (data.status) {
                                $('#view_request_form').slideUp();
                                $('#view_request_alert').show();

                                $('#view_request_message').text(data.message)
                            }
                        },
                        error: function (error) {
                            console.log(error);

                            if (error.status === 422) {
                                var errors = $.parseJSON(error.responseText);


                                $.each(errors.errors, function (key, val) {
                                    $("#" + key + "_errors").text(val[0]);
                                });
                            }
                            $('#loader40').hide();

                        }
                    });

                });

                function setModal(id, title) {

                    $('#ads_title').text(title);
                    $('#ads_id').val(id);
                }


            </script>

@stop