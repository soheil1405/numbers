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
    <h4 class="text-center p-4">موتور جستجوی دوم</h4>




    <form action="{{ route('user.search.submit') }}" method="post">

        @csrf


        <div class="row">


            <div class="col-md-6">

                <div class="form-group">
                    <label for="">نام شما</label>
                    <hr>

                    <input required value="{{old('name')}}" type="text" id="searchInput" name="name" onkeyup="inputSearch('name')" id=""
                        class="form-control">

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
                    <input required value="{{old('family')}}" type="text" name="family" class="form-control" id="searchInput2"
                        onclick="inputSearchFamily('family');">

                    <span class="text-danger" style="display: none;" id="familyErr">نام خانوادگی وارد شده باید بصورت حروف
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


<div class="Click-here" >
    تایید
</div>
        <x-submit :type='$type' :text='$text' />



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



            formData = {
                name: searchinput,
                type: type
            }


            $.ajax({
                type: "POST",
                url: "{{ route('user.search.searchName') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {


                    console.log(data);




                    var e = document.querySelector("#searchResult");
                    var child = e.lastElementChild;
                    while (child) {
                        e.removeChild(child);
                        child = e.lastElementChild;
                    }



                    data.forEach(element => {

                        var newEleme = document.createElement('a');

                        newEleme.id = 'searchResultItem';
                        newEleme.class =
                            'vazirFont text-black searchResultItem p-3  border-button-search';
                        newEleme.innerHTML = element.persian_name + ' - ' + element.english_name;
                        newEleme.onclick = function() {
                            $("#searchInput").val(element.english_name);
                        };
                        e.appendChild(newEleme);

                    });

                },
                error: function(data) {

                    console.log(data);
                }
            });



        }



        function inputSearchFamily(type) {


            var searchinput = $('#searchInput2').val();

            if (searchinput.match(/^[a-z0-9_.,'"!?;:& ]+$/i)) {

                $('#familyErr').css('display', 'none');
            } else {


                $('#familyErr').css('display', 'block');
            }


            formData = {
                name: searchinput,
                type: type
            }


            $.ajax({
                type: "POST",
                url: "{{ route('user.search.searchName') }}",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {


                    console.log(data);

                    var e = document.querySelector("#searchResult2");
                    var child = e.lastElementChild;
                    while (child) {
                        e.removeChild(child);
                        child = e.lastElementChild;
                    }



                    data.forEach(element => {

                        var newEleme = document.createElement('a');

                        newEleme.id = 'searchResultItem';
                        newEleme.class =
                            'vazirFont text-black searchResultItem p-3  border-button-search';
                        newEleme.innerHTML = element.persian_name + ' - ' + element.english_name;
                        newEleme.onclick = function() {
                            $("#searchInput2").val(element.english_name);
                        };
                        e.appendChild(newEleme);

                    });

                },
                error: function(data) {

                    console.log(data);
                }
            });



        }
    </script>
@endsection
