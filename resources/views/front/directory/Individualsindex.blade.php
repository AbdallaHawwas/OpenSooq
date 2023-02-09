@extends('layouts.app')
@section('content')
{{-- Add Button --}}
@if(Auth::user())
    <div><a href="{{route("front.individual.create")}}" class="btn btn-primary" style="float: left;margin: 2rem 0 0 2rem">أضف صفحتك للدليل المجاني</a></div>
@endif
<div class="container pt-3">
    @foreach($Individuals as $person)
        
    <div class="store row pt-3">
        <a href="#" style="display: flex">
            <div class="store-img col-3 col-sm-2 me-3" style="background-color: #fff;height: 120px;">
                <img src="{{$person->img ? asset("storage/uploads/directory/$person->img") :  asset("images/default/image.jpg")}}" alt="store-img" style="width: 100%;">
        </div>
        <div class="store-data col" style="display: grid">
            {{-- Detect Filled Language --}}
            @php
            // Default language 
            $lang = app()->getlocale();
            $names =json_decode($person->name,true); 
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
            {{json_decode($person->description,true)[$lang]}}            
            </div>
            <div class="number">الرقم: {{$person->phone}}</div>
            <div class="city">البلد: </div>
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