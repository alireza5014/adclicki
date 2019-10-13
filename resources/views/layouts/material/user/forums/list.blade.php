@extends('layouts.material.layout')
@section('header')
    @parent

    <title> انجمن آنلاین ادکلیکی </title>

@endsection
@section('content')


    <div class="col-md-12 col-sm-12">


        <div class="card" style="max-height: 100vh">

            <div class="card-block">

                <h2 class="text-center">به درخواست کاربران محترم ادکلیکی بزودی انجمن راه اندازی خواهد شد</h2>
                <p class="text-danger text-center">

                در صورت موافق یا مخالف بودن راه اندازی انجمن نظر خود را از طریق تیکت اعلام بفرمایید

                <span>
                <a href="{{route('user.tickets')}}"
                class="btn btn-sm btn-success">ثبت تیکت جدید</a>
                </span>
                </p>


                <div class="row">
                    <div class="col-4" style="max-height: 60vh">
                        <div class="chat__header">
                            <h2 class="chat__title">
                                <small>کاربران آنلاین ۲۲ نفر</small>
                            </h2>

                            <div class="chat__search">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="جستجو...">
                                    <i class="form-group__bar"></i>
                                </div>
                            </div>
                        </div>

                        <div class="  listview--hover chat__buddies scrollbar-inner overflow-auto "
                        >
                            <div class="listview listview--hover chat__buddies scrollbar-inner scroll-content"
                                 style="height: 50vh; margin-bottom: 0px; margin-right: 0px; max-height: none;">
                                <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a> <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/7.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>حالت چطوره...</p>
                                    </div>
                                </a>

                                <a class="listview__item chat__available">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/5.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>ممنون...</p>
                                    </div>
                                </a>

                                <a class="listview__item chat__away">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/3.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>همه چیز رو به راهه</p>
                                    </div>
                                </a>

                                <a class="listview__item">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/8.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>فوتبال خنده شیر به عنوان دروازه ورودی اصلی در لوقا</p>
                                    </div>
                                </a>

                                <a class="listview__item">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/6.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>محمد رضایی</p>
                                    </div>
                                </a>

                                <a class="listview__item chat__busy">
                                    <img src="http://4example.ir/material/demo/img/profile-pics/9.jpg"
                                         class="listview__img" alt="">

                                    <div class="listview__content">
                                        <div class="listview__heading">حسین اکبریان</div>
                                        <p>فردا، بسیاری از گوجه فرنگی هویج فلفل قرمز مخمر.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="scroll-element scroll-x">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar" style="width: 100px;"></div>
                                </div>
                            </div>
                            <div class="scroll-element scroll-y">
                                <div class="scroll-element_outer">
                                    <div class="scroll-element_size"></div>
                                    <div class="scroll-element_track"></div>
                                    <div class="scroll-bar" style="height: 100px;"></div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-8 col-xl-8 pl-md-3 px-lg-auto px-0">

                        <div class="card" style="margin-bottom: 5px !important;">
                            <div class="card-body">

                                <div class="chat-message">

                                    <ul id="chat_list" style="min-height: 70vh"
                                        class="list-unstyled chat-1 scrollbar-light-blue">
                                        <li>
                                            <a class="listview__item ">
                                                <img src="http://4example.ir/material/demo/img/profile-pics/9.jpg"
                                                     class="listview__img" alt="">

                                                <div class="listview__content">
                                                    <div class="listview__heading">حسین اکبریان</div>
                                                    <p>فردا، بسیاری از گوجه فرنگی هویج فلفل قرمز مخمر فلفل قرمز مخمر فلفل قرمز مخمر فلفل قرمز مخمر فلفل قرمز مخمر فلفل قرمز مخمر.</p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a class="listview__item ">
                                                <img src="http://4example.ir/material/demo/img/profile-pics/9.jpg"
                                                     class="listview__img" alt="">

                                                <div class="listview__content">
                                                    <div class="listview__heading">حسین اکبریان</div>
                                                    <p>فردا، بسیاری از گوجه فرنگی هویج فلفل قرمز مخمر.</p>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="white">


                                        <div class="input-group">
                                            <input id="inputMessage" class="form-control pl-2 my-0"
                                                   placeholder="چیزی بنویسید "/>

                                            <div class="input-group-prepend">

                                                <button id="btn_send_message" type="button"
                                                        class="btn btn-success btn-rounded btn-md waves-effect waves-dark float-right">
                                                    ارسال
                                                </button>
                                                {{--<div class="input-group-text" id="btnGroupAddon">@</div>--}}
                                            </div>

                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>






@stop