<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //select * from users
        // latest: desc
        // oldest: asc
        // $users = User::orderBy('id','desc')->get();
        // $users = User::latest()->get();
        $users = User::orderByDesc('id')->get();
        $title = "User Management";

        $deleteTitle = 'Hapus User!';
        $deleteText = "Apakah Anda yakin ingin menghapus user ini?";
        confirmDelete($deleteTitle, $deleteText);

        return view('user.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New User";
        return view('user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert into users () values()
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);


        User::create($request->all());
        Alert::success('Success!!', 'Create user success');
        // toast('Your Post as been submited!', 'success');
        return redirect()->to('user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Edit User";
        $edit  = User::find($id); //blank
        // $edit  = User::findOrFail($id); 404
        return view('user.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        // jika user  memasukan password
        if (filled($request->password)) {
            $data['password'] = $request->password;
        }

        User::find($id)->update($data);
        Alert::success('Berhasil!', 'Data user berhasil diperbarui.');
        return redirect()->to('user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        Alert::success('Berhasil!', 'User berhasil dihapus.');
        return redirect()->to('user');
    }
}
