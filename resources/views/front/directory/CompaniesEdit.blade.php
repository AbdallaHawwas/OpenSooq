@extends('layouts.app')
@section('content')
<style>
    #app {
        margin-right: 2rem;
    }
</style>
<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.directory.store')}}">
   @csrf
    <div class="mx-5 mt-5 mb-3 d-flex flex-wrap justify-content-around flex-row" style="direction: rtl" style="">
        <div class="mb-5">
            <h2 style="color: {{$settings->main_color()}}"> تعديل متجرك</h2>
            قم بتعبئة جميع البيانات بالأسفل لتعديل متجرك الخاص
        </div>
        <div style="cursor:pointer; position:relative; margin-top:0 !important;">
            <div style="position: absolute;display:none;left: 0" id="remove-input"><i class="fas fa-times"></i></div>
            <label for="imgInp" style="cursor:pointer; border-radius: 50%;border: #c58989 7px solid;overflow: hidden;">
                <img id="imgOut" src="{{$directory->img ? asset("storage/uploads/directory/$directory->img") : asset('images/default/image.jpg')}}" alt="Default Image" width="150" height="150">
            </label>
            <input type="file" name="img"  id="imgInp" class="form-control d-none" value="" accept="image/png, image/jpg, image/jpeg, image/webp">
            <script>
                const imagePreview = (imgInp,imgOut,rmIcon) => {
                    const fileIn = document.getElementById(imgInp),
                    fileOut = document.getElementById(imgOut),
                    removeIcon = document.getElementById(rmIcon);

                    fileOutOldVal = fileOut.src;  

                    removeIcon.onclick = ()=>{
                        fileOut.src = fileOutOldVal;
                        fileIn.value = '';
                    };
                const readUrl = event => {
                    if(event.files && event.files[0]) {
                        let reader = new FileReader();
                        reader.onload = event => fileOut.src = event.target.result;
                        reader.readAsDataURL(event.files[0]);
                        removeIcon.style.display = "unset";     
                    }
                }
                fileIn.onchange = function() {
                readUrl(this);
                }; 
                }
                imagePreview("imgInp","imgOut","remove-input");
            </script>
        </div>
    </div>
    <div class="row row-cols-3 data" style="direction: rtl">
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">اسم المتجر</span>
            <input type="text" name="{{app()->getlocale()}}[name]" value="{{json_decode($directory->name,true)[$lang]}}" class="form-control" placeholder="أدخل اسم متجرك أو مطعمك">
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <livewire:category />
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">السجل التجاري</span>
            <input type="file" name="license"  id="license" class="form-control" value="{{$directory->license}}" accept="image/png, image/jpg, image/jpeg, image/webp">
        </div>
        <div class="col-12 col-sm-4 mb-3 d-flex flex-column justify-content-between">
            <livewire:city />

            <label for="address" class="form-label">العنوان</label>
            <input type="text" name="{{app()->getlocale()}}[address]" value="{{json_decode($directory->address,true)[$lang]}}" id="address" class="form-control">          
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <label for="description" class="form-label">وصف المتجر</label>
            <textarea class="form-control" style="resize: none;" name="{{app()->getlocale()}}[description]" value="{{json_decode($directory->description,true)[$lang]}}" id="description" placeholder="أدخل هنا وصف متجرك أو مطعمك" rows="6"></textarea>        
        </div>
        <div class="col-12 col-sm-4 mb-3">
            <span class="text-bold">صورة غلاف</span>
            <div class="h-75" style="border: #b7a5a5 3px dashed;color: #b7a5a5;">
                <div style="position: absolute;display:none;left: 0" id="remove-cover"><i class="fas fa-times"></i></div>
                <label style="text-align: center;width: 100%;font-size: 1.3rem;height: 100%;padding-bottom: 10%;cursor: pointer;" for="cover" class="form-label">                 
                    <div style="margin-top: 10%;">
                        <i class="fas fa-plus"></i> 
                        <span style="display: block;">أضف هنا صورة غلاف</span>
                    </div>
                    <img id="imgOutCover" style="display: none;width:80%" src="{{$directory->cover ? asset("storage/uploads/directory/$directory->cover") : asset('images/default/image.jpg')}}" alt="Default Image" width="150" height="150">
                </label>
                <input type="file" name="cover" id="cover" value="" class="form-control d-none" accept="image/png, image/jpg, image/jpeg, image/webp">          
                <script>
                    const coverInput = document.querySelector("#cover"),
                          coverLabel = document.querySelector("label[for='cover'] > div");
                    coverInput.addEventListener("change",()=>{
                        if(coverInput.value != ''){
                            coverLabel.style.display = "none";
                            document.querySelector("img#imgOutCover").style.display = "unset";
                        }else{
                            coverLabel.style.display = "block";
                            document.querySelector("img#imgOutCover").style.display = "none";
                        }
                    });
                    document.querySelector("div#remove-cover").addEventListener("click",() => {
                            coverLabel.style.display = "block";
                            document.querySelector("img#imgOutCover").style.display = "none";
                            document.querySelector("div#remove-cover").style.display = "none";
                    });
                    imagePreview("cover","imgOutCover","remove-cover");
                </script>
            </div>
        </div>
        <div class="col-12 col-sm-4 mb-3 d-flex flex-column justify-content-center">
            <div class="mb-5">
                <span class="text-bold me-3" >إضافة وسائل التواصل الإجتماعي</span>
                <span class="add-social" style="background-color:{{$settings->main_color()}}; border-radius:20px; font-size:14px; color:#fff;cursor: pointer;padding: 5px 11px;"><i class="fas fa-plus"></i></span>
            </div>
            <div class="links">
                <input type="text" name="social-links[]" value="{{json_decode($directory->social-links,true)[0]}}" placeholder="facebook" class="form-control">
                <input type="text" name="social-links[]" value="{{json_decode($directory->social-links,true)[1]}}" placeholder="whatsapp" class="form-control">
                <input type="text" name="social-links[]" value="{{json_decode($directory->social-links,true)[2]}}" placeholder="website" class="form-control">
            </div>
            <script>
                const socialInput = document.querySelector("input[name=\"social-links[]\"]").cloneNode();
                socialInput.setAttribute("placeholder","other link");
                document.querySelector(".add-social").addEventListener("click",()=>{
                    document.querySelector("div.links").appendChild(socialInput);
                });
            </script>
        </div>
        <div class="col-12 col-sm-4">
            <label for="phone">رقم الهاتف</label> 
            <input type="number" class="form-control mt-5" value="{{$directory->phone}}" required name="phone" id="phone">
        </div>
        <div class="col-12 col-sm-4 mb-3 d-flex flex-column justify-content-evenly" style="text-align: center;">
            <div class="form-check" >
                <input name="policy" class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" style="float: unset;margin: 5px;" required>
                <label class="form-check-label" for="flexCheckDefault" >
                  أوافق علي <a href="#" style="color:{{$settings->main_color()}} !important;">شروط وسياسة الإستخدام</a>
                </label>
            </div>
            <input type="hidden" name="type" value="2">
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <div>
                <button class="btn btn-success" id="submitEvaluation" style="padding: 0.5rem 3rem;background-color: {{$settings->main_color()}};">تأكيد المعلومات و إنشاء المتجر</button>
            </div>
        </div>
    </div>
</form>
@endsection