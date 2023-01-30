@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-countries"></span> الدليل المجاني
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.directory.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            
            <li class="nav-item mx-auto" role="presentation">
              <a class="nav-link active" id="pills-companies-tab" data-bs-toggle="pill" href="#pills-companies" role="tab" aria-controls="pills-companies" aria-selected="true">شركات</a>
            </li>

            <li class="nav-item mx-auto" role="presentation">
                <a class="nav-link" id="pills-individuals-tab" data-bs-toggle="pill" href="#pills-individuals" role="tab" aria-controls="pills-individuals" aria-selected="true">الأفراد</a>
              </li>
          </ul>
        {{-- Companies --}}
        <div class="tab-pane fade show active" id="pills-companies" role="tabpanel" aria-labelledby="pills-companies-tab">

            <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-4 p-2">
                    <form method="GET">
                        <input type="text" name="q" class="form-control" placeholder="بحث ... ">
                    </form>
                </div>
            </div>
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0" style="min-width:1100px;">


                <table class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>البلد</th>
                            <th>الهاتف</th>
                            <th>الصورة</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count =1;
                        @endphp
                        @foreach($companies as $company)
                        <tr>
                            <td>{{$count++}}</td>

                            <td>{{-- json_decode($company->name,true)[app()->getLocale()]--}}</td>
                            <td>{{$company->city . " - " . $company->city->country}}</td>
                            <td>{{$company->phone}}</td>
                            <td>@if($company->img)<img src="{{$company->img}}" width="20" height="20" alt="">@endif</td>

                            <td>
                                <a href="{{route('admin.directory.edit',$company->id)}}">
                                <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                                    <span class="fas fa-wrench "></span> تحكم
                                </span>
                                </a>
                                <form method="POST" action="{{route('admin.directory.destroy',$company->id)}}" class="d-inline-block">
                                    @csrf @method("DELETE")
                                    <button class="btn btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                        <span class="fas fa-trash "></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        {{-- individuals --}}
        <div class="tab-pane fade" id="pills-individuals" role="tabpanel" aria-labelledby="pills-individuals-tab">

            <div class="col-12 py-2 px-2 row">
                <div class="col-12 col-lg-4 p-2">
                    <form method="GET">
                        <input type="text" name="q" class="form-control" placeholder="بحث ... ">
                    </form>
                </div>
            </div>
            <div class="col-12 p-3" style="overflow:auto">
                <div class="col-12 p-0" style="min-width:1100px;">


                <table class="table table-bordered  table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>البلد</th>
                            <th>الهاتف</th>
                            <th>الصورة</th>
                            <th>تحكم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $countind = 1;
                        @endphp
                        @foreach($individuals as $ind)
                        <tr>
                            <td>{{$countind++}}</td>

                            <td>{{-- json_decode($company->name,true)[app()->getLocale()]--}}</td>
                            <td>{{--$ind->city . " - " . $ind->city->country--}}</td>
                            <td>{{$ind->phone}}</td>
                            <td>@if($ind->img)<img src="{{$ind->img}}" width="20" height="20" alt="">@endif</td>

                            <td>
                                <a href="{{route('admin.directory.edit',$ind->id)}}">
                                <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                                    <span class="fas fa-wrench "></span> تحكم
                                </span>
                                </a>
                                <form method="POST" action="{{route('admin.directory.destroy',$ind->id)}}" class="d-inline-block">
                                    @csrf @method("DELETE")
                                    <button class="btn btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
                                        <span class="fas fa-trash "></span> حذف
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection