<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->paginate(5);
        //Using query builder
        //$categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.All_category.index',compact('categories'));
    }

    public function addCat(Request $request){

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please add the category name',
            'category_name.max' => 'Should not exceed 255 characters'
        ]
    );

    Category::insert([
        'category_name'=> $request->category_name,
        'user_id'=> Auth::user()->id,
        'created_at'=> Carbon::now()
    ]);

    return redirect()->back()->with('success','Category inserted Successfully');

    }

    public function edit($id){
        
            $category = Category::find($id);

        return view('admin.All_category.edit', compact('category'));
    }

    public function update(Request $request, $id){

        $update = Category::find($id)->update(['category_name' => $request->category_name,'user_id'=>Auth::user()->id]);

        return redirect()->route('all.category')->with('success','Category updated Successfully');

    }
}
