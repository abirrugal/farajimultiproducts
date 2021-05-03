<?php

namespace App\Http\Controllers\backend\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class CategoriesController extends Controller
{

//Categories list

    public function categories(){
        $allcategories = Category::with('child_category')->where('category_id', null)->whereNull('subcategory_id')->latest()->paginate(10);
        return view('backend.categories.categories',['allcategories'=>$allcategories]);
    }

//Goto add new Category form page
    public function newCategory(){
        return view('backend.categories.new');
    }

// Store Categories to the database

    public function storeCategories(Request $request){

        $validator = Validator::make($request->all(),[
            'category' => 'required|min:1',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5000'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            if($request->hasFile('image') && $request->file('image')->isValid()){

                $image = $request->file('image');

               $imageName= $image->getClientOriginalName();

               $image_resize = Image::make($image->getRealPath());
               $image_resize->resize(379,304);
               $image_resize->save(public_path('images/'.$imageName));
               
            //    $image->storeAs('category_image', $imageName);
            }

            Category::create([
            
                'name' => trim( $request->category),
                'banner' => $imageName
            ]);
        } catch (Exception $e) {
            $this->errorMessage($e->getMessage());
        }
        $this->successMessage('Category successfully created');
        return redirect()->back();
   

    }

//Show Category details

public function categoryShow($id){
  $category = Category::findOrFail($id);
   return view('backend.categories.show',['category' => $category]);
}

//Goto Edit Category Page

public function categoryEdit($id){

    $data['category'] = Category::find($id);

    return view('backend.categories.edit')->with($data);

}

//Update Category

public function categoryUpdate(Request $request, $id){
    $validator = Validator::make($request->all(),[
        'category' => 'required|min:1',
        'image'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000'

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

try {

    if($request->hasFile('image') && $request->file('image')->isValid()){
    
        $image = $request->file('image');
    
        $imageName= $image->getClientOriginalName().Str::random(5).'.'.$image->getClientOriginalExtension();
        $image->storeAs('category_image', $imageName);
    
        $category = Category::find($id);
        if($category->banner !==null){
            unlink(public_path().'/allfiles/category_image/'.$category->banner);
        }
        $category->banner = $imageName;
        $category->save();
    
    }
    
        Category::find($id)->update([
    
            'name' => trim($request->category)
        ]);
    $this->successMessage("Category successfully updated");
    return redirect()->back();
} catch (Exception $e) {
    redirect()->back()->with('message', $e);
}


}




    //Delete Category

public function categoryDelete($id){
    
   $category = Category::find($id);

   $category->delete();
   if(isset($category->banner)){
   unlink(public_path().'/allfiles/category_image/'.$category->banner);
  }
   session()->flash('type','success');
   session()->flash('message','Category successfully deleted');
   return redirect()->back();
    
}




  
}
