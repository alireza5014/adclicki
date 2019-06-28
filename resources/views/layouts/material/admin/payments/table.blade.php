<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <table id="tech-companies-1" class="table  table-hover">
                    <thead>
                    <tr>

                        <th>ID</th>

                        <th>مشخصات کاربر</th>
                        <th>مبلغ</th>
                        <th>نوع تراکنش</th>
                        <th>   توضیحات</th>

                        <th> زمان</th>
                        <th> وضعیت</th>


                    </tr>
                    </thead>

                    <tbody>

                    @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>


                            <td>
                                {{$payment->user->fname." ".$payment->user->lname}}
                            <br>
                                {{$payment->user->email}}
                            </td>

                            <td>
                                  {{$payment->price}}
                            </td>

                            <td>
                                 {{$payment->payment_type}}
                            </td>


                            <td>{{$payment->description}}</td>

                            <td>{{$payment->is_pay}}</td>



                            <td>{{$payment->created_at}}</td>


                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


{{$payments->appends($_GET)->links()}}



