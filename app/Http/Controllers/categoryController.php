<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class categoryController extends Controller
{
    public function index(){

        return view('admin.All_category.index');
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
}
