@extends('layouts.app')
@section('content')

<div class="mx-3 my-5"><h3>{{ __("lang.HelpCenter")}} </h3></div>
<div class="container row">
    @foreach ($videos as $video)
        <div class="col-sm-4">
            <video poster="{{$settings->website_logo()}}" controls style="width: 100%;border-radius: 10px ;cursor: pointer;" data-bs-target="#exampleModal" >
                <source src="{{ asset("storage/" . $video->link)}}"
                type="video/mp4">
            </video>
            <h5 class="title fw-bold">{{json_decode($video->title,true)[app()->getLocale()]}}</h5>
            <span class="title" style="font-size: 13px">{{json_decode($video->subtitle,true)[app()->getLocale()] ?? ""}}</span>
        </div>
        @endforeach
    <div class="whatsapp" style="">
        <a href="#"><img style="position: fixed;bottom: 50px;width: 80px;height: 80px;left: 40px;cursor: pointer;" src="{{ asset('images/default/whatsapp-icon.png')}}" alt=""></a>
    </div>
</div>
@endsection