<?php

namespace App\Http\Controllers\backend\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoriesController extends Controller
{
    
//SubCategories list

public function subCategories(){
    $subcategories = Category::with('parent_category')->whereNotNull('category_id')->paginate(10);
    return view('backend.categories.sub_categories.sub_categories',['subcategories' => $subcategories]);
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
        'sub_category' => 'required|min:1'
    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        Category::create([
            'category_id' => $request->category_id,
            'name' => trim( $request->sub_category),
        ]);
    } catch (Exception $e) {
        $this->errorMessage($e->getMessage());
    }
    $this->successMessage('SubCategory saved success');
    return redirect()->back();


}

//Goto Edit SubCategory Page

public function subCategoryEdit($id){

$data['category'] = Category::select('id','name')->find($id);

return view('backend.categories.sub_categories.sub_edit')->with($data);

}

//Update SubCategory

public function subCategoryUpdate(Request $request, $id){
$validator = Validator::make($request->all(),[
    'category_id' => 'required|numeric',
    'sub_category' => 'required|min:1'
    ]);

    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }

try {
Category::find($id)->update([
    'category_id' => $request->category_id,
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

session()->flash('type','success');
session()->flash('message','SubCategory deleted success');
return redirect()->back();

}

}
