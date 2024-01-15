<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use function App\Providers\generateDatatableColumn;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = User::select('id','kodepegawai','nama')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group btn-group-sm">';
                    $btn .= '<button onclick="hapus('.$row->id.')" class="btn btn-danger btn-delete" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>';
                    $btn .= '<button onclick="edit('.$row->id.')" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $datatable['route'] = route('user.index');
        $datatable['column'] = generateDatatableColumn(array('DT_RowIndex',['action',false],'kodepegawai','nama'));
        return view('user', compact('datatable'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|string|max:100',
            'kodepegawai'=> 'required|numeric|unique:App\Models\User,kodepegawai',
            'password'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $users = new User();
        $users->role = 'user';
        $users->nama = $request->nama;
        $users->kodepegawai = $request->kodepegawai;
        $users->password = bcrypt($request->password);
        if($users->save()){
            return redirect('user/')->with('success',array('message'=>'Data tersimpan'));
        }else{
            return back()->with('error',array('response'=>'Data tersimpan'));
        }
    }

    public function edit(Request $request){
        $user = User::findOrFail($request->id);
        echo json_encode($user);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|string|max:100',
            'kodepegawai'=> [
                'required',
                'numeric',
                Rule::unique('users','kodepegawai')->ignore($request->id,'id')],
            'password'=> 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $users = User::findOrFail($request->id);

        $users->nama = $request->nama;
        $users->kodepegawai = $request->kodepegawai;
        if($request->password){
            $users->password = Hash::make($request->password);
        }

        if($users->save()){
            return redirect('user/')->with('success',array('message'=>'Data tersimpan'));
        }else{
            return back()->with('error',array('message'=>'Data tidak tersimpan'));
        }
    }

    public function destroy(Request $request){
        User::findOrFail($request->id)->delete();
        return response()->json(['message' => 'Data terhapus']);
    }
}
