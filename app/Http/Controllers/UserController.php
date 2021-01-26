<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin');
    }

    public function index(Request $request){
        if ($request->ajax()) {
            $data = User::select('id_users','nama','username')->where('role','user')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="btn-group btn-group-sm">';
                    $btn .= '<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#modal-delete" data-id="'.$row->id_users.'"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="Hapus"></i></button>';
                    $btn .= '<a href="'.route('user.edit',$row->id_users).'" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pencil-alt"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $datatable['route'] = route('user.index');
        $datatable['column'] = array('DT_RowIndex','nama','username');
        return view('user.index', compact('datatable'));
    }

    public function create(){
        return view('user.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|regex:/^[\pL\s\-]+$/u',
            'email'=> 'required|email|unique:App\Models\User,email',
            'username'=> 'required|alpha_num|unique:App\Models\User,username',
            'password'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $users = new User();
        $users->role = 'user';
        $users->nama = $request->nama;
        $users->email = $request->email;
        $users->username = $request->username;
        $users->password = bcrypt($request->password);
        if($users->save()){
            return redirect('user/index')->with('message',array('response'=>'Berhasil menambah data','color'=>'success'));
        }else{
            return back()->withInput()->withErrors(['Gagal menambah data']);
        }
    }

    public function edit(Request $request){
        $user = User::where('role','user')->findOrFail($request->id);
        return view('user.edit', compact('user'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'nama'=> 'required|regex:/^[\pL\s\-]+$/u',
            'email'=> [
                'required',
                'email',
                Rule::unique('users','email')->ignore($request->id,'id_users')],
            'username'=> [
                'required',
                'alpha_num',
                Rule::unique('users','username')->ignore($request->id,'id_users')],
            'password'=> 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $users = User::where('role','user')->findOrFail($request->id);

        $users->nama = $request->nama;
        $users->email = $request->email;
        $users->username = $request->username;
        $change_password = $request->change_password;
        if($change_password == 'on'){
            if($request->password_new == $request->password_confirm){
                $users->password = bcrypt($request->password_new);
            }else{
                return back()->withInput()->withErrors(['Password baru tidak sama']);
            }
        }

        if($users->save()){
            return redirect('user/index')->with('message',array('response'=>'Berhasil mengubah data','color'=>'success'));
        }else{
            return back()->withInput()->withErrors(['Gagal mengubah data']);
        }
    }

    public function destroy(Request $request){
        User::where('role','user')->findOrFail($request->id)->delete();

        return redirect('user/index')->with('message',array('response'=>'Berhasil menghapus data','color'=>'success'));
    }
}
