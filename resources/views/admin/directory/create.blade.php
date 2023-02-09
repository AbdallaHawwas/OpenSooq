@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.directory.store')}}">
		@csrf

		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>	إضافة جديد
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
                <div class="col-12 p-3 row">
                    <div class="col-12 p-2">
                        <div class="col-12 p-2">
                            <div class="col-12">
                                <h3>ترجمة البيانات</h3>
                            </div>
                            <br />
                        </div>

                        {{-- More Language --}}
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @foreach (config("laravellocalization.supportedLocales") as $key => $lang)
                            <li class="nav-item mx-auto" role="presentation">
                            <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}-tab" data-bs-toggle="pill" href="#pills-{{ $key }}" role="tab" aria-controls="pills-{{ $key }}" aria-selected="true">{{ $lang['native'] }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                        @foreach (config("laravellocalization.supportedLocales") as $key => $lang)
                            <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="pills-{{ $key }}" role="tabpanel" aria-labelledby="pills-{{ $key }}-tab">
                                <div class="col-12 col-lg-12 p-2">
                                    <div class="col-12">
                                        اسم الشركة / الفرد
                                    </div>
                                    <div class="col-12 col-lg-12 pt-3">
                                        <input type="text" name="{{ $key }}[name]" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12">
                                        الوصف
                                    </div>
                                    <div class="col-12 pt-3 ">
                                        <input type="text" name="{{ $key }}[description]" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 p-2">
                                    <div class="col-12">
                                        العنوان
                                    </div>
                                    <div class="col-12 pt-3">
                                        <input type="text" name="{{ $key }}[address]" class="form-control">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-12 p-2">
                        <div class="col-12">
                            نوع العنصر
                        </div>
                        <div class="col-6 pt-3">
                            <select name="type" id="type" class="form-control" required>
                                <option value="1" selected>فرد</option>
                                <option value="2">شركة</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="pt-3">
                            <div>
                                الصورة
                            </div>
                            <div class="pt-3 col-6">
                                <input type="file" name="img"  id="img" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="col-12 p-2">
                <div class="col-12">
                    رقم الهاتف           
                </div>
                <div class="col-6 pt-3">
                    <input type="number" name="phone" required class="form-control">
                </div>
            </div>
            <div class="col-12 p-2">
                <div >
                    الدولة و المدينة
                </div>
                    <livewire:city />
            </div>
            <div class="col-12 p-2">
                <livewire:category />
            </div>

            <div class="col-12 p-2">
                <div >
                    السجل التجاري
                </div>
                <div class="col-6 pt-3">
                    <input type="file" name="license"  id="license" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                </div>
            </div>
            
            <div class="col-6 p-2">
                <span class="text-bold ">صورة غلاف</span>
                <div class="h-75 my-3" style="border: #b7a5a5 3px dashed;color: #b7a5a5;">
                    <div style="position: absolute;display:none;margin-right: 10px;" id="remove-cover"><i class="fas fa-times"></i></div>
                    <label style="text-align: center;width: 100%;font-size: 1.3rem;height: 100%;padding-bottom: 10%;cursor: pointer;" for="cover" class="form-label">                 
                        <div style="margin-top: 10%;">
                            <i class="fas fa-plus"></i> 
                            <span style="display: block;">أضف هنا صورة غلاف</span>
                        </div>
                        <img id="imgOutCover" style="display: none;width:80%" src="{{asset('images/default/image.jpg')}}" alt="Default Image" width="150" height="150">
                    </label>
                    <input type="file" name="cover" id="cover" class="form-control d-none" accept="image/png, image/jpg, image/jpeg, image/webp">          

                </div>
            </div>
            <div class="col-6 p-3">
                <div class="mb-5">
                    <span class="text-bold me-3" >إضافة وسائل التواصل الإجتماعي</span>
                    <span class="add-social" style="background-color:{{$settings->main_color()}}; border-radius:20px; font-size:14px; color:#fff;cursor: pointer;padding: 5px 11px;"><i class="fas fa-plus"></i></span>
                </div>
                <div class="links">
                    <input type="text" name="social-links[]" placeholder="facebook" class="form-control">
                    <input type="text" name="social-links[]" placeholder="whatsapp" class="form-control">
                    <input type="text" name="social-links[]" placeholder="website" class="form-control">
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </div>
		</form>
	</div>
</div>

<script>
// cover 
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
    imagePreview("cover","imgOutCover","remove-cover");
// social
const socialInput = document.querySelector("input[name=\"social-links[]\"]").cloneNode();
        // socialInput.setAttribute("placeholder","other link");
        // document.querySelector(".add-social").addEventListener("click",()=>{
        //     document.querySelector("div.links").appendChild(socialInput);
        // });
</script>
@endsection