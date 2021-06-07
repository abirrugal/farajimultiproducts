<?php

namespace App\Http\Controllers\backend\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Cloudinary;
class ChildCategoriesController extends Controller
{  
//childCategories child

public function childCategories(){
    $allcategories = Category::select('id','name', 'slug','subcategory_id','category_id')->with('child_category')->whereNotNull('subcategory_id')->latest()->paginate(10);
    return view('backend.categories.child_categories.index',['allcategories' => $allcategories]);
}

//Goto add new childCategory form page
public function newChildCategory(){

    $data['subCategories'] = Category::select('id','name', 'slug','category_id')->with('child_category')->whereNotNull('category_id')->latest()->get();
    return view('backend.categories.child_categories.new', $data);
}

// Store childCategories to the database

public function storeChildCategories(Request $request){
    $validator = Validator::make($request->all(),[
        'subcategory_id' => 'required|numeric',
        'child_category' => 'required|min:1',
        // 'child_img'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'

    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {

        if($request->hasFile('child_img') && $request->file('child_img')->isValid()){

            $child_img = $request->file('child_img');

        //    $imageName= $child_img->getClientOriginalName().random_int(2,4).'.'.$child_img->getClientOriginalExtension();

        //    $image_resize = Image::make($child_img->getRealPath());
        //    $image_resize->resize(379,304);
        //    $image_resize->save(public_path('allfiles/child_category_image/'.$imageName));

        //    $child_img->storeAs('child_category_image', $imageName);


        $resizedImage = cloudinary()->upload($child_img->getRealPath(), [
            'folder' => 'child_cat',
            'transformation' => [
                      'width' => 379,
                      'height' => 304
             ]
])->getSecurePath();      
        }

        Category::create([
            'subcategory_id' => $request->subcategory_id,
            'name' => trim( $request->child_category),
            'banner' => $resizedImage
        ]);
    } catch (Exception $e) {
        $this->errorMessage($e->getMessage());
    }
    $this->successMessage('SubCategory saved success');
    return redirect()->back();


}

//Show childCategory

public function showChildCategory($id){
    $subcategory = Category::with('parent_category')->findOrFail($id);
    return view('backend.categories.child_categories.show',['subcategory'=>$subcategory]);
}

//Goto Edit childCategory Page

public function childCategoryEdit($id){

$data['category'] = Category::select('id','name','banner')->find($id);

return view('backend.categories.child_categories.edit')->with($data);

}

//Update childCategory

public function childCategoryUpdate(Request $request, $id){
$validator = Validator::make($request->all(),[
    
    'child_category' => 'required|min:1',
    'child_img'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'

    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

try {

    if($request->hasFile('child_img') && $request->file('child_img')->isValid()){

        $child_img = $request->file('child_img');

        //    $imageName= $child_img->getClientOriginalName().random_int(2,4).'.'.$child_img->getClientOriginalExtension();

        //    $image_resize = Image::make($child_img->getRealPath());
        //    $image_resize->resize(379,304);
        //    $image_resize->save(public_path('allfiles/child_category_image/'.$imageName));

    
        $childcategory = Category::find($id);

        // if($childcategory->banner!==null && $childcategory->banner!==''){
        // unlink(public_path().'/allfiles/child_category_image/'.$childcategory->banner);
        // }

        $url = $childcategory->banner;
        preg_match("/child_cat\/(?:v\d+\/)?([^\.]+)/", $url, $matches);
        if($matches !== null){

        Cloudinary::destroy($matches[0]);
        }
        $resizedImage = cloudinary()->upload($child_img->getRealPath(), [
            'folder' => 'child_cat',
            'transformation' => [
                      'width' => 379,
                      'height' => 304
             ]
])->getSecurePath();  

        $childcategory->banner = $resizedImage;
        $childcategory->save();
    
    }

    if($request->subcategory_id !=='no_id'){
        $childcategory->subcategory_id = $request->subcategory_id;
        $childcategory->save();

    }


Category::find($id)->update([
    
    'name' => trim($request->child_category)
]);
$this->successMessage("SubCategory updated success");
return redirect()->back();
} catch (Exception $e) {
redirect()->back()->with('message', $e);
}


}

//Delete childCategory

public function childCategoryDelete(Request $request , $id){

$childcategory = Category::find($id);

$url = $childcategory->banner;
preg_match("/child_cat\/(?:v\d+\/)?([^\.]+)/", $url, $matches);
if($matches !== null){

Cloudinary::destroy($matches[0]);
}
$childcategory->delete();
// if($childcategory->banner!==null){
// $childcategory->delete();
// }
// if($childcategory->banner!==null && $childcategory->banner!==''){
// unlink(public_path().'/allfiles/child_category_image/'.$childcategory->banner);
// }
session()->flash('type','success');
session()->flash('message','SubCategory deleted success');
return redirect()->back();
}

}