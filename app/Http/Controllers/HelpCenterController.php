<?php

namespace App\Http\Controllers;

use App\Models\HelpCenter;
use App\Http\Requests\StoreHelpCenterRequest;
use App\Http\Requests\UpdateHelpCenterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class HelpCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frontIndex()
    {
        $videos = HelpCenter::where("hidden",1)->paginate(); // 
        return view("front.helpCenter.index",compact("videos"));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = HelpCenter::paginate();
        return view("admin.helpCenter.index",compact("videos"));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = HelpCenter::get('vid_category');
        return view('admin.helpCenter.create',compact('categories'));
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
            "link" => 'required|mimes:mp4,qt|max:10240',
            "hidden" => "required|in:0,1"
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.title"] = "required|string|max:255";
            // Lang
            $langAttr["title"][$key] = $data[$key]['title'];
            $langAttr["subtitle"][$key] = $data[$key]['subtitle'];
        }
        Validator::validate($data,$rules);
        $path = $request->file('link')->store("uploads/helpCenter");
        HelpCenter::create([
            "vid_category"=>$request->vid_category,
            'link'=>$path,
            "title"=>json_encode($langAttr["title"]),
            "subtitle"=>json_encode($langAttr["subtitle"]),
            "hidden"=>$request->hidden,
        ]);
        
        flash()->success('تم إضافة عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function show(HelpCenter $helpCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function edit(HelpCenter $helpCenter)
    {
        $categories = $helpCenter->get('vid_category');
        return view('admin.helpCenter.edit',compact("helpCenter","categories"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HelpCenter $helpCenter)
    {
        $data = $request->all();
        $rules = [
            "link" => 'sometimes|required|mimes:mp4,qt|max:10240',
            "hidden" => "required|in:0,1"
        ];
        foreach (config("laravellocalization.supportedLocales") as $key => $lang) {
            // Rules
            $rules["$key.title"] = "required|string|max:255";
            // Lang
            $langAttr["title"][$key] = $data[$key]['title'];
            $langAttr["subtitle"][$key] = $data[$key]['subtitle'];
        }
        Validator::validate($data,$rules);
        
        if($request->link){
            $path = $request->file('link')->store("uploads/helpCenter");
        }
        
        HelpCenter::where("id",$helpCenter->id)->update([
            "vid_category"=>$request->vid_category,
            "title"=>json_encode($langAttr["title"]),
            "link" => $path ?? $helpCenter->link,
            "subtitle"=>json_encode($langAttr["subtitle"]),
            "hidden"=>$request->hidden,
        ]);
        
        flash()->success('تم تعديل عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HelpCenter  $helpCenter
     * @return \Illuminate\Http\Response
     */
    public function destroy(HelpCenter $helpCenter)
    {
        HelpCenter::where("id",$helpCenter->id)->delete();
        flash()->success('تم حذف عنصر مركز المساعدة بنجاح', 'عملية ناجحة');
        return redirect()->route('admin.help-center.index');
    }
}
