<div class="container-fluid px-3 py-2 font-2 fw-bold">
    <form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">@csrf</form>
    <nav class="navbar navbar-expand-lg">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="far fa-bars font-4"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="col-12 navbar-nav mb-2 mb-lg-0 text-center">
                <li class="nav-item pt-2">
                    <a class="navbar-brand mainColor mx-3" href="/">
                        {{-- <h3>{{$settings->website_name}}</h3> --}}
                        <img src="{{ $settings->website_logo() }}" alt="" width="120" height="60">
                    </a>  
                </li>
                <li class="nav-item pt-2">
                    <a class="nav-link font-2 active" href="{{ route('home') }}">{{ __('lang.Go Home') }}</a>
                </li>
                <li class="nav-item pt-2">
                    <a class="nav-link font-2"
                        href="{{ route('front.categories.index') }}">{{ __('lang.Categories') }}</a>
                </li>

                <li class="nav-item dropdown pt-2">
                    <a class="nav-link dropdown-toggle font-2" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <span class="fal fa-language"></span>
                        {{ __('lang.Language') }}
                    </a>
                    <ul class="dropdown-menu text-center">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item pt-2">
                    <a class="nav-link font-2" href="{{ route('front.stores.index') }}">{{ __('lang.Stores') }}</a>
                </li>

                <li class="nav-item pt-2 position-relative">
                    <a class="nav-link dropdown-toggle font-2" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">{{ __('lang.FreeDirectory') }}</a>
                    <ul class="dropdown-menu text-center">
                        <li class="my-3"><a href="{{route("front.directory.companies")}}">{{__("lang.companies")}}</a></li>
                        <li class="my-3"><a href="{{route("front.directory.individuals")}}">{{__("lang.individuals")}}</a></li>
                    </ul>
                </li>

                @if (!auth()->check())
                    <li class="nav-item pt-2"><a class="nav-link font-2" href="/login" {{--data-bs-toggle="modal" data-bs-target="#exampleModal" --}}>{{ __('lang.Login') }}</a></li>
                @else
                <div class="btn-group" id="notificationDropdown">

                    <div class="col-12 px-0 d-flex justify-content-center align-items-center btn  "
                        style="width: 55px;height: 55px;" data-bs-toggle="dropdown" aria-expanded="false"
                        id="dropdown-notifications">
                        <span class="fal fa-bell font-3 d-inline-block"
                            style="color: #333;transform: rotate(15deg)"></span>
                        <span
                            style="position: absolute;min-width: 25px;min-height: 25px;
                        @if ($unreadNotifications != 0) display: inline-block;
                        @else
                        display: none; @endif
                        right: 0px;top: 0px;border-radius: 20px;background: #c00;color:#fff;font-size: 14px;"
                            id="dropdown-notifications-icon">{{ $unreadNotifications }}</span>

                    </div>
                    <div class="dropdown-menu py-0 rounded-0 border-0 shadow "
                        style="cursor: auto!important;z-index: 20000;width: 350px;height: 450px;">
                        <div class="col-12 notifications-container" style="height:406px;overflow: auto;">
                            <x-notifications :notifications="$notifications" />
                        </div>
                        <div class="col-12 d-flex border-top">
                            <a href="{{ route('front.notifications.index') }}" class="d-block py-2 px-3 ">
                                <div class="col-12 align-items-center">
                                    <span class="fal fa-bells"></span> عرض كل الإشعارات
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <li class="nav-item pt-2">
                    <a class="nav-link font-2" href="{{route('help')}}">{{ __('lang.HelpCenter') }}</a>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-between w-100 mb-lg-0 col-12 col-md-3 text-end navBottom">
            {{-- <div> --}}
            <a href="#" class="btn btn-dark btn-sm">
                {{ __('lang.visitors') }} 20000000
            </a>
            <a href="{{ route('front.store.my_store') }}"
                class="btn btn-dark btn-sm">{{ __('lang.OpenStore') }} </a>
            <a href="{{ route('front.announcements.create') }}"
                class="btn btn-sm">{{ __('lang.AddAnnouncement') }}</a>
            <div class="user d-flex">
                    @if (auth()->check())
                    <span class="user_nav_text">{{ __('lang.Hello!') }} {{auth()->user()->name}}</span>
                       
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{-- <img src="{{ asset(auth()->user()? auth()->user()->getUserAvatar(): 'images/default/avatar.png') }}" --}}
                            <img src="{{ auth()->user()->avatar ? asset('images/' . auth()->user()->avatar ) : asset('images/default/avatar.png') }}"
                                alt="" style="border-radius: 50%" width="40" height="40">
                        </a>
                        <ul class="user_dropdown dropdown-menu text-center" style="{{App::isLocale('ar') ? "right: 85% !important" : "left:unset"}};">
                            <li class="nav-item pt-2"><a class="nav-link font-2"
                                    href="{{ route('front.profile') }}">{{ auth()->user()->name }}</a></li>
                            <li class="nav-item pt-2"><a class="nav-link font-2"
                                    href="{{ route('front.chat') }}">{{ __('lang.messages') }}
                                    {{-- ({{ auth()->user()->messages }}) --}}
                                </a>
                            </li>
                            @if (auth()->user()->store)
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.store.my_store') }}">{{ auth()->user()->store->name }}</a>
                                </li>
                            @else
                                <li class="nav-item pt-2"><a class="nav-link font-2"
                                        href="{{ route('front.store.create') }}">{{ __('lang.OpenStore') }}</a></li>
                            @endif
                            <li class="nav-item pt-2"><a class="nav-link font-2" href="#"
                                    onclick="document.getElementById('logout-form').submit();">{{ __('lang.Logout') }}</a>
                            </li>
                        </ul>
                    @else
                    <span class="user_nav_text">{{ __('lang.guest') }}</span>
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{-- <img src="{{ asset(auth()->user()? auth()->user()->getUserAvatar(): 'images/default/avatar.png') }}" --}}
                        <img src="{{ auth()->check()? auth()->user()->getUserAvatar(): asset('images/default/avatar.png') }}"
                            alt="" style="border-radius: 50%" width="40" height="40">
                    </a>
                    @endif    
            </div>
            {{-- </div> --}}
        </div>
    </nav>

    @if (!auth()->check())
        {{-- Login --}}
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 14px">
                    <form method="POST" class="p-2" action="{{ route('login') }}">
                        @csrf
                        <div class="text-center pb-2 pt-5">
                            <img src="{{ $settings->website_logo() }}" alt="" width="120"
                                height="60">
                            {{-- <img src="{{$settings->website_logo()}}" alt="" width="220" height="50"> --}}
                           {{-- <p class="py-1">{{ __('lang.login') }}</p>
                        </div>
                        <div class="form-group row pb-1">

                            <div class="col-12">
                                <label for="email"
                                    class="col-form-label text-md-end">{{ __('lang.email') }}</label>
                                <input id="email" type="email"
                                    class="rad14 form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-1">

                            <div class="col-12">
                                <label for="password"
                                    class="col-form-label text-md-end">{{ __('lang.password') }}</label>
                                <input id="password" type="password"
                                    class="rad14 form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row pb-3 text-right">
                            <div class="col-12">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('lang.remember_me') }}
                                </label>
                            </div>
                        </div>


                        <div class="form-group row pb-3 px-5 text-center">
                            <button type="submit" class="btn mainBgColor">
                                {{ __('lang.login') }}
                            </button>
                            <div class="col-md-12">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('lang.forget_your_password') }}
                                    </a>
                                @endif
                            </div>
                          {{-- New User --}}
                            {{--<div class="col-md-12">
                                    <a class="btn btn-link" href="{{ route('register') }}">
                                        {{ __('lang.notUser') }}
                                    </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 14px">
                    <form class="p-2" name="first-step">
                        @csrf
                        <div class="text-center pb-2 pt-5">
                            <img src="{{ $settings->website_logo() }}" alt="" width="200" height="200">
                            <p class="py-1" style="font-size: 40px;">{{ __('lang.login') }} / {{ __('lang.Register') }}</p>
                        </div>
                        <div class="form-group row pb-1">
                            <div class="col-12">
                                <div class="inputs" style="border:#000 1px solid;width: 100%;height: 70px; display: flex;flex-direction: row-reverse; margin-bottom: 30px;">
                                    <input id="phone" type="number" style=" border: unset; width: 80%;margin-left: 10px;" class="rad14 form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="{{__('lang.phone')}}">
                                   
                                   
                                   
                                    <select name="country" id="countryLogin" class="d-flex" style="border: unset;width: 30%;text-align: center;">
                                        @foreach (\App\Models\Country::all() as $country)
                                            <option data-img_src="{{$country->flag}}" value="{{$country->id}}">+ {{$country->code}}</option>
                                        @endforeach
                                    </select>
                                
                                
                                </div>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <script>
                            document.querySelector("form[name='first-step']").addEventListener("submit", function(e){
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    }
                                });
                                
                                $.ajax({
                                    type : "POST",
                                    url: ' {{ route("checkPhone") }} ',
                                    datatype : "json",
                                    data: {                                        
                                        "phone" : document.querySelector("#phone").value,
                                        "country" : document.querySelector("#countryLogin").value
                                    },
                                    success: function(data){
                                        stepTwo(data.name,data.email,data.phone,data.photo);
                                    },
                                    error : function(err){
                                        window.location.href = ('/register?country='+ err.responseJSON.country);
                                    }
                                });
                                e.preventDefault();
                            });
                        </script>
                        <div class="form-group text-center">
                            <button type="submit" style="width: 100%; padding: 20px 0; margin: 20px 0px;" class="btn mainBgColor">
                                {{ __('lang.login') }}
                            </button>                      
                        </div>
                    </form>
                    <form method="POST" class="p-2 d-none" action="{{ route('login') }}" name="second-step">
                        @csrf
                        <div class="text-center pb-2 pt-5">
                            <img src="{{ $settings->website_logo() }}" alt="" width="120"
                                height="60">
                          <br><br>
                          <h3 class="user_name">{{__('lang.Welcome Back!') . " " }}</h3>
                          <img class="user_photo" src="" alt="" style="margin: 10px;width: 100px;height: 100px;border-radius: 50px;">
                          <br><br>      
                          <p class="py-1" style="font-size: 40px;">{{ __('lang.password') }}</p>
                        </div>
                        <input type="hidden" name="phone" value="">
                        <input type="hidden" name="email" value="">
                        <div class="form-group row pb-1 ">

                            <div class="col-12">
                                <label for="password"
                                    class="col-form-label text-md-end">{{ __('lang.password') }}</label>
                                <input id="password" type="password" style="width: 100%; padding: 20px 10px; margin: 20px 0px;"
                                    class="rad14 form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <div class="col-12">
                                <input class="form-check-input" type="checkbox"  name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('lang.remember_me') }}
                                </label>
                            </div>
                        </div>


                        <div class="form-group text-center">
                            <button type="submit" style="width: 100%; padding: 20px 0; margin: 20px 0px;" class="btn mainBgColor">
                                {{ __('lang.login') }}
                            </button>
                            <div class="col-md-12">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('lang.forget_your_password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
    @endif
</div>
