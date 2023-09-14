<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Intervention\Image\Facades\Image;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $about = About::all();
    	return view('about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $about = About::findOrFail($id);
    	return view('about.edit',compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $about_id = $request->id;

    	if ($request->file('logo')) {

    		$image = $request->file('logo'); 
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(512,512)->save('upload/about/'.$name_gen);
            $save_url = 'upload/about/'.$name_gen;

            About::findOrFail($about_id)->update([

                'alamat' => $request->alamat,
                'telepon' => $request->telepon,
                'email' => $request->email,
                'logo' => $save_url,
            ]);

    	 $notification = array(
    		'message' => 'About berhasil diperbarui',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('about.index')->with($notification);
    		 

    	}else{

    		About::findOrFail($about_id)->update([

    		'alamat' => $request->alamat,
    		'telepon' => $request->telepon,
    		'email' => $request->email,
    		 
    	]);

    	 $notification = array(
    		'message' => 'About berhasil diperbarui tanpa gambar',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('about.index')->with($notification);
    	}
    }

}
