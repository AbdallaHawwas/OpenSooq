@extends('layouts.app')
@section('content')
{{-- Add Button --}}
<div style="margin-bottom: 5rem;"><a href="{{route("front.store.create")}}" class="btn btn-primary" style="@if(app()->getlocale() == 'ar') float: left @else float: right @endif;margin: 2rem 0 0 2rem">{{__('lang.AddYourCompanyToFreeDirectory')}}</a></div>
<div class="container pt-3">
    @foreach ($companies as $company)
        
    <div class="store row py-3" style="margin-bottom: 2rem !important">
        <a href="{{route('front.directory.show',$company->id)}}" style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="height: 120px;">
                <img src="{{$company->img ? asset("storage/uploads/directory/$company->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="width: 100%;">
        </div>
        <div class="store-data col" style="display: grid">
            {{-- Detect Filled Language --}}
            @php
            // Default language 
            $lang = app()->getlocale();
            $names =json_decode($company->name,true); 
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
            <h3 class="title name" style="font-size: 20px;">{{$names[$lang]}}</h3>
            <div class="description" style="color: #aaa;width: 80%;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;">
            {{json_decode($company->description,true)[$lang]}}            
            </div>
            <div class="number">{{__("lang.phone")}}: {{$company->phone}}</div>
            <div class="city">{{__("lang.Country")}}: </div>
            <div class="address">{{__("lang.Address")}} : {{json_decode($company->address,true)[$lang]}}</div>
       </div>
    </a>
</div>
@endforeach
<style>
    .store-data > * {
    font-size: 12px;
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

@endsection