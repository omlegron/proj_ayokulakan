<?php

namespace App\Http\Controllers\BackEnd\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Roles;
use App\Models\UserProfile;
use App\Http\Requests\Master\UserProfileRequest;

use DataTables;
use Zipper;
use Carbon\Carbon;

class UserProfileController extends Controller
{
  //
  protected $link = 'profile-user';

  function __construct()
  {
    $this->setLink($this->link);
    $this->setTitle("Profile User");
    // $this->setGroup("Master");
    // $this->setSubGroup("Aplikasi");
    $this->setModalSize("lg");
    $this->setBreadcrumb(['Profile User' => 'profile-user']);

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
        'data' => 'alamat',
        'name' => 'alamat',
        'label' => 'Alamat',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_negara',
        'name' => 'id_negara',
        'label' => 'Negara',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_provinsi',
        'name' => 'id_provinsi',
        'label' => 'Provinsi',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_kota',
        'name' => 'id_kota',
        'label' => 'Kota',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'id_kecamatan',
        'name' => 'id_kecamatan',
        'label' => 'Kecamatan',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
        'className' => "text-center text-nowrap",

      ],
      [
        'data' => 'status',
        'name' => 'status',
        'label' => 'Status',
        'searchable' => false,
        'sortable' => true,
        'width' => '20%',
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
    $records = UserProfile::with('creator')->select('*');
    // dd($records);
    //Init Sort
    if (!isset(request()->order[0]['column'])) {
      // $records->->sort();
      $records->orderBy('created_at', 'desc');
    }
    //Filters
    if ($name = $request->nama) {
      $records->where('judul', 'like', '%'.$name.'%' );
    }
    //Filters
    return Datatables::of($records)
    ->addColumn('num', function ($record) use ($request) {
      return $request->get('start');
    })
    ->addColumn('alamat', function ($record) {
        return '<span class="ccount more" data-ccount="80">'.readMoreText(strip_tags($record->alamat),150).'</span>';
    })
    ->addColumn('id_negara', function ($record) use ($request) {
      return ($record->negara) ? $record->negara->negara : '-';
    })
    ->addColumn('id_provinsi', function ($record) use ($request) {
      return ($record->provinsi) ? $record->provinsi->provinsi : '-';
    })
    ->addColumn('id_kota', function ($record) use ($request) {
      return ($record->kota) ? $record->kota->kota : '-';
    })
    ->addColumn('id_kecamatan', function ($record) use ($request) {
      return ($record->kecamatan) ? $record->kecamatan->kecamatan : '-';
    })
    ->addColumn('created_at', function ($record) {
      return $record->creationDate();
    })
    ->addColumn('created_by', function ($record) {
      return $record->creatorName();
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
    ->rawColumns(['action','alamat'])
    ->make(true);
  }

  public function index()
  {
    return $this->render('backend.profile.index-user', [
      'mockup' => false,
    ]);
  }

  public function create()
  {
    return $this->render('backend.profile.create');
  }

  public function store(Request $request)
  {
    $this->validate($request,[
      'id_negara' => 'required',
      'id_provinsi' => 'required',
      'id_kota' => 'required',
      'id_kecamatan' => 'required',
      'kode_pos' => 'required',
      'alamat' => 'required',
    ]);
    try {
        
        if($request->status == 'Alamat Utama'){
          $data2 = UserProfile::where('created_by',auth()->user()->id)->update([
            'status' => 'Batalkan Alamat'
          ]);
          $data = UserProfile::saveData($request);
          $data->creator()->update([
            'id_negara' => $request->id_negara,
            'id_provinsi' => $request->id_provinsi,
            'id_kota' => $request->id_kota,
            'id_kecamatan' => $request->id_kecamatan,
            'alamat' => $request->alamat,
            'kode_pos' => $request->kode_pos,
          ]);
        }else{
          $data = UserProfile::saveData($request);
        }
    }catch (\Exception $e) {
      return response([
        'status' => 'error',
        'message' => $e,
      ], 500);
    }

    return response([
      'status' => true,
      'url' => 'asdas'
      
    ]);
  }

  public function edit($id)
  {
    return $this->render('backend.profile.edit',[
        'record' => UserProfile::find($id),
    ]);
  }

  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'id_negara' => 'required',
      'id_provinsi' => 'required',
      'id_kota' => 'required',
      'id_kecamatan' => 'required',
      'kode_pos' => 'required',
      'alamat' => 'required',
    ]);
    try {
      $data = UserProfile::saveData($request);
      if($request->status == 'Alamat Utama'){
        $data2 = UserProfile::where('created_by',auth()->user()->id)->update([
          'status' => 'Batalkan Alamat'
        ]);
        $data = UserProfile::saveData($request);
        $data->creator()->update([
          'id_negara' => $request->id_negara,
          'id_provinsi' => $request->id_provinsi,
          'id_kota' => $request->id_kota,
          'id_kecamatan' => $request->id_kecamatan,
          'alamat' => $request->alamat,
          'kode_pos' => $request->kode_pos,
        ]);
      }else{
        $data = UserProfile::saveData($request);
      }
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

  public function show($id)
  {
    // dd($id);
    return $this->render('backend.profile.show',[
        'record' => UserProfile::find($id),
    ]);
  }

  public function destroy(Request $request, $id)
  {
    try {
      UserProfile::destroy($id);
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
