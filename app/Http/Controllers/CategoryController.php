<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Asset;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', ['categories' => Category::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $asset = $request->file('image');
        $assetName = date('YmdHis') . '.' . $asset->getClientOriginalExtension();
        $assetSize = $asset->getSize();
        $localPath =  public_path('image/');
        if ($asset->move($localPath, $assetName)) {
            $uploadedfile = fopen($localPath . $assetName, 'r');
            app('firebase.storage')->getBucket()->upload($uploadedfile, ['name' => $assetName]);
            unlink($localPath . $assetName);
        }
        $url = "https://firebasestorage.googleapis.com/v0/b/" . env('FIREBASE_PROJECT_ID') . ".appspot.com/o/" . $assetName . "?alt=media";
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category)));

        $inputedAsset = Asset::create([
            'name' => $assetName,
            'path' => $url,
            'size' => $assetSize,
        ]);

        Category::create([
            'category_name' => $request->category,
            'category_slug' => $slug,
            'asset_id'      => $inputedAsset->id,

        ]);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('category_slug', $slug)->first();
        if (empty($category)) {
          abort(404);
        }
        return view('category.detail', ['category' => $category]);
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
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}
