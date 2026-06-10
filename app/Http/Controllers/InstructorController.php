<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use App\Models\Majors;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $instructors = Instructor::with('major')->orderByDesc('id')->get();
        $title = "Instructor Management";
        return view('instructor.index', compact('instructors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create New Instructor";
        $majors = Majors::get();
        return view('instructor.create', compact('title', 'majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // insert into users () values()
        $validate = $request->validate([
            'major_id' => 'required',
            'name' => 'required',
            'phone' => 'nullable'
        ]);


        Instructor::create($request->all());
        Alert::success('Success!!', 'Create instructor success');
        return redirect()->to('instructor');
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
        $title = "Edit Instructor";
        $edit  = Instructor::find($id); //blank
        $majors = Majors::get();
        return view('instructor`.edit', compact('title', 'edit', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'major_id' => $request->major_id,
            'name' => $request->name,
            'phone' => $request->phone,
        ];

        Instructor::find($id)->update($data);
        Alert::success('Success!!', 'Update instructor success');
        return redirect()->to('instructor');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Instructor::find($id)->delete();
        Alert::success('Success!!', 'Delete insturctor success');
        return redirect()->to('instructor');
    }
}
