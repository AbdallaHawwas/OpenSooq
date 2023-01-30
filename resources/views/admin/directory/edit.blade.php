@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">


		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.voucher.update',$provider->id)}}">
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
                                        <input type="text" name="{{ $key }}[name]" required class="form-control" value="{{json_decode($provider->name,true)[$key]}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="col-12">
                                        الوصف
                                    </div>
                                    <div class="col-12 pt-3 ">
                                        <input type="text" name="{{ $key }}[description]" required class="form-control" value="{{json_decode($provider->description,true)[$key]}}>
                                    </div>
                                </div>
                                <div class="col-12 p-2">
                                    <div class="col-12">
                                        العنوان
                                    </div>
                                    <div class="col-12 pt-3">
                                        <input type="text" name="{{ $key }}[address]" required class="form-control" value="{{json_decode($provider->address,true)[$key]}}>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="pt-3">
                            <div>
                                الصورة
                            </div>
                            <div class="pt-3 col-6">
                                <input type="file" name="img" required  id="img" class="form-control" accept="image/png, image/jpg, image/jpeg, image/webp">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="col-12 p-2">
                <div class="col-12">
                    رقم الهاتف           
                </div>
                <div class="col-6 pt-3">
                    <input type="number" name="phone" required class="form-control" value="{{$provider->phone}}">
                </div>
            </div>
            <div class="col-12 p-2">
                <div >
                    الدولة و المدينة
                </div>
                <livewire:city :country_id="$provider->city->country_id ?? null" :city_id="$provider->city->id ?? null" />
            </div>

            <div class="col-12 p-2">
                <div class="col-12">
                    نوع العنصر
                </div>
                <div class="col-6 pt-3">
                    <select name="type" id="type" class="form-control" required>
                        <option value="1" @if($provider->type == 1) selected @endif>فرد</option>
                        <option value="2" @if($provider->type == 2) selected @endif>شركة</option>
                    </select>
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </div>
		</form>
	</div>
</div>
@endsection