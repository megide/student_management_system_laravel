<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Company::orderBy('id','asc')->paginate(5);
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        Company::create($request->post());

        return redirect()->route('student.index')->with('success','student has been registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(company $company)
    {
        return view('student.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Company::findOrFail($id);
        return view('student.edit', compact('student'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'address' => 'required',
    ]);

    $student = Company::findOrFail($id);
    $student->name = $request->input('name');
    $student->email = $request->input('email');
    $student->address = $request->input('address');
    $student->save();

    return redirect()->route('student.index')->with('success', 'student info has been updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $student = Company::findOrFail($id);
    $student->delete();

    return redirect()->route('student.index')->with('success', 'student has been deleted successfully');
}

}
