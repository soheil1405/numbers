@extends('user.dashboard.master')


<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>



<style>
    .overlay {
        height: 0%;
        width: 100%;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgb(65, 64, 64);
        background-color: rgba(133, 151, 231, 0.9);
        overflow-y: hidden;
        transition: 0.5s;
    }

    .overlay-content {
        position: relative;
        top: 8%;
        width: 100%;
        /* text-align: center; */
        margin-top: 0px;
    }

    .overlay a {
        padding: 0px;
        text-decoration: none;
        font-size: 18px;
        color: #000000;
        display: block;
        transition: 0.3s;
    }

    .overlay a:hover,
    .overlay a:focus {
        color: #f1f1f1;
    }

    .overlay .closebtn {
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 45px;
    }

    @media screen and (max-height: 450px) {
        .overlay {
            overflow-y: auto;
        }

        .overlay a {
            font-size: 20px
        }

        .overlay .closebtn {
            font-size: 25px;
            top: 10px;
            right: 25px;
        }
    }
</style>
@section('title')
    داشبورد
@endsection

@section('content')
    <h4 class="text-center p-4">موتور  آنالیزگر اول</h4>
    <h6> تاریخ تولد شما</h6>
    <hr>



    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content container">
            <form id="searchByComponyForm" action="{{ route('user.compony.searchByCompony') }}" method="post">
                @csrf

                
                @if (is_null(Auth::user()->componyName))
                    <h4 class="text-center ">
                        <a href="{{ route('user.compony.edit') }}" class="text-danger">
                            ابتدا شرکت خود را ثبت کنید
                        </a>
                    </h4>
                @else
                    <span class="text-danger" style="display:none;" id="errText"> ابتدا تمامی تاریخ ها را وارد کنید
                    </span>
                    <div class="row" id="inputBox">

                        <div class="col-md-2 col-6">
                            <a href="#">تاریخ1</a>

                            <div class="d-flex">

                                <input required value="{{ old('date') }}" name="date[1]" data-jdp
                                    class="form-control inputForTopCount">

                                <select name="sex[1]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-2 col-6">
                            <a href="#">تاریخ 2</a>
                            <div class="d-flex">

                                <input required value="{{ old('date') }}" name="date[2]" data-jdp
                                    class="form-control inputForTopCount">

                                <select name="sex[2]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-2 col-6">
                            <a href="#">تاریخ 3</a>
                            <div class="d-flex">

                                <input required value="{{ old('date') }}" name="date[3]" data-jdp
                                    class="form-control inputForTopCount">

                                <select name="sex[3]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>

                            <hr>
                        </div>
                        <div class="col-md-2 col-6">
                            <a href="#">تاریخ 4</a>
                            <div class="d-flex">


                                <input required value="{{ old('date') }}" name="date[4]" data-jdp
                                    class="form-control inputForTopCount">

                                <select name="sex[4]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>
                            <hr>

                        </div>


                    </div>
                    <span onclick="newInput()" class="btn btn-success"> افزودن </span>
                @endif


                <span onclick="confirmForm()" class="btn btn-success">
                    شروع جستجو
                </span>
            </form>
        </div>
    </div>
    <form action="{{ route('user.search.submit') }}" method="post">
        @csrf
        <div class="d-flex">
            <input required value="{{ old('date') }}" name="date" data-jdp class="form-control">
            <select class="form-control"  name="sex" id="">
                <option value="a">آقا</option>
                <option value="kh">خانم</option>
            </select>
        </div>

        <hr>

        <div class="Click-here">
            تایید
        </div>


        @php
            $type = 'submit';
            $text = 'آیا از صحت تاریخ تولد خود اطمینان دارید؟';
        @endphp

        <x-submit :type='$type' :text='$text' />

        {{-- <input class="btn btn-success m-5" type="submit" value=""> --}}
    </form>
    <hr>


    <!-- Use any element to open/show the overlay navigation menu -->
    <a href="#" onclick="openNav()">جستجو توسط ارگانها</a>


    <script>
        var date = jalaliDatepicker.startWatch();

        /* Open */
        function openNav() {
            document.getElementById("myNav").style.height = "100%";
        }

        /* Close */
        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }



        function newInput() {



            var inputForTopCount = $('.inputForTopCount');

            var emptyCount = 0;

            for (let index = 0; index < inputForTopCount.length; index++) {
                var string = inputForTopCount[index].value;
                // let regex = '/^.*$/i';

                // if( regex.test(element.value)){
                //     console.log('asdadads');
                // }else{
                //     console.log('no');
                // }



                if (!string || string.length === 0) {

                    emptyCount++;

                }
            }
            $('#errText').css('display', 'none');

            if (emptyCount > 0) {

                $('#errText').css('display', 'block');

            } else {



                var newCount = inputForTopCount.length + 1;

                console.log(emptyCount);


                const inputBox = document.getElementById('inputBox');


                var new_div = document.createElement('div');
                new_div.className = "col-md-2 col-6";


                var insideDiv = document.createElement('div');

                insideDiv.className = "d-flex";


                var new_a = document.createElement('a');
                new_a.innerHTML = "تاریخ" + newCount;


                new_div.appendChild(new_a);
                var new_input = document.createElement('input');
                new_input.name = "date[" + newCount + "]";
                new_input.type = "text";
                new_input.className = "form-control inputForTopCount";

                new_input.setAttribute("required", "required");
                new_input.setAttribute("data-jdp", "data-jdp");

                insideDiv.appendChild(new_input);




                var selectList = document.createElement('select');
                selectList.name = 'sex[' + newCount + "]";


                var option = document.createElement("option");
                option.value = "a";
                option.text = "آقا";
                selectList.appendChild(option);


                var option = document.createElement("option");
                option.value = "kh";
                option.text = "خانم";
                selectList.appendChild(option);


                insideDiv.appendChild(selectList);








                new_div.appendChild(insideDiv);


                var new_hr = document.createElement('hr');

                new_div.appendChild(new_hr);

                inputBox.appendChild(new_div);


            }

        }



        function confirmForm() {




            var inputForTopCount = $('.inputForTopCount');

            var emptyCount = 0;

            for (let index = 0; index < inputForTopCount.length; index++) {
                var string = inputForTopCount[index].value;
                // let regex = '/^.*$/i';

                // if( regex.test(element.value)){
                //     console.log('asdadads');
                // }else{
                //     console.log('no');
                // }



                if (!string || string.length === 0) {

                    emptyCount++;

                }
            }
            $('#errText').css('display', 'none');

            if (emptyCount > 0) {

                $('#errText').css('display', 'block');
            } else {

                var r = confirm("آیا از اطلاعات وارد شده اطمینان دارید؟");

                if (r == true) {

                    $('#searchByComponyForm').submit();
                }
            }
        }
    </script>
@endsection
