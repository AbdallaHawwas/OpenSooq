@extends('layouts.app')
@section('content')
{{-- Add Button --}}
<div><a href="{{route("front.store.create")}}" class="btn btn-primary" style="float: left;margin: 2rem 0 0 2rem">أضف شركتك للدليل المجاني</a></div>
<div class="container pt-3">
    @foreach ($companies as $company)
        
    <div class="store row pt-3">
        <a href="#" style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="background-color: #fff;height: 120px;">
                <img src="{{$company->img ? asset("storage/uploads/directory/$company->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="width: 100%;">
        </div>
        <div class="store-data col" style="display: grid">
            {{-- Detect Filled Language --}}
            @php
            // Default language 
            $lang = app()->getlocale();
            $names =json_decode($company->name,true); 
            // if Default has no value
            if($names[$lang] == ""){
                foreach ($names as $name) {
                    if($name != ""){ 
                        $lang = $name; 
                        break;
                    }
                }
            }
            @endphp
            {{-- Detect Filled Language --}}
            <h3 class="title name" style="font-size: 20px;">{{$names[$lang]}}</h3>
            <div class="description" style="color: #aaa;
            width: 80%;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;">
            {{json_decode($company->description,true)[$lang]}}            
            </div>
            <div class="number">الرقم: {{$company->phone}}</div>
            <div class="city">البلد: </div>
            <div class="address">العنوان : {{json_decode($company->address,true)[$lang]}}</div>
<style>
    .store-data > * {
    font-size: 12px;
}
</style>
        </div>
    </a>
</div>
@endforeach
</div>

@endsection