<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Category;
use App\Library\Slug;
use Image;


class CategoryController extends Controller
{
    public function index()
    {
    	$data['category_list'] = Category::all();
    	return view('admin.category.list',$data);
    }

    public function add()
    {

    	return view('admin.category.add');
    }

    public function store(Request $Request)
    {

    	$this->validate($Request, [
	        'name' 		=> 'required|unique:categories,name',
	        //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
	        'status' 	=> 'required',
	    ]
	    );

    	$imagename = '';
    	if (Input::hasFile('image')){
	        $image = $Request->file('image');
	        $imagename = mt_rand(999,999999)."_".time().".".$image->getClientOriginalExtension();

	        $destinationPath = public_path('uploads/categories');
	        $thumbPath = public_path('uploads/categories/thumbnails');

	        $img = Image::make($image->getRealPath());
	        $img->resize(100, 100, function ($constraint) {
	            $constraint->aspectRatio();
	        })->save($thumbPath.'/'.$imagename);       

	        $image->move($destinationPath, $imagename);
    	}

    	$category = new Category;
    	$slug = new Slug;

    	$category->name = $Request->name;
    	$category->slug = $slug->createSlug($Request->name,'Category');
    	$category->image = $imagename;
    	$category->status = $Request->status;
    	$category->save();

    	return redirect('admin/category');
    }

    public function edit($id)
    {
    	$data['record'] = Category::find($id);
    	return view('admin.category.edit',$data);	
    }

    public function update(Request $Request,$id)
    {
    	$category = Category::find($id);
    	$slug = new Slug;

    	$this->validate($Request, [
	        'name' => 'required|unique:categories,name,'.$id.',id',
	        'status' => 'required',
	    ]
	    );

    	$category->name = $Request->name;
    	$category->slug = $slug->createSlug($Request->name,'Category', $id);
    	$category->image = '';
    	$category->status = $Request->status;
    	$category->save();

    	return redirect('admin/category');

    }

    public function delete($id)
    {
    	Category::where('id',$id)->delete();
    	return redirect('admin/category')->with('message','Record Deleted Successfully');
    }
}
