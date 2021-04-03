<?php

namespace App\Http\Controllers\backend\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

//Categories list

    public function categories(){
        $allcategories = Category::with('child_category')->where('category_id', null)->paginate(10);
        return view('backend.categories.categories',['allcategories'=>$allcategories]);
    }

//Goto add new Category form page
    public function newCategory(){
        return view('backend.categories.new');
    }

// Store Categories to the database

    public function storeCategories(Request $request){

        $validator = Validator::make($request->all(),[
            'category' => 'required|min:1'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            Category::create([
            
                'name' => trim( $request->category),
            ]);
        } catch (Exception $e) {
            $this->errorMessage($e->getMessage());
        }
        $this->successMessage('Category saved success');
        return redirect()->back();
   

    }

//Show Category details

public function categoryShow($id){
  $category = Category::findOrFail($id);
   return view('backend.categories.show',['category' => $category]);
}

//Goto Edit Category Page

public function categoryEdit(Request $request, $id){

    $data['category'] = Category::select('id','name')->find($id);

    return view('backend.categories.edit')->with($data);

}

//Update Category

public function categoryUpdate(Request $request, $id){
    $validator = Validator::make($request->all(),[
        'category' => 'required|min:1'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

try {
    Category::find($id)->update([

        'name' => trim($request->category)
    ]);
    $this->successMessage("Category updated success");
    return redirect()->back();
} catch (Exception $e) {
    redirect()->back()->with('message', $e);
}


}

//Delete Category

public function categoryDelete(Request $request , $id){
    
   $category = Category::find($id);

   $category->delete();

   session()->flash('type','success');
   session()->flash('message','Category deleted success');
   return redirect()->back();
    
}




  
}
