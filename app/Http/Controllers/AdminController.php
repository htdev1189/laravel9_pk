<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

// auth
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    protected $users;

    function __construct()
    {
        parent::__construct();
        $this->users = Admin::all();
    }

    public function getAll()
    {
        return view('backend/admin/list', [
            'users' => $this->users
        ]);
    }

    public function add()
    {
        return view('backend/admin/add');
    }

    public function store(Request $request)
    {
        // validate
        $request->validate([
            'username' => 'required|unique:App\Models\Admin,username',
            'email' => 'required|unique:App\Models\Admin,email',
            'password' => 'required|min:6',
            'image' => 'required',
            'name' => 'required'
        ], []);

        $data = $request->input();

        $admin = new Admin();

        $admin->name = $data['name'];
        $admin->password = bcrypt($data['password']);
        $admin->group = $data['group'];
        $admin->username = $data['username'];
        $admin->image = $data['image'];
        $admin->email = $data['email'];

        $admin->save();

        return redirect('/admin/user/list');
    }

    public function delete($id)
    {
        $category = Admin::find($id);
        if ($category) {
            $category->delete();
            return redirect('/admin/user/list');
        }
    }

    public function edit($id)
    {
        return view('backend/admin/edit', [
            'admin' => Admin::find($id)
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->input();
        // validate
        $request->validate([
            'username' => [
                'required',
                Rule::unique('admins', 'username')->ignore($data['id']),
            ],
            'email' => [
                'required',
                Rule::unique('admins', 'email')->ignore($data['id']),
            ],
            'password' => 'required|min:6',
            'image' => 'required',
            'name' => 'required'
        ], []);
        # code...
        
        $admin = Admin::find($data['id']);

        $admin->name = $data['name'];
        $admin->password = $data['password'] == $admin->password ? $admin->password : bcrypt($data['password']);
        $admin->group = $data['group'];
        $admin->username = $data['username'];
        $admin->image = $data['image'];
        $admin->email = $data['email'];

        $admin->save();

        return redirect('/admin/user/list');
    }

    // view login
    public function loginView()
    {
        return view('backend/login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        return redirect('/admin/login');
    }

    public function xulyLogin(Request $request)
    {

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);


        if (Auth::guard('admin')->attempt($credentials)) {

            $request->session()->regenerate();

            //info user current
            $current_user = Auth::guard('admin')->user();
            //put to session
            $request->session()->put('current_user',$current_user);
            return redirect('/admin/dashboard');
            //dd("thanh cong");
            // dd($user);
        } else {
            // tao flash
            $request->session()->flash('status', 'Check username or password');
            return back();
        }
    }
}
