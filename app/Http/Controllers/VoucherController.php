<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        return view("admin.voucher.index",compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view("admin.voucher.create",compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            "code" => 'required',
            "amount" => 'required|numeric|between:1,100',
            "special_user" => 'required',
            "include_shipping" => 'required|boolean',
            "starts_from" => 'required|date',
            "ends_at" => 'required|date',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        Validator::validate($data,$rules);
        Voucher::create([
            "code"=>$request->code,
            "name" => json_encode($langAttr["name"]),
            'amount'=>$request->amount,
            "special_user" => $request->special_user == 0 ? 0 : implode(",",$request->users),
            "include_shipping"=>$request->include_shipping,
            "starts_from"=>$request->starts_from,
            "ends_at"=>$request->ends_at,
        ]);
        
        flash()->success('تم إضافة قسيمة الشراء بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.voucher.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::all();
        $voucher = Voucher::findOrFail($id);
        return view("admin.voucher.edit",compact('voucher',"users"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = [
            "code" => 'required',
            "amount" => 'required|numeric|between:1,100',
            "special_user" => 'required',
            "include_shipping" => 'required|boolean',
            "starts_from" => 'required|date',
            "ends_at" => 'required|date',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
        }
        Validator::validate($data,$rules);
        Voucher::where("id",$id)->update([
            "code"=>$request->code,
            "name" => json_encode($langAttr["name"]),
            'amount'=>$request->amount,
            "special_user" => $request->special_user == 0 ? 0 : implode(",",$request->users),
            "include_shipping"=>$request->include_shipping,
            "starts_from"=>$request->starts_from,
            "ends_at"=>$request->ends_at,
        ]);
        
        flash()->success('تم تعديل قسيمة الشراء بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        flash()->success('تم حذف قسيمة الشراء', 'عملية ناجحة');
        Voucher::where("id",$id)->delete();
        return redirect(route('admin.voucher.index'));
    }
}
