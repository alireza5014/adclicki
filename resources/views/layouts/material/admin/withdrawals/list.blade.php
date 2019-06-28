@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست withdrawals </title>

@endsection
@section('content')

    <div id="withdrawal_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">
                        <p class="text-danger" id="view_request_message"></p>


                        <form id="view_request_form" class="form-horizontal" method="POST"
                              action="{{route('admin.withdrawals.pay')}}"
                        enctype="multipart/form-data"
                        >
                            {{csrf_field()}}
                            <div class="form-group">
                                <p class="  col-sm-12  text-center ">
                                    <b class="text-danger" id="fullname"></b><br/>
                                    <b id="card_number"></b><br/>
                                    <b id="shaba_number"></b><br/>
                                </p>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="c_mobile">مبلغ درخواستی:</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control input-sm" id="withdrawal_id"   name="withdrawal_id">
                                    <input type="hidden" class="form-control input-sm" id="user_id"   name="user_id">

                                    <input type="text" class="form-control input-sm" id="price" name="price"
                                    >
                                    <p id="count_errors" class="text-danger"></p>

                                </div>

                            </div>


                            <div class="form-group">


                                <div class="col-md-12">
                                <textarea class="form-control" placeholder="description" name="description"
                                          id="description" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="col-md-12">
                                    <input type="file" class="form-control" name="main_image" id="main_image" >
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" id="view_request_btn" class="btn   btn-block btn-primary  ">
                                        پرداخت
                                        <i style="display: none" id="loader40" class="fa fa-spinner fa-spin "></i>

                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>

    <div id="view_request_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">
                        <p class="text-danger" id="view_request_message"></p>


                        <form id="view_request_form" class="form-horizontal" action="action_page.php">

                            <div class="form-group">
                                <p class="  col-sm-12  text-center ">
                                    تعداد کلیک های خود را جهت
                                    اختصاص به تبلیغ <br/><b class="text-danger" id="ads_title"></b><br/> وارد کنید</p>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="c_mobile">تعداد:</label>
                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control input-sm" id="ads_id" name="ads_id">
                                    <input type="text" class="form-control input-sm" id="count" name="count"
                                           placeholder="">
                                    <p id="count_errors" class="text-danger"></p>

                                </div>

                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <a id="view_request_btn" class="btn   btn-block btn-primary  ">
                                        تخصیص کلیک
                                        <i style="display: none" id="loader40" class="fa fa-spinner fa-spin "></i>

                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>

    <div class="col-md-12">


        <div class="card">


            <div class="card-block">


                @include('layouts.material.admin.withdrawals.table')

            </div>
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
                            $('.card-block').html(data);
                            $('#loader').hide();

                        }
                    });
                }

            </script>


            <script>

                function setModal(id, price, data) {

                    $('#fullname').text(data.fname + ' ' + data.lname);
                    $('#card_number').text(data.card_number);
                    $('#shaba_number').text(data.shaba_number);
                    $('#user_id').val(data.id);
                    $('#withdrawal_id').val(id);
                    $('#price').val(price);
                    $('#description').val(data.fname + ' ' + data.lname+' مبلغ '+price+' تومان به حساب شما('+data.shaba_number+') واریز شد و بانک  حداقل تا ساعت ۱۶:۳۰ امروز  یا حداکثر پس از یک رو کاری به حساب شما واریز خواهد کرد.\n' +
                        '\n' +

                        'با تشکر از صبر و شکیبایی شما');
                }


            </script>

@stop