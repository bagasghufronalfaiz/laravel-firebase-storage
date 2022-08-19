<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Auth\SignInResult\SignInResult;
use Kreait\Firebase\Exception\FirebaseException;
use Google\Cloud\Firestore\FirestoreClient;
use Google\Cloud\Storage\StorageObject;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asset.index', ['assets' => Asset::all()]);
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
            'asset.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:8192',
        ]);

        if ($validator->fails()) {
            return redirect('asset/add')->withErrors($validator);
        }

        foreach ($request->file('asset') as $key => $asset) {
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
        $asset = Asset::findOrFail($id);
        app('firebase.storage')->getBucket()->object($asset->name)->delete();
        $asset->delete();
        return redirect()->route('asset.index');
    }
}
