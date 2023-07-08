@extends('home.master')


@section('content')
    <div class="container-fluid p-0 ">
        <div class="container-fluid bg-admin">
            <div class="container">
                <div class="row">
                    <div class="nav pt-4 pb-4">




                        <div class="" style="display: flex; width:100% ; justify-content: space-around;">
                            {{-- <a href="{{ route('home') }}">صفحه اصلی</a> --}}
                            @if (Session::has('wellcome'))
                                {{ Session::get('wellcome') }}
                            @endif
                          
                          
                          
                            @auth
                                @if (Session::has('notAvailable'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('notAvailable') }}

                                    </div>
                                @endif


                                
                                @if (Auth::user()->rolation->role->name == 'admin')
                                    <a href="{{ route('adminn.panel') }}">پنل ادمین</a>
                                @else
                                    <a href="{{ route('user.panel') }}">پنل کاربری</a>
                                @endif

                                <a href="{{ route('logout') }}">خروج</a>

                            @endauth







                        </div>


                    </div>

                </div>

            </div>
        </div>
        <section class="container">

            <h1 class="text-center pt-4 h3">به وبسایت راز اعداد خوش آمدید   &#x1F60D;

            </h1>
            <div class="row bg-white">
                <div class="col-md-6 h-400px divgrid mt-4">

                    @auth
                        <div class="text-center">
                            <img class="img-fluid w-75" src="{{ 'asset/images/Playful cat-pana (1).svg' }}" alt="">
                        </div>
                    @endauth
                    @guest
                        <div class="mx-auto text-center">
                            <img class="img-fluid img-guest mx-auto" src="{{ asset('/asset/images/Charco - Education.png') }}"
                                alt="">
                        </div>

                        <div class="">

                            <a class="btn btn-outline-primary btn-lg d-block w-75 mx-auto my-2"
                                href="{{ route('auth.LoginPage') }}" class="p-6">


                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                    <path fill-rule="evenodd"
                                        d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                </svg><span class="p-3">ورود</span>

                            </a>

                            <a class="btn btn-outline-success btn-lg d-block w-75 mx-auto my-2"
                                href="{{ route('auth.RegisterPage') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-person-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z" />
                                    <path
                                        d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z" />
                                </svg><span class="p-3">ثبت نام</span>
                            </a>
                        </div>




                    @endguest
                </div>
                <div class="col-md-6 h-400px text-center">
                    @guest
                        <img src="{{ asset('/asset/images/Studying Concept Illustration.svg') }}" alt="">
                    @endguest
                    @auth
                        <div class="text-center mt-5">
                           <a >
                             <img src="{{ asset('/asset/images/asfasfasasf.png') }}" alt="">

                           </a>
                        </div>
                        <a class="btn btn-first mt-4" > شروع انتخاب رشته</a>
                    @endauth
                </div>
            </div>

        </section>
    </div>
@endsection

