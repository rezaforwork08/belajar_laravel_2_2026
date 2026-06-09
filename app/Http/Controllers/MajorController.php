<?php

namespace App\Http\Controllers;

use App\Models\Majors;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class MajorController extends Controller
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
        $majors = Majors::orderByDesc('id')->get();
        $title = "Major Management";
        return view('major.index', compact('majors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Major";
        return view('major.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
            'is_active' => 'required'
        ]);


        Majors::create($request->all());
        Alert::success('Success!!', 'Create major success');
        return redirect()->to('major');
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
        $title = "Edit Major";
        $edit  = Majors::find($id); //blank
        // $edit  = User::findOrFail($id); 404
        return view('major.edit', compact('title', 'edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'is_active' => $request->is_active,
        ];

        Majors::find($id)->update($data);
        return redirect()->to('major');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Majors::find($id)->delete();
        return redirect()->to('major');
    }
}
