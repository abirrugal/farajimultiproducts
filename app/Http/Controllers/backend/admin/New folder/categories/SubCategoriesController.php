<?php

namespace App\Http\Controllers\backend\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SubCategoriesController extends Controller
{
    
//SubCategories list

public function subCategories(){
    $allcategories = Category::select('id','name', 'slug','category_id','subcategory_id')->with('child_category')->whereNotNull('category_id')->latest()->paginate(10);
    return view('backend.categories.sub_categories.sub_categories',['allcategories' => $allcategories]);
}

//Goto add new SubCategory form page
public function newsubCategory(){

    $data['categories'] = Category::with('parent_category')->where('category_id', null)->get();
    return view('backend.categories.sub_categories.sub_new', $data);
}

// Store Categories to the database

public function storesubCategories(Request $request){

    $validator = Validator::make($request->all(),[
        'category_id' => 'required|numeric',
        'sub_category' => 'required|min:1',
        'sub_img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'

    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {


        if($request->hasFile('sub_img') && $request->file('sub_img')->isValid()){

            $sub_img = $request->file('sub_img');

           $imageName= $sub_img->getClientOriginalName().random_int(2,4).'.'.$sub_img->getClientOriginalExtension();
           $sub_img->storeAs('sub_category_image', $imageName);
        }

        Category::create([
            'category_id' => $request->category_id,
            'name' => trim( $request->sub_category),
            'banner' => $imageName

        ]);
    } catch (Exception $e) {
        $this->errorMessage($e->getMessage());
    }
    $this->successMessage('SubCategory saved success');
    return redirect()->back();


}

//Show SubCategory

public function showSubCategory($id){
    $subcategory = Category::with('parent_category')->findOrFail($id);
    return view('backend.categories.sub_categories.sub_show',['subcategory'=>$subcategory]);
}

//Goto Edit SubCategory Page

public function subCategoryEdit($id){

$data['category'] = Category::select('id','name','banner')->find($id);

return view('backend.categories.sub_categories.sub_edit')->with($data);

}

//Update SubCategory

public function subCategoryUpdate(Request $request, $id){
$validator = Validator::make($request->all(),[
    
    'sub_category' => 'required|min:1'
    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

try {

    if($request->hasFile('sub_img') && $request->file('sub_img')->isValid()){
    
        $sub_img = $request->file('sub_img');
    
        $imageName= $sub_img->getClientOriginalName().Str::random(5).'.'.$sub_img->getClientOriginalExtension();
        $sub_img->storeAs('sub_category_image', $imageName);
    
        $sub_category = Category::find($id);
        if($sub_category->banner !==null){
            unlink(public_path().'/allfiles/sub_category_image/'.$sub_category->banner);
        }
        $sub_category->banner = $imageName;
        $sub_category->save();
        
    }
 

Category::find($id)->update([

    'name' => trim($request->sub_category)
]);
$this->successMessage("SubCategory updated success");
return redirect()->back();
} catch (Exception $e) {
redirect()->back()->with('message', $e);
}


}

//Delete SubCategory

public function subCategoryDelete(Request $request , $id){

$subcategory = Category::find($id);

$subcategory->delete();
if($subcategory->banner!==null){
unlink(public_path().'/allfiles/sub_category_image/'.$subcategory->banner);
}
session()->flash('type','success');
session()->flash('message','SubCategory deleted success');
return redirect()->back();

}

}
