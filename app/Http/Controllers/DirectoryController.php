<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Directory;
use App\Models\City;
use App\Models\Store;
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
        $individuals = Directory::where("type",1)->get();
        return view("front.directory.Individualsindex",compact("individuals"));
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
            "img" => 'nullable|image',
            "cover" => 'nullable|image',
            "category_id" => 'nullable',
            "address" => 'nullable',
            "social" => 'nullable',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "nullable|string|max:255";
            $rules["$key.description"] = "nullable|string|max:255";
            $rules["$key.address"] = "nullable|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'] ?? null;
            $langAttr["description"][$key] = $data[$key]['description'] ?? null;
            $langAttr["address"][$key] = $data[$key]['address'] ?? null;
        }
        Validator::validate($data,$rules);
        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/public/uploads/directory',$image): "";

        $cover = $request->cover ? $request->cover->hashName() : null;
        $cover ? $request->cover->storeAs('/public/uploads/directory',$cover): "";
                
        Directory::create([
            "name"=>json_encode($langAttr["name"]),
            "description"=>json_encode($langAttr["description"]),
            "address"=>json_encode($langAttr["address"]),
            "social"=>json_encode($request["social"]),
            'img'=>$image,
            'cover'=> $cover,
            'phone'=>$request->phone,
            "city_id"=>$request->City,
            "category_id"=>$request->Category ?? null,
            "type"=>$request->type,
            "active"=>$request->active ?? 0,
            "user_id"=>$request->user_id,
            "lang"=>$request->lang
        ]);
        
        flash()->success('تم إضافة عنصر الدليل المجاني بنجاح', 'عملية ناجحة');
        return redirect()->back();
    }

    public function frontShow($id){
        $provider = Directory::findOrFail($id);
        $type = $provider->type == 1 ? "individual" : "company";
        return view("front.directory.show",compact("provider","type"));
    }

    public function edit($id){
        $provider = Directory::findOrFail($id);
        return view("admin.directory.edit",compact("provider"));
    }

    public function frontEdit($id){
        $directory = Directory::findOrFail($id);
            // Default language 
        $lang = app()->getlocale();
        $names =json_decode($directory->name,true); 
        // if Default has no value
        if($names[$lang] == null){
            foreach ($names as $name => $val) {
                if($val != null){ 
                    $lang = $name; 
                    break;
                }
            }
        }
        if($directory->type == 1){
            return view("front.directory.IndividualsEdit",compact("directory","lang"));
        }else{
            return view("front.directory.CompaniesEdit",compact("directory","lang"));
        }
    }

    public function update(Request $request,$id){
        $data = $request->all();

        $rules = [
            "phone" => 'required|numeric',
            "type" => 'required',
            "img" => 'nullable|image',
            "cover" => 'nullable|image',
            "category_id" => 'nullable',
            "address" => 'nullable',
            "social" => 'nullable',
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.name"] = "nullable|string|max:255";
            $rules["$key.description"] = "nullable|string|max:255";
            $rules["$key.address"] = "nullable|string|max:255";
            // Lang
            $langAttr["name"][$key] = $data[$key]['name'] ?? null;
            $langAttr["description"][$key] = $data[$key]['description'] ?? null;
            $langAttr["address"][$key] = $data[$key]['address'] ?? null;
        }
        Validator::validate($data,$rules);
        $image = $request->img ? $request->img->hashName() : null;
        $image ? $request->img->storeAs('/public/uploads/directory',$image): "";

        $cover = $request->cover ? $request->cover->hashName() : null;
        $cover ? $request->cover->storeAs('/public/uploads/directory',$cover): "";

        Directory::where("id",$id)->update([
            "name" => json_encode($langAttr["name"]),
            "description" => json_encode($langAttr["description"]),
            "address" => json_encode($langAttr["address"]),
            "social" => json_encode($request["social"]),
            'img'=> $image,
            'cover'=> $cover,
            'phone'=>$request->phone,
            "city_id" => $request->City,
            "type"=>$request->type,
            "active"=> $request->active ?? 0,
            "user_id" => $request->user_id
        ]);
        flash()->success('تم تعديل عنصر الدليل المجاني بنجاح', 'عملية ناجحة');
        return redirect()->back();
    }

    public function destroy($id){
        Directory::findOrFail($id)->delete();
        return redirect()->back();
    }

}
