@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست سایت های من </title>

@endsection
@section('content')

    <div id="send_message" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
                          action="{{ route('admin.send_message_to_user') }}">
                        {{ csrf_field() }}

                        <p id="name"></p>
                        <input type="hidden" id="user_id" name="user_id"/>

                        <div class="form-group">

                            <div class="col-md-12">
                                <input class="form-control" placeholder="title" name="title" id="title" required>
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
                                <input type="file" class="form-control" name="main_image" id="main_image">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-6 control-label"> ارسال به تلگرام : </label>

                            <div class="col-md-6">
                                <input
                                        name="telegram"
                                        id="telegram"
                                        data-size="small"
                                        type="checkbox"
                                        data-plugin="switchery"
                                        data-color="#00b19d"/>
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-md btn-primary btn-block" >SEND</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.modal-content -->

            </div>
        </div>
    </div><!-- /.modal-dialog -->


    <div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">
                        <p class="text-danger" id="view_request_message"></p>


                        <form id="delete_form" class="form-horizontal" action="">

                            <div class="form-group">
                                <p class="  col-sm-12  text-center ">  برای حدف اطمینان دارید ؟  </p>

                            </div>



                            <div class="form-group">
                          <div class="row">
                              <div class="col-md-offset-1 col-md-5">
                                  <a href=""  id="delete_btn" class="btn  btn-block btn-danger  ">
                                      بله

                                  </a>
                              </div>

                              <div class="col-md-offset-1 col-md-5">
                                  <button data-dismiss="modal" aria-label="Close"  id="cancel_btn" class="btn btn-block btn-primary  ">
                                      خیر

                                  </button>
                              </div>
                          </div>
                            </div>
                        </form>

                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>


    <div class="card">


        <a href="{{route('admin.website.new')}}" class="btn btn-success btn-xs">
              افزودن سایت جدید</a>
    </div>
        <div class="col-sm-12">


            <div class="card">


                @include('layouts.material.admin.website.table')

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

                function setDeleteModal(id) {

                    $('#delete_btn').attr("href",'{{url('user/website/delete')}}/'+id);
                    $('#website_id').val(id);
                }


            </script>

@stop