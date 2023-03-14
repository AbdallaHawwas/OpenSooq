@extends('layouts.app')
@section('content')

@if(Auth()->user()->id == $provider->user_id)
    <div style="margin-bottom: 5rem;"><a href="{{route("front.directory.edit",$provider->id)}}" class="btn btn-primary" style="@if(app()->getlocale() == 'ar') float: left @else float: right @endif;margin: 2rem 0 0 2rem">@if($provider->type == 2){{__("lang.EditYourStore")}} @else {{__("lang.EditYourPage")}} @endif</a></div>
@endif
<div class="container pt-3">        
    <div class="store row pt-3">
        <div style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="width:25%;margin-bottom: 20px;">
                <img src="{{$provider->img ? asset("storage/uploads/directory/$provider->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="width: 100%;">
        </div>
        <div class="store-data col" style="display: grid">
            {{-- Detect Filled Language --}}
            @php
            // Default language 
            $lang = app()->getlocale();
            $names =json_decode($provider->name,true); 
            // if Default has no value
            if($names[$lang] == null){
                foreach ($names as $name => $val) {
                    if($val != null){ 
                        $lang = $name; 
                        break;
                    }
                }
            }
            @endphp
            {{-- Detect Filled Language --}}
            <h3 class="title name" style="font-size: 30px;">{{$names[$lang]}}</h3>
            <div class="description" style="color: #aaa;width: 80%;">
            {{json_decode($provider->description,true)[$lang]}}            
            </div>
            <div class="number">{{__("lang.phone")}}: {{$provider->phone}}</div>
            <div class="city">{{__("lang.Country")}}: {{ $provider->city ? $provider->city->country->name . ' - ' . $provider->city->name : '' }}</div>
            @if($provider->type == 2)
                <div class="address">{{__("lang.Address")}} : {{json_decode($provider->address,true)[$lang]}}</div>
            @endif
    <style>
        .store-data > * {
        font-size: 16px;
    }
    div.store-img{
    height: 120px;
}
div.store-img img {
        width: 200px;
        height: 200px;
    }
@media screen and (max-width: 1100px){
    div.store-img {
        height: 90px;
    }
    div.store-img img {
        width: 100px;
        height: 100px;
    }
}
    </style>
        </div>
    </div>
</div>
</div>
@endsection