@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.voucher.update',$voucher->id )}}">
        @csrf
        @method('PUT')
		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span>	تعديل قسيمة الشراء
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
                                        اسم القسيمة
                                    </div>
                                    <div class="col-12 col-lg-12 pt-3">
                                        <input type="text" name="{{ $key }}[name]" required class="form-control" value="{{ json_decode($voucher->name,true)[$key] }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="col-12 ">
                            كود القسيمة
                        </div>
                        <div class="col-6 pt-3 ">
                            <input type="text" name="code" required class="form-control" value="{{$voucher->code}}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="pt-3">
                            <div>
                                قيمة الخصم (%)
                            </div>
                            <div class="pt-3 col-6">
                                <input type="number" name="amount" required  id="amount" class="form-control" value="{{$voucher->amount}}">
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="col-12 p-2">
                <div class="col-12">
                    تخصيص القسيمة            
                </div>
                <div class="col-6 pt-3">
                    <select name="special_user" id="special_user" class="form-control" >
                        <option value="0" @if($voucher->special_user == 0) selected @endif > كل المستخدمين</option>
                        <option value="1" @if($voucher->special_user != 0) selected @endif >مستخدم مخصص</option>
                    </select>
                </div>
                <div class="col-6 pt-3" required id="users" @if($voucher->special_user == 0) style="display:none" @endif>
                    <span>المستخدمين</span>
                    <select name="users[]" multiple  class="form-control">
                        {{var_dump($voucher->special_user)}}
                        @foreach($users as $user)
                        <option value="{{$user->id}} @if(Arr::has(explode(",",$voucher->special_user),$user->id)) selected @endif">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
                <script>

                </script>
            </div>
            <div class="col-12 p-2">
                <div >
                    يشمل الشحن
                </div>
                <div class="col-6 pt-3">
                    <select name="include_shipping" class="form-control" id="include_shipping">
                        <option value="0">لا</option>
                        <option value="1"@if($voucher->include_shipping == 1) selected @endif>نعم</option>
                    </select>
                </div>
                
            </div>
            <div class="col-12 p-2">
                <div class="col-12">
                    تاريخ البداية
                </div>
                <div class="col-12 pt-3">
                    <input type="date" name="starts_from" required class="form-control" value="{{ $voucher->starts_from }}">
                </div>
            </div>
            <div class="col-12 p-2">
                <div class="col-12">
                    تاريخ النهاية
                </div>
                <div class="col-12 pt-3">
                    <input type="date" name="ends_at" required class="form-control" value="{{ $voucher->ends_at }}">
                </div>
            </div>
            <input type="hidden" name="history" value="{{ $voucher->history }}>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </div>
		</form>
	</div>
</div>
@endsection