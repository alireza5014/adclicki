<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-striped">
                    <thead>
                    <tr>

                        <th>#</th>

                        <th>مشخصات کاربر</th>

                        <th>مبلغ (تومان)</th>
                        <th>توضیحات</th>
                        <th>موجودی فعلی</th>
                        <th> مجموع کلیک ها</th>

                        <th> وضعیت پرداخت</th>
                        <th> زمان</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($withdrawals as $withdrawal)
                        <tr>
                            <td>{{$withdrawal->id}}</td>

                            <td>
                                {{$withdrawal->user->fname." ".$withdrawal->user->lname}}
                                <br>
                                {{$withdrawal->user->email}}
                                <br>
                                {{$withdrawal->user->card_number}}
                                <br>
                                {{$withdrawal->user->shaba_number}}
                            </td>
                            <td>
                                {{number_format($withdrawal->price)}}
                            </td>


                            <td>
                                {{$withdrawal->description}}
                            </td>

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
                            <td>{{$click}}</td>


                            <td>@if($withdrawal->is_pay==1) <p class="btn btn-xs btn-success">پرداخت شده</p> @else  <p
                                        class="btn btn-xs btn-danger"> منتظر پرداخت</p>   @endif</td>

                            <td>{{$withdrawal->created_at}}</td>

                            <td>
                                <a onclick="setModal({{$withdrawal->id}},{{$withdrawal->price}},{{$withdrawal->user}});" data-toggle="modal"
                                   data-target="#withdrawal_modal" class="btn btn-xs btn-info">  اقدام پرداخت </a>
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



