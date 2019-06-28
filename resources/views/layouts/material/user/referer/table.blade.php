

<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table class="table table-hover ">

                <thead>
                    <tr>

                        <th>#</th>
                        <th>تصویر</th>

                        <th>نام و نام خانوادگی</th>
                        <th>درآمد زیرمجموعه(تومان)</th>
                        <th> سهم شما (تومان)</th>


                        <th>   کشور </th>
                        <th> زمان عضویت</th>


                    </tr>
                    </thead>

                    <tbody>
                    <?php $total_price = $total_referer_price = 0;?>
                    @foreach($referer as $ad)
                        <tr>
                            <td>{{$ad->id}}</td>

                            <td><img src="{{url($ad->image_path)}}"
                                     class="img-responsive"
                                     width="40px" height="40px"/>
                            </td>

                            <td>
                                {{$ad->fname." ".$ad->lname}}<br/>
                                @if(auth('user')->user()->id==42)
                                {{$ad->email}}
                                    @endif

                            </td>



                                <?php
                                $total_price += $ad->r_visited_price_count;
                                $total_referer_price += $ad->r_visited_referer_price_count;
                                ?>

                                <td>{{convert_to_digit($ad->r_visited_price_count*5)}}</td>
                                <td>{{convert_to_digit($ad->r_visited_referer_price_count)}}</td>


                            <td>{{$ad->country}}</td>
                            <td>{{$ad->created_at}}</td>


                        </tr>


                    @endforeach

                    </tbody>

                </table>

             </div>

        </div>

    </div>

</div>

<div class="card-box m-t-15 m-b-0">

    <p class="pull-right text-success">مجموع سهم شما : {{convert_to_digit($total_referer_price)}} تومان </p>
    <p class="pull-left text-success">مجموع درآمد زیرمجموعه ها : {{convert_to_digit(number_format($total_price*5))}} تومان </p>

    <div class="clearfix"></div>

</div>






