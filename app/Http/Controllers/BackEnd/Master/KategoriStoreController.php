<?php

namespace App\Http\Controllers\BackEnd\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\KategoriStore;
use Illuminate\Http\Request;
use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use DataTables;
use Zipper;
class KategoriStoreController extends Controller
{
    protected $link = 'master/store/kategori-store/';
    public function __construct()
    {
         // $this->middleware('roleAdministration');
        $this->setLink($this->link);
        $this->setTitle("Kategori Store");
        $this->setGroup("Master");
        $this->setSubGroup("Store");
        $this->setModalSize("lg");
        $this->setBreadcrumb(['Master' => '#', 'Store' => '#' , 'Kategori store' => 'master/store/kategori-store/']);

        // Header Grid Datatable
        $this->setTableStruct([
        [
            'data' => 'num',
            'name' => 'num',
            'label' => '#',
            'orderable' => false,
            'searchable' => false,
            'className' => "text-center text-nowrap",
            'width' => '40px',
        ],
        /* --------------------------- */
        [
            'data' => 'nama',
            'name' => 'nama',
            'label' => 'Nama Kategori Store',
            'searchable' => false,
            'sortable' => true,
            'width' => '20%',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'img',
            'name' => 'img',
            'label' => 'Icon',
            'searchable' => false,
            'sortable' => true,
            'width' => '100px',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'created_by',
            'name' => 'created_by',
            'label' => 'Created By',
            'searchable' => false,
            'sortable' => true,
            'width' => '100px',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'created_at',
            'name' => 'created_at',
            'label' => 'Created At',
            'searchable' => false,
            'sortable' => true,
            'width' => '100px',
            'className' => "text-center text-nowrap",

        ],
        [
            'data' => 'action',
            'name' => 'action',
            'label' => 'Aksi',
            'searchable' => false,
            'sortable' => false,
            'width' => '100px',
            'className' => "text-center text-nowrap",

        ]
        ]);
    }
    public function grid(Request $request)
    {
        $records = KategoriStore::with('creator')->select('*');
        // dd($records);
        //Init Sort
        if (!isset(request()->order[0]['column'])) {
        // $records->->sort();
        $records->orderBy('created_at', 'desc');
        }
        //Filters
        if ($name = $request->nama) {
        $records->where('kat_nama', 'like', '%'.$name.'%' );
        }
        //Filters
        return Datatables::of($records)
        ->addColumn('num', function ($record) use ($request) {
        return $request->get('start');
        })

        ->addColumn('created_at', function ($record) {
        return $record->creationDate();
        })
        ->addColumn('created_by', function ($record) {
        return $record->creatorName();
        })
        ->addColumn('img', function ($record) {
        $gambar = ($record->attachments) ? imgExist(asset('storage/'.$record->attachments->url)) : asset('img/no-images.png');
        $img = '';
        $img .= '<img src="'.$gambar.'" width="50">';
        return $img;
        })
        ->addColumn('action', function ($record) {
        $btn = '';
        //Edit
            $btn .= $this->makeButton([
            'type' => 'edit',
            'tooltip' => 'Ubah Data',
            'id'   => $record->id
            ]);
            // Delete
            $btn .= $this->makeButton([
            'type' => 'delete',
            'id'   => $record->id
            ]);

        return $btn;
        })
        ->rawColumns(['action','img'])
        ->make(true);
    }
    
    public function index()
    {
        return $this->render('backend.master.kategori-store.index', [
            'mockup' => false,
        ]);
    }

    
    public function create()
    {
        return $this->render('backend.master.kategori-store.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        try {
            $request['nama'] = $request->nama;
            $data = KategoriStore::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => $e,
          ], 500);
        }
    
        return response([
          'status' => true
        ]);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        return $this->render('backend.master.kategori-store.edit',[
            'record' => KategoriStore::find($id),
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ]);
        // if ($request->hasFile('image')) {
        //  $image =  $request->file('image')->store('kategori');
        // }
        // KategoriBarang::where('id',$id)->update(
        //   [
        //     'nama' => $request->nama,
        //     'image' => $image
        //   ]);
        //   return redirect()->back();
        
        try {
           $data = KategoriStore::saveData($request);
        }catch (\Exception $e) {
          return response([
            'status' => 'error',
            'message' => 'An error occurred!',
          ], 500);
        }
    
        return response([
          'status' => true
        ]);
    }

    
    public function destroy($id)
    {
        try {
            KategoriStore::destroy($id);
          }catch (\Exception $e) {
            return response([
              'status' => 'error',
              'message' => 'An error occurred!',
            ], 500);
          }
      
          return response([
            'status' => true
          ]);
    }
}
