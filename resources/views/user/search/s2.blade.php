@extends('user.dashboard.master')




@section('headers')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <h4 class="text-center p-4">موتور  آنالیزگر دوم</h4>



    <div id="myNav" class="overlay">
        <!-- Button to close the overlay navigation -->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <!-- Overlay content -->
        <div class="overlay-content container">
            <form id="searchByComponyForm" action="{{ route('user.compony.searchByCompony2') }}" method="post">
                @csrf


                @if (is_null(Auth::user()->componyName))
                    <h4 class="text-center ">
                        <a href="{{ route('user.compony.edit') }}" class="text-danger">
                            ابتدا شرکت خود را ثبت کنید
                        </a>
                    </h4>
                @else
                    <span class="text-danger" style="display:none;" id="errText"> ابتدا تمامی اطلاعات زیر را وارد کنید
                    </span>
                    <div class="row" id="inputBox">

                        <div class="col-md-3 col-6">
                            <a href="#">شخص1</a>

                            <div class="d-flex">

                                <input required name="name[1]" class="form-control inputForTopCount">

                                <input required name="family[1]" class="form-control inputForTopCount">


                                <select name="sex[1]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-3 col-6">
                            <a href="#">شخص 2</a>
                            <div class="d-flex">

                                <input required name="name[2]" class="form-control inputForTopCount">

                                <input required name="family[2]" class="form-control inputForTopCount">

                                <select name="sex[2]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>
                            <hr>
                        </div>

                        <div class="col-md-3 col-6">
                            <a href="#">شخص 3</a>
                            <div class="d-flex">

                                <input required name="name[3]" class="form-control inputForTopCount">

                                <input required name="family[3]" class="form-control inputForTopCount">


                                <select name="sex[3]" id="">
                                    <option value="a">آقا</option>

                                    <option value="kh">خانم</option>
                                </select>
                            </div>

                            <hr>
                        </div>
                        <div class="col-md-3 col-6">
                            <a href="#">شخص4</a>
                            <div class="d-flex">


                                <input required name="name[4]" class="form-control inputForTopCount">

                                <input required name="family[4]" class="form-control inputForTopCount">

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


        <div class="row">


            <div class="col-md-6">

                <div class="form-group">
                    <label for="">نام شما</label>
                    <hr>

                    <input required value="{{ old('name') }}" type="text" id="searchInput" name="name"
                        onkeyup="inputSearch('name')" id="" class="form-control">

                    <span class="text-danger" style="display: none;" id="nameErr">نام وارد شده باید بصورت حروف انگلیسی
                        باشد</span>
                    <div id="searchResult"
                        style=" display:flex;top:28%;  position: absolute; flex-direction: column;   background-color:whitesmoke; z-index: 1000000000; right:15%;border-radius:25px!important;"
                        class="col-8">

                    </div>


                </div>
            </div>



            <div class="col-md-6">

                <div class="form-group">

                    <label for="">نام خانوادگی شما</label>
                    <hr>
                    <input required value="{{ old('family') }}" type="text" name="family" class="form-control"
                        id="searchInput2" onclick="inputSearchFamily('family');">

                    <span class="text-danger" id="familyErr" style="display: none;">نام خانوادگی وارد شده باید بصورت حروف
                        انگلیسی
                        باشد</span>
                    <div id="searchResult2"
                        style=" display:flex;top:38%;  position: absolute; flex-direction: column;   background-color:whitesmoke; z-index: 1000000000; right:15%;border-radius:25px!important;"
                        class="col-8">

                    </div>

                </div>
            </div>

        </div>

        <hr>


        @php
            $type = 'submit';
            $text = 'آیا از صحت تاریخ نام و نام خانوادگی خود اطمینان دارید؟';
        @endphp


        <div class="Click-here">
            تایید
        </div>
        <x-submit :type='$type' :text='$text' />



        <!-- Use any element to open/show the overlay navigation menu -->
        <a href="#" onclick="openNav()">جستجو توسط ارگانها</a>


    </form>
    <hr>



    <script>
        $(document).on('click', 'body *', function() {

            $('#searchResult').html("");
            $('#searchResult2').html("");

        })

        function inputSearch(type) {


            var searchinput = $('#searchInput').val();



            if (searchinput.match(/^[a-z0-9_.,'"!?;:& ]+$/i)) {

                $('#nameErr').css('display', 'none');
            } else {


                $('#nameErr').css('display', 'block');
            }



            // formData = {
            //     name: searchinput,
            //     type: type
            // }


            // $.ajax({
            //     type: "POST",
            //     url: "{{ route('user.search.searchName') }}",
            //     data: formData,
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function(data) {


            //         console.log(data);




            //         var e = document.querySelector("#searchResult");
            //         var child = e.lastElementChild;
            //         while (child) {
            //             e.removeChild(child);
            //             child = e.lastElementChild;
            //         }



            //         data.forEach(element => {

            //             var newEleme = document.createElement('a');

            //             newEleme.id = 'searchResultItem';
            //             newEleme.class =
            //                 'vazirFont text-black searchResultItem p-3  border-button-search';
            //             newEleme.innerHTML = element.persian_name + ' - ' + element.english_name;
            //             newEleme.onclick = function() {
            //                 $("#searchInput").val(element.english_name);
            //             };
            //             e.appendChild(newEleme);

            //         });

            //     },
            //     error: function(data) {

            //         console.log(data);
            //     }
            // });



        }



        function inputSearchFamily(type) {


            var searchinput = $('#searchInput2').val();


            if (searchinput.match(/^[a-z0-9_.,'"!?;:& ]+$/i)) {

                $('#familyErr').css('display', 'none');
            } else {


                $('#familyErr').css('display', 'block');
            }



            // formData = {
            //     name: searchinput,
            //     type: type
            // }


            // $.ajax({
            //     type: "POST",
            //     url: "{{ route('user.search.searchName') }}",
            //     data: formData,
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function(data) {


            //         console.log(data);

            //         var e = document.querySelector("#searchResult2");
            //         var child = e.lastElementChild;
            //         while (child) {
            //             e.removeChild(child);
            //             child = e.lastElementChild;
            //         }



            //         data.forEach(element => {

            //             var newEleme = document.createElement('a');

            //             newEleme.id = 'searchResultItem';
            //             newEleme.class =
            //                 'vazirFont text-black searchResultItem p-3  border-button-search';
            //             newEleme.innerHTML = element.persian_name + ' - ' + element.english_name;
            //             newEleme.onclick = function() {
            //                 $("#searchInput2").val(element.english_name);
            //             };
            //             e.appendChild(newEleme);

            //         });

            //     },
            //     error: function(data) {

            //         console.log(data);
            //     }
            // });



        }
    </script>


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



                var newCount = ((inputForTopCount.length)/2) + 1;

                console.log(emptyCount);


                const inputBox = document.getElementById('inputBox');


                var new_div = document.createElement('div');
                new_div.className = "col-md-2 col-6";


                var insideDiv = document.createElement('div');

                insideDiv.className = "d-flex";


                var new_a = document.createElement('a');
                new_a.innerHTML = "شخص" + newCount;


                new_div.appendChild(new_a);
                var new_input = document.createElement('input');
                new_input.name = "name[" + newCount + "]";
                new_input.type = "text";
                new_input.className = "form-control inputForTopCount";

                new_input.setAttribute("required", "required");

                insideDiv.appendChild(new_input);

                var new_input_family = document.createElement('input');
                new_input_family.name = "family[" + newCount + "]";
                new_input_family.type = "text";
                new_input_family.className = "form-control inputForTopCount";

                new_input_family.setAttribute("required", "required");

                insideDiv.appendChild(new_input_family);



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
