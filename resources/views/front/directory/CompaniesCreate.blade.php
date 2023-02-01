@extends('layouts.app')
@section('content')

<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.directory.store')}}">
    <div class="mx-5 mt-5 mb-3 d-flex flex-wrap justify-content-around flex-row" style="direction: rtl" style="">
        <div class="mb-5">
            <h2 style="color: {{$settings->main_color()}}">أضف متجرك</h2>
            قم بتعبئة جميع البيانات بالأسفل لإنشاء متجرك الخاص
        </div>
        <div style="cursor:pointer; border-radius: 50px; margin-top:0 !important; border-radius: 50%;border: #c58989 7px solid;overflow: hidden;">
            <img for="img" src="{{asset('images/default/image.jpg')}}" alt="Default Image" width="150" height="150">
            <input type="file" name="img"  id="img" class="form-control d-none" accept="image/png, image/jpg, image/jpeg, image/webp">
        </div>
    </div>
    <div class="row row-cols-3 data" style="direction: rtl">
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">اسم المتجر</span>
            <input type="text" name="name" class="form-control" placeholder="أدخل اسم متجرك أو مطعمك">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">تحديد القسم</span>
            <select name="category" id="category" class="form-select" aria-label="Default select example">
                <option value="1">category 1</option>
                <option value="2">category 2</option>
                <option value="3">category 3</option>
            </select>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">السجل التجاري</span>
            <input type="file" name="license"  id="license" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
        </div>
        <div class="col-12 col-sm-4 mb-3 d-flex flex-column justify-content-between">
            <div>
                <span class="text-bold">الدولة</span>
                <select class="form-select mb-5" aria-label="Default select example">
                    <option value="1">option 1</option>
                    <option value="2">option 2</option>
                    <option value="3">option 3</option>
                </select>
            </div>
            <div>
                <span class="text-bold">المدينة</span>
                <select name="city" id="city" class="form-select" aria-label="Default select example">
                    <option value="1">option 1</option>
                    <option value="2">option 2</option>
                    <option value="3">option 3</option>
                </select>
            </div>
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="description" class="form-label">وصف المتجر</label>
            <textarea class="form-control" style="resize: none;" name="description" id="description" placeholder="أدخل هنا وصف متجرك أو مطعمك" rows="5"></textarea>        
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">صورة غلاف</span>
            <div class="h-75" style="border: #b7a5a5 3px dashed;color: #b7a5a5;">
                <label style="text-align: center;width: 100%;font-size: 1.3rem;height: 100%;padding-top: 10%;cursor: pointer;" for="cover" class="form-label"><i class="fas fa-plus"></i> <br>أضف هنا صورة غلاف</label>
                <input type="file" name="cover"  id="cover" class="form-control d-none" accept="image/png, image/jpg, image/jpeg, image/webp">          
            </div>
        </div>
        <div class="col-12 col-sm-4 mb-3 d-flex flex-column justify-content-center">
            <div class="mb-5">
                <span class="text-bold me-3" >إضافة وسائل التواصل الإجتماعي</span>
                <span style="background-color:{{$settings->main_color()}}; border-radius:20px; font-size:14px; color:#fff;cursor: pointer;padding: 5px 11px;"><i class="fas fa-plus"></i></span>
            </div>
            <div class="links">
                <input type="text" name="social-links[]" placeholder="facebook" class="form-control">
                <input type="text" name="social-links[]" placeholder="whatsapp" class="form-control">
                <input type="text" name="social-links[]" placeholder="website" class="form-control">
            </div>
        </div>
        <div class="col-12 col-sm-8 mb-3 d-flex flex-column justify-content-evenly" style="text-align: center;">
            <div class="form-check" >
                <input name="policy" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" style="float: unset;margin: 5px;">
                <label class="form-check-label" for="flexCheckDefault" >
                  أوافق علي <a href="#" style="color:{{$settings->main_color()}} !important;">شروط وسياسة الإستخدام</a>
                </label>
            </div>
            <div>
                <button class="btn btn-success" id="submitEvaluation" style="padding: 0.5rem 3rem;background-color: {{$settings->main_color()}};">تأكيد المعلومات و إنشاء المتجر</button>
            </div>
        </div>
    </div>
</form>
@endsection