<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-hover">
                    <thead>
                    <tr>

                        <th>#</th>

                        <th>مشخصات کاربر</th>

                        <th>مبلغ (تومان)</th>
                        {{--<th>توضیحات</th>--}}
                        <th>موجودی فعلی</th>
                        <th>  آخرین فعالیت</th>
                        <th> مجموع کلیک ها</th>
                        <th> تعداد زیرمجموعه ها</th>
                        <th> تعداد برداشت ها</th>
                        <th> وضعیت تایید</th>

                        <th> وضعیت پرداخت</th>
                         <th> زمان</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{$withdrawal->id}}</td>

                            <td>
                                {{$withdrawal->user->id}}
                                <br>

                                {{$withdrawal->user->fname." ".$withdrawal->user->lname}}
                                <br>
                                {{$withdrawal->user->created_at}}
                                <br>
                                {{$withdrawal->user->mobile}}
                                <br> {{$withdrawal->user->email}}
                                <br>
                                {{$withdrawal->user->card_number}}
                                 <br>

                                <p id="shaba_number_{{$withdrawal->id}}" onclick="copyToClipboard('shaba_number_{{$withdrawal->id}}','element','')" dir="ltr">{{str_replace(" ","",str_replace("IR","",$withdrawal->user->shaba_number))}}</p>
                            </td>
                            <td>
                                {{number_format($withdrawal->price)}}
                            </td>


                            {{--<td>--}}
                                {{--{{$withdrawal->description}}--}}
                            {{--</td>--}}

                            <td>
                                <?php $price1 = $price2 = $click=0; ?>

                                @if(sizeof($withdrawal->user->payments))
                                    <?php $price1 = $withdrawal->user->payments[0]->price; ?>
                                @endif
                                @if(sizeof($withdrawal->user->visited_links)>0)
                                    <?php
                                    $price2 = $withdrawal->user->visited_links[0]->price;
                                    $click = $withdrawal->user->visited_links[0]->click;
                                    ?>
                                @endif
                                {{number_format($price1+$price2)}}
                            </td>
                            <td>{{ $withdrawal->user->visited_link->my_created_at}}</td>
                            <td>{{$click}}</td>
                            <td>{{$withdrawal->referrers_count}}</td>
                            <td>  {{$withdrawal->user->withdrawals_count}}   </td>


                            <td>@if($withdrawal->is_verify==1)
                                    <p class="btn btn-xs btn-success">تایید شده</p>
                                @else  <p
                                            class="btn btn-xs btn-danger"> تایید نشده </p>
                                @endif</td>

                            <td>@if($withdrawal->is_pay==1)
                                    <img src="{{url($withdrawal->image_path)}}" width="90px">
                                    <p class="btn btn-xs btn-success">پرداخت شده</p>
                                @else  <p
                                            class="btn btn-xs btn-danger"> منتظر پرداخت</p>
                                @endif</td>


                            <td>{{$withdrawal->created_at}}</td>



                            <td>

                                <a onclick="setModal({{$withdrawal->id}},{{$withdrawal->price}},{{$withdrawal->user}});" data-toggle="modal"
                                   data-target="#withdrawal_modal" class="btn btn-xs btn-success text-white">  اقدام پرداخت </a>

                                <a onclick="send_message('{{$withdrawal->user->id}}','{{$withdrawal->user->fname." ".$withdrawal->user->lname}}')"
                                   data-toggle="modal" data-target="#send_message"
                                   class="btn btn-xs btn-primary">ارسال پیام</a>

                            <a href="{{url('admin/tickets/all').'?search='.$withdrawal->user->lname}}"   class="btn btn-warning" target="_blank">مشاهد تیکت های کاربر</a>
                            <a href="{{url('admin/users/salary').'?user_id='.$withdrawal->user->id}}"   class="btn btn-info" target="_blank">ریز درآمد  کاربر</a>
                            </td>
                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$withdrawals->appends($_GET)->links()}}



