<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HajiUmroh\Gallery;
use App\Http\Requests\HajiUmroh\GalleryRequest;

class AdminGaleryController extends Controller
{

    protected $link = 'admin/galerry/';
    
    public function __construct()
    {
        $this->setLink($this->link);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $record = Gallery::with('creator')->get();
        return $this->render('backend.dashboard.galerry-keagamaan.index',[
            'record' => $record,
            'active' => 'galerry'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->render('backend.dashboard.galerry-keagamaan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $this->validate($request, [
            'attachment.*' => 'required',
            'attachment.*'=>'max:5120',
            'attachment.*' => 'image|mimes:jpg,png,jpeg',
            "attachment.*"=>"mimes:jpg,png,jpeg,gif"
        ],[
          'attachment.*.max' => 'Gambar tidak boleh lebih dari 5 MB',
          'attachment.*.mimes' => 'File Harus Berupa png, jpg, jpeg, gif',
          'attachment.*.dimensions' => 'Ukuran Kurang Gambar Harus 1070 X 490',
        ]);
        try {
            $data = Gallery::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true,
          'url' => $this->link
          
        ]);
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
        return $this->render('backend.dashboard.galerry-keagamaan.edit',[
            'record' => Gallery::find($id)
        ]);
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
        $c = $request->path;
        try {
        if($request->file){
            $path = $request->file->store('uploads/gallery', 'public');
            $request->path = $path;
            // dd(['before' => $c, 'after' => $request->path]);
        }
        $data = Gallery::saveData($request);
        }catch (\Exception $e) {
        return response([
        'status' => 'error',
        'message' => 'An error occurred!',
        ], 500);
    }

    return response([
        'status' => true,
        'url' => $this->link
    ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Gallery::destroy($id);
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => 'An error occurred!',
            ], 500);
          }
      
          return response([
            'status' => true,
            'url' => 'asdas'
          ]);
    }
}
