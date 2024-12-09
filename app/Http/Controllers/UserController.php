<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::where('name', 'LIKE', '%' . $request->cari . '%')->orderBy('name', 'ASC')->simplePaginate(5)->appends($request->all());
        return view('pages.kelola_akun', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:8',
        ]);

        $defaultPassword = substr($request->name, 0, 4) .  substr($request->email, 0, 4);

        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => bcrypt($defaultPassword),
            ]
        );

        return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Menambah Data Akun!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        return view('user.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Mengubah Data Akun!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data Akun!');
    }

    public function login()
    {
        return view('user.sign_in');
    }


    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        $users = $request->only(['email', 'password']);
        if (Auth::attempt($users)) {
            if(Auth::user()->role =='Admin') {
                return redirect()->route('dashboard');
            }else{
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password Salah!');
        }
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda Telah Berhasil Melakukan Log Out !');
    }
    
    public function register()
    {
        return view('user.sign_up');
    }

    public function regisAuth(Request $request)
    {

        $request->validate([ 
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $defaultPassword = substr($request->name, 0, 4) .  substr($request->email, 0, 4);

        User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'User',
                'password' => bcrypt($defaultPassword),
            ]
        );

        return redirect()->route('kelola_akun.data')->with('success', 'Berhasil Menambah Data Akun!');
    }
}
