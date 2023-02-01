@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.help-center.update',$helpCenter->id)}}">
		@csrf
        @method('PUT')
		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>	تعديل عنصر مركز المساعدة
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3 row">
                <div class="col-12 col-lg-6 p-2">
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
                                    العنوان
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="{{ $key }}[title]" required class="form-control" value="{{json_decode($helpCenter->title,true)[$key]}}">
                                </div>
                            </div>
                        
                            <div class="col-12 col-lg-12 p-2">
                                <div class="col-12">
                                    وصف الفيديو
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="text" name="{{ $key }}[subtitle]" class="form-control" value="{{json_decode($helpCenter->subtitle,true)[$key]}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="col-12 p-2">
                    <div class="col-12">
                        الفيديو
                    </div>
                    <div class="col-12 pt-3">
                        <input type="file" name="link" requiredclass="form-control" accept="video/*">
                    </div>
                    <div class="col-12 pt-3">

                    </div>
                </div>
                    <div class="col-12  p-2">
                        <div class="col-6">
                            <div>
                                تصنيف الفيديو
                            </div>
                            <div class=" pt-3">
                                <input type="text" value="{{$helpCenter->vid_category}}" name="vid_category" id="vid_category" class="form-control">
                            </div>
                        </div>
                        @if(count($categories))
                        <div class="col-6 mt-2">
                            <div class="">
                                تصنيفات موجودة من قبل
                            </div>
                            <div class=" pt-3">
                                <select id="categories" class="form-control">
                                    <option value=""></option>
                                    @foreach($categories as $category)
                                        @if($category['vid_category'] != '')
                                            <option value="{{$category['vid_category']}}">{{$category['vid_category']}}</option>
                                        @endif
                                    @endforeach       
                                </select>
                            </div>
                        </div>
                            <script>
                                const category = document.querySelector("select#categories");
                                    category.addEventListener("change",function(){
                                        if(category.value != ''){
                                            document.querySelector("input#vid_category").value = category.value;
                                        }
                                    });
                                   
                            </script>
                        @endif
                    </div>
                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        حالة الظهور
                    </div>
                    <div class="col-12 pt-3">
                        <select class="form-control" name="hidden" required>
                            <option @if($helpCenter->hidden =="0" ) selected @endif value="0">اخفاء</option>
                            <option @if($helpCenter->hidden =="1" ) selected @endif value="1">ظهور</option>
                        </select>
                    </div>
                </div>
			</div>
		</div>

		<div class="col-12 p-3">
			<button class="btn btn-success" id="submitEvaluation">حفظ</button>
		</div>
		</form>
	</div>
</div>

@endsection