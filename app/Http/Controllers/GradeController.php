<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use App\Models\Students;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kelola Nilai Siswa";
        $grades = Grades::with('student')->get();
        return view('grades.index', compact('grades', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Nilai Siswa";
        $students = Students::all();
        return view('grades.create', compact('students', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'grade' => 'required|numeric|between:0,100',
        ]);

        Grades::create($request->all());
        return redirect()->route('listGrades')->with('success', 'Grade Recorded Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Grades $grade)
    {
        $title = "Detail Nilai Siswa";
        return view('grades.show', compact('grade', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grades $grade)
    {
        $title = "Edit Nilai Siswa";
        $students = Students::all();
        return view('grades.edit', compact('grade', 'students', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grades $grade)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject' => 'required|string',
            'grade' => 'required|numeric|between:0,100',
        ]);

        $grade->update($request->all());
        return redirect()->route('listGrades')->with('success', 'Grade Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grades $grade)
    {
        $grade->delete();
        return redirect()->route('listGrades')->with('success', 'Grade Deleted Successfully');
    }
}
