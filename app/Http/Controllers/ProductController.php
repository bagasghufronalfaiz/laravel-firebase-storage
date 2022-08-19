<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.add', ['assets' => Asset::all()]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|unique:App\Models\Category,category_name|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category.add')->withErrors($validator);
        }

        if ($request->file('asset')) {
            // foreach ($request->file('asset') as $key => $asset) {
                $asset = $request->file('asset');
                $assetName = date('YmdHis') . '.' . $asset->getClientOriginalExtension();
                $assetSize = $asset->getSize();
                $localPath =  public_path('image/');
                if ($asset->move($localPath, $assetName)) {
                    $uploadedfile = fopen($localPath . $assetName, 'r');
                    app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $assetName]);
                    unlink($localPath . $assetName);
                }
                $url = "https://firebasestorage.googleapis.com/v0/b/" . env('FIREBASE_PROJECT_ID') . ".appspot.com/o/" . $assetName . "?alt=media";

                Asset::create([
                    'name' => $assetName,
                    'path' => $url,
                    'size' => $assetSize,
                ]);
            // }
        }
        return redirect()->route('asset.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
