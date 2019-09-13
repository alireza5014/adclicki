@extends('layouts.material.layout')



@section('content')
    <div class="card">


        <a href="{{route('user.subcategory.list')}}" class="btn btn-success btn-xs">
            لیست زیر مجموعه های من </a>
    </div>
    <div class="card">
        <div class="container">

            <div class="row group">

                <div class="col-sm-6">


                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.subcategory.create') }}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group mt-4">
                            <div class="col-md-12">
                                <p>قیمت اجاره زیر مجموعه : <span class="color-green" id="hire_price">{{getHirePrice()}}</span> تومان</p>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="form-group form-group--float">
                                <select id="hire_time" type="text"
                                        class="form-control" name="hire_time">
                                    <option value="1"> یک ماهه</option>
                                    <option value="2"> دو ماهه</option>
                                    <option value="3"> سه ماهه</option>
                                    <option value="4"> چهار ماهه</option>
                                    <option value="5"> پنج ماهه</option>
                                    <option value="6"> شش ماهه</option>
                                    <option value="7"> هفت ماهه</option>
                                    <option value="8"> هشت ماهه</option>
                                    <option value="9"> نه ماهه</option>
                                    <option value="10"> ده ماهه</option>
                                    <option value="11"> یازده ماهه</option>
                                    <option value="12"> دوازده ماهه</option>


                                </select>
                                <label>مدت اجاره </label>
                                <i class="form-group__bar"></i>

                            </div>


                        </div>


                        <div class="col-sm-12">
                            <div class="form-group form-group--float">
                                <select id="hire_count" type="text"
                                        class="form-control" name="hire_count">
                                    <option value="1"> یک عدد </option>
                                    <option value="2"> دو عدد</option>
                                    <option value="3"> سه عدد</option>
                                    <option value="4"> چهار عدد</option>
                                    <option value="5"> پنج عدد</option>
                                    <option value="6"> شش عدد</option>
                                    <option value="7"> هفت عدد</option>
                                    <option value="8"> هشت عدد</option>
                                    <option value="9"> نه عدد</option>
                                    <option value="10"> ده عدد </option>
                                    <option value="11"> یازده عدد </option>
                                    <option value="12"> دوازده عدد</option>
                                    <option value="13"> سیزده عدد</option>
                                    <option value="14"> چهارده عدد</option>
                                    <option value="15"> پانزده عدد</option>
                                    <option value="16"> شانزده عدد</option>
                                    <option value="17"> هفده عدد</option>
                                    <option value="18"> هجده عدد</option>
                                    <option value="19"> نوزده عدد</option>
                                    <option value="20"> بیست عدد</option>


                                </select>
                                <label>تعداد  زیر مجموعه درخواستی </label>
                                <i class="form-group__bar"></i>

                            </div>


                        </div>


                        <div class="col-sm-12">
                            <div class="form-group form-group--float">
                                <select id="buy_type" type="text"   class="form-control" name="buy_type">
                                    <option value="1">   خرید از درگاه بانکی </option>
                                    {{--<option value="2">   خرید از موجودی کل</option>--}}

                                </select>
                                <label>نوع خرید </label>
                                <i class="form-group__bar"></i>

                            </div>


                        </div>


                        <div class="form-group">
                            <div class="col-md-12">
                            <p>مبلغ قابل پرداخت : <span id="price" class="color-green">{{getHirePrice()}}</span> تومان</p>
                            </div>

                        </div>




                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary  btn-block">
                                    <i class="fa fa-btn  "></i> خرید
                                </button>
                            </div>

                        </div>
                    </form>
<script>

    var price=0;
    var hire_price=$('#hire_price').text();
    $( "#hire_count" ).change(function() {
        price=$(this).val()*$('#hire_time').val()*hire_price;

        $('#price').text(price);


    });

    $( "#hire_time" ).change(function() {
        price=$(this).val()*$('#hire_count').val()*hire_price;
        $('#price').text(price);


    });


 </script>
                </div>
                <div class="col-sm-6">


                    <ul class="list-group">

                        <p class="alert alert-info m-b-5">
                           با خرید هر زیر مجموهه  ۲۰ در صد از درآمد آن متعلق به شما خواهد شد
                            <br/>

                        </p>
                        {{--<p class="alert alert-danger m-b-20">--}}
                            {{--شما در هر ۲۴ ساعت یکبار می توانید درخواست واریز وجه کنید.--}}
                        {{--</p>--}}

                        {{--<p class="alert alert-success m-b-20">--}}
                            {{--مبلغ درخواست شده کمتر از ۲۴ ساعت به حساب شما واریز خواهد شد.--}}
                        {{--</p>--}}
                    </ul>

                </div>


            </div>
        </div>
    </div>
@stop
