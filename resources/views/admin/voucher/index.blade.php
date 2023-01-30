@extends('layouts.admin')
@section('content')

<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">

		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-countries"></span> قسائم الشراء
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.voucher.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

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
						<th>اسم القسيمة</th>
						<th>الكود</th>
						<th>قيمة الخصم</th>
						<th>القادرون علي استخدامه</th>
						<th>يشمل الشحن</th>
						<th>البداية</th>
						<th>النهاية</th>
						<th>عدد المسخدمون</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
                    @php $counter= 1; @endphp
					@foreach($vouchers as $voucher)
					<tr>
                        <td>{{$counter++}}</td>
                        <td>{{json_decode($voucher->name,true)['ar'] }}</td>
                        <td>{{$voucher->code}}</td>
                        <td>{{$voucher->amount}}</td>
                        <td>{{$voucher->special_user  == 0 ? "الجميع" : "مخصص"}}</td>
                        <td>{{$voucher->include_shipping == 0 ? "لا" : "نعم"}}</td>
                        <td>{{$voucher->starts_from}}</td>
                        <td>{{$voucher->ends_at}}</td>
                        <td>{{count(json_decode($voucher->history))}}</td>
						<td>
							<a href="{{route('admin.voucher.edit',$voucher->id)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
							</a>
							<form method="POST" action="{{route('admin.voucher.destroy',$voucher->id)}}" class="d-inline-block">
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
@endsection