@extends('layouts.material.layout')
@section('header')
    @parent

    <title> لیست سایت های من </title>

@endsection
@section('content')

    <div id="code_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">

                        <div class="form-group">
                            <p class="  col-sm-12  text-center "> برای نمایش تبلیغ کد زیر را در سایت خود قرار دهید </p>
                            <textarea dir="ltr" class="form-control" rows="8"> <div id="adclicki">  <script type="text/javascript">  document.write('<script type="text/javascript" src="{{url('site/get_banner')}}" async></scri' + 'pt>'); </script>    </div></textarea>
                        </div>

                    </div>


                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


    </div>


    <div id="delete_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-no-padding">


                <div class="modal-body">

                    <div class="container">
                        <p class="text-danger" id="view_request_message"></p>


                        <form id="delete_form" class="form-horizontal" action="">

                            <div class="form-group">
                                <p class="  col-sm-12  text-center "> برای حدف اطمینان دارید ؟ </p>

                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-5">
                                        <a href="" id="delete_btn" class="btn  btn-block btn-danger  ">
                                            بله

                                        </a>
                                    </div>

                                    <div class="col-md-offset-1 col-md-5">
                                        <button data-dismiss="modal" aria-label="Close" id="cancel_btn"
                                                class="btn btn-block btn-primary  ">
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


        <a href="{{route('user.website.new')}}" class="btn btn-success btn-xs">
            افزودن سایت جدید</a>
    </div>
    <div class="col-sm-12">


        <div class="card">


            @include('layouts.material.user.website.table')

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

                $('#delete_btn').attr("href", '{{url('user/website/delete')}}/' + id);
                $('#website_id').val(id);
            }

            function setCodeModal(website_id) {

            }


        </script>

@stop