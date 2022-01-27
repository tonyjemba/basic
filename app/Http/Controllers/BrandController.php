<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $brands = Brands::latest()->paginate(5);
        return view('admin.All_Brand.index', compact('brands'));
    }

    public function addBrand(Request $request){

       // dd($request->all()); see the entire request
         $request->validate([
            'brand_name' => 'required|unique:brands|max:10',
            'brand_image' => 'required|mimes:jpg,jpeg,png,jfif|max:5048',
        ],
        [
            'brand_name.required' => 'Please add the brand name',
            'brand_name.max' => 'Should not exceed 10 characters'
        ]
    );

    $image =$request->file('brand_image');

    //generate a unique name for the uploded image
    $randomid= hexdec(uniqid());
    $imageExtension = $image->guessExtension();
    $randomImageName= time().'_'.$randomid.'.'.$imageExtension;
    $imageurl='images/brands/'.$randomImageName;

    //normal way
    //$image->move(public_path('images/brands'),$randomImageName);

    //using the image intervention package
    Image::make($image)->resize(300,200)->save($imageurl);

 
    //insert the image name and path/url in the database 

    Brands::insert([
        'brand_name' => $request->brand_name,
        'brand_image' => $imageurl,
        'created_at' => Carbon::now()

    ]);
   
        return Redirect()->back()->with('success','Brand added sucessfully');
    }


    public function edit($id){

        $brands = Brands::find($id);

        return view('admin.All_Brand.edit', compact('brands'));

    }


    public function update(Request $request, $id){

        // dd($request->all()); see the entire request
        $request->validate([
            'brand_name' => 'required|max:10',
        ],
        [
            'brand_name.required' => 'Please add the brand name',
            'brand_name.max' => 'Should not exceed 10 characters'
        ]
    );

    $image =$request->file('brand_image');
    $old_image=$request->old_image;


    if($image){
         //generate a unique name for the uploded image
    $randomid= hexdec(uniqid());
    $imageExtension = $image->guessExtension();
    $randomImageName= time().'_'.$randomid.'.'.$imageExtension;
    $imageurl='images/brands/'.$randomImageName;

    $image->move(public_path('images/brands'),$randomImageName);

    //repace old image with new one
    unlink($old_image);
    Brands::find($id)->update([
        'brand_name' => $request->brand_name,
        'brand_image' => $imageurl,
        'created_at' => Carbon::now()

    ]);
 
    return Redirect()->back()->with('success','Brand updated sucessfully');

    }else{

        Brands::find($id)->update([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()
    
        ]);
     
        return Redirect()->back()->with('success','Brand updated sucessfully');

    }
   

    }

    public function delete($id){

        //Delete it from the database too
        $image2delete = Brands::find($id)->brand_image;
        unlink($image2delete);


         Brands::find($id)->delete();

        return Redirect()->back()->with('success','Brand deleted sucessfully');

    }
}
