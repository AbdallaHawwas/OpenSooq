<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Directory;
use App\Models\City;
use Illuminate\Support\Facades\Validator;

class DirectoryController extends Controller
{
    public function index(){
        $individuals = Directory::where("type","1")->get();
        $companies = Directory::where("type","2")->get();
        $cities = City::all();
        return view("admin.directory.index",compact("individuals","companies","cities"));
    }

    public function frontCompaniesIndex(){
        $companies = Directory::where("type",2)->get();
        return view("front.directory.Companiesindex",compact("companies"));
    }
    
    public function frontIndividualsIndex(){
        $Individuals = Directory::where("type",1);
        return view("front.directory.Individualsindex",compact("Individuals"));
    }

    public function create(){
        return view("admin.directory.create");
    }

    public function frontCompaniesCreate(){
        return view("front.directory.CompaniesCreate");
    }
    
    public function frontIndividualsCreate(){
        return view("front.directory.IndividualsCreate");
    }

    public function store(Request $request){
        $data = $request->all();

        $rules = [
            "phone" => 'required|numeric',
            "type" => 'required',
            "img" => 'nullable|image'
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            $rules["$key.description"] = "required|string|max:255";
            $rules["$key.address"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
            $langAttr["description"][$key] = $data[$key]['description'];
            $langAttr["address"][$key] = $data[$key]['address'];
        }
        Validator::validate($data,$rules);
        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/storage/uploads/directory',$image): "";

        Directory::create([
            "name" => json_encode($langAttr["name"]),
            "description" => json_encode($langAttr["description"]),
            "address" => json_encode($langAttr["address"]),
            'img'=> $image,
            'phone'=>$request->phone,
            "city" => $request->City,
            "type"=>$request->type
        ]);
        
        flash()->success('تم إضافة عنصر الدليل المجاني بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.directory.index');
    }

    public function frontShow($id){
        $provider = Directory::findOrFail($id);
        $type = $provider->type == 1 ? "individual" : "company";
        return view("front.directory.show",compact("provider,type"));
    }

    public function edit($id){
        $provider = Directory::findOrFail($id);
        return view("admin.directory.edit",compact("provider"));
    }

    public function frontEdit($id){
        $provider = Directory::findOrFail($id);
        return view("front.directory.edit",compact("provider"));
    }

    public function update(Request $request,$id){
        $data = $request->all();

        $rules = [
            "phone" => 'required|numeric',
            "type" => 'required',
            "img" => 'nullable|image'
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "required|string|max:255";
            $rules["$key.description"] = "required|string|max:255";
            $rules["$key.address"] = "required|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'];
            $langAttr["description"][$key] = $data[$key]['description'];
            $langAttr["address"][$key] = $data[$key]['address'];
        }
        Validator::validate($data,$rules);
        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/storage/uploads/directory',$image): "";

        Directory::where("id",$id)->update([
            "name" => json_encode($langAttr["name"]),
            "description" => json_encode($langAttr["description"]),
            "address" => json_encode($langAttr["address"]),
            'img'=> $image,
            'phone'=>$request->phone,
            "city" => $request->City,
            "type"=>$request->type
        ]);
        flash()->success('تم تعديل عنصر الدليل المجاني بنجاح', 'عملية ناجحة');
        return redirect()->back();
    }

    public function destroy($id){
        Directory::findOrFail($id)->delete();
        return redirect()->back();
    }

}
