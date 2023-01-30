@extends('layouts.app')
@section('styles')
<style>
    .search, nav{
        display:none !important;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-5 mx-auto text-start px-3" style="">
        <div class="col-12 align-items-center justify-content-center row" style="">
            {{-- <div class="col-12 card"> --}}
                <div class= style="border-radius: 14px">
                    <img src="{{ $settings->website_logo() }}" alt="" style="margin: 0 auto;display: block;" width="200" height="200">

                    <form class="p-2" name="first-step">
                        @csrf
                        <div class="text-center pb-2 pt-5">
                            <p class="py-1" style="font-size: 40px;">{{ __('lang.login') }} / {{ __('lang.Register') }}</p>
                        </div>
                        <div class="form-group row pb-1">
                            <div class="col-12">
                                <div class="inputs" style="border:#000 1px solid;width: 100%;height: 70px; display: flex;background: #fff;flex-direction: row-reverse; margin-bottom: 30px;">
                                    <input id="phone" type="number" style=" border: unset; width: 80%;margin-left: 10px;" class="rad14 form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="{{__('lang.phone')}}">

                                    <select name="country" id="countryLogin" class="d-flex" style="border: unset;width: 30%;text-align: center;">
                                        @foreach ( \App\Models\Country::all() as $country)
                                            <option data-img_src="{{"/storage/uploads/countries/". $country->flag}}" value="{{$country->id}}">+ {{$country->code}}</option>
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
                        setTimeout(() => {                            
                            var opt = {
                                'templateSelection': custom_template,
                                'templateResult': custom_template,
                            }
                            $('#countryLogin').select2(opt);
                            $("form[name='first-step'] span.selection > span").css("border","0");
                            $("form[name='first-step'] .select2-selection__arrow").css("visibility","hidden");
                        }, 2000);
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
                        <a href="{{route('register')}}" class="text-center"><span>{{ __('lang.Register') }}{{(App::isLocale('ar') ? "؟" : "?")}}</span></a>
                    </form>
                    <form method="POST" class="p-2 d-none" action="{{ route('login') }}" name="second-step">
                        @csrf
                        <div class="text-center pb-2 pt-5">
                          <h3 class="user_name">{{__('lang.Welcome Back!') . " " }}</h3>
                          <img class="user_photo" src="" alt="" style="margin: 10px;width: 100px;height: 100px;border-radius: 50px;">
                          <p class="py-1" style="font-size: 20px;">{{ __('lang.password') }}</p>
                          <br><span class="alert alert-primary" style="cursor: pointer" onclick="loginReverse()">{{__("lang.editNumber")}}</span>
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
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
