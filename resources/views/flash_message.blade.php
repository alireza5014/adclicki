<style>

    .my_alert-success {
        background-color: rgba(95, 190, 170, 0.92);
        border-color: rgba(0, 64, 64, 0.4);
        color: #5fbeaa;
    }

    .my_alert-danger {
        background-color: rgba(180, 20, 15, 0.8);
        border-color: rgba(180, 20, 15, 0.8);
        color: #ffffff;
    }

    .my_alert-warning {
        background-color: rgba(242, 177, 40, 0.8);
        border-color: rgba(242, 177, 40, 0.8);
        color: #ffffff;
    }

    .my_alert-info {
        background-color: rgba(51, 47, 180, 0.8);
        border-color: rgba(51, 47, 180, 0.8);
        color: #ffffff;
    }

    .my_alert {

        position: fixed;
        min-width: 300px;
        right: -300px;
        bottom: 10px;
        z-index: 1000;
        padding: 20px;
        color: white;
        opacity: 1;
        border-radius: 0px;
        transition: opacity 0.6s;
        margin-bottom: 15px;

    }
</style>


@if ($message = session()->get('success'))

    <div class="  my_alert my_alert-success">
        <button type="button" class="close" data-dismiss="my_alert">×</button>
        <strong>{{ $message }}</strong>
    </div>

@endif


@if ($message = session()->get('error'))
    <div class="my_alert my_alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = session()->get('warning'))
    <div class="my_alert my_alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($message = session()->get('info'))
    <div class="my_alert my_alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
@endif


@if ($errors->any())
    <div class="my_alert my_alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

    </div>
@endif


<script>


    var right = 600;  // Get the calculated left position

    $(".my_alert").css({right: -right})  // Set the left to its calculated position
        .animate({"right": "0px"}, "slow", function () {
            $(".my_alert").fadeTo(4000, 1000).animate({"right": -right}, "slow");

        });
</script>