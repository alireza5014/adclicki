<div class="table-rep-plugin">
    <div class="table-wrapper">


        <div id="table_data">
            <div class="table-responsive" data-pattern="priority-columns">

                <div class="card-block">
                    <table class="table table-hover mb-0">
                    <thead>
                    <tr>

                        <th>ID</th>
                        <th>توضیحات</th>

                        <th>نوع تراکنش</th>
                        <th>تعداد کلیک</th>
                        <th> مبلغ </th>

                        <th> زمان</th>



                    </tr>
                    </thead>

                    <tbody class="table-hover">

                    @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>



                            <td>
                                <p>  {{$payment->description}}  </p>
                            </td>

                            <td>
                                <p>  {{$payment->payment_type}}  </p>
                            </td>



                            <td>{{$payment->click_count}}</td>
                            <td>{{$payment->price}}</td>

                            <td>{{$payment->created_at}}</td>


                        </tr>


                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>


{{$payments->appends($_GET)->links()}}



