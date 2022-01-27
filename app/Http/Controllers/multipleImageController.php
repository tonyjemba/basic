<?php

namespace App\Http\Controllers;

use App\Models\MutipleImage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Image;

class multipleImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $images = MutipleImage::all();
        return view('admin.mutipleImage.index', compact('images'));
    }

    public function add(Request $request)
    {
        $request->validate(
            [
                'images' => 'required|mimes:jpg,jpeg,png,jfif|max:5048',
            ],

        );

        $images = $request->file('image');
        dd($request);

        foreach ($images as $image) {
            //generate a unique name for the uploded image
            $randomid = hexdec(uniqid());
            $imageExtension = $image->guessExtension();
            $randomImageName = time() . '_' . $randomid . '.' . $imageExtension;
            $imageurl = 'images/brands/mutiple' . $randomImageName;


            Image::make($image)->resize(300, 300)->save($imageurl);


            //insert the image name and path/url in the database 

            MutipleImage::insert([
                'images' => $imageurl,

            ]);
        }





        // return Redirect()->back()->with('success', 'images added sucessfully');
    }

}
