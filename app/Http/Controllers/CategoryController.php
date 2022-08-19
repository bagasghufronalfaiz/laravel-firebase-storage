<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Category;
use app\Models\Asset;

class CategoryController extends Controller
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
//         - category_name
// - category_slug
// - asset_id
// - created_at
// - updated_a

// asset--
// 'name',
// 'path',
// 'size',
// 'created_at',
// 'updated_at',
        $image = $request->file('image');
        $image->storeAs('public/image', $image->hashName());

        $asset = Asset::create([
            // 'name' => $image->getClientOriginalName(),
            'name' => $image->hashName(),
            'path' => 'public/image' . $image->hashName(),
            'size' => $image->getSize(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category)));

        // dd($slug);

        Category::create([
            'image'             => $image->hashName(),
            'category_name'     => $request->title,
            'content'           => $request->content
            
        ]);

        // dd($file);
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
