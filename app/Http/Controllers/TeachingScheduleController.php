<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use App\Models\TeachingSchedules;
use Illuminate\Http\Request;

class TeachingScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kelola Jadwal Guru";
        $teachingSchedules = TeachingSchedules::with('teacher')->get();
        return view('teaching_schedules.index', compact('teachingSchedules', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Jadwal Guru";
        $teachers = Teachers::all();
        return view('teaching_schedules.create', compact('teachers', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject' => 'required|string|max:255',
            'teaching_day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        // Simpan jadwal mengajar
        TeachingSchedules::create([
            'teacher_id' => $request->teacher_id,
            'subject' => $request->subject,
            'teaching_day' => $request->teaching_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('listTeachingschedules')->with('success', 'Teaching Schedule Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TeachingSchedules $teachingSchedule)
    {
        $title = "Detail Jadwal Guru";
        return view('teaching_schedules.show', compact('teachingSchedule', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeachingSchedules $teachingSchedule)
    {
        $title = "Edit Jadwal Guru";
        $teachers = Teachers::all();
        return view('teaching_schedules.edit', compact('teachingSchedule', 'teachers', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeachingSchedules $teachingSchedule)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject' => 'required|string|max:255',
            'teaching_day' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);
        
        $teachingSchedule->update([
            'teacher_id' => $request->teacher_id,
            'subject' => $request->subject,
            'teaching_day' => $request->teaching_day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('listTeachingschedules')->with('success', 'Teaching Schedule Updated Successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TeachingSchedules $teachingSchedule)
    {
        $teachingSchedule->delete();
        return redirect()->route('listTeachingschedules')->with('success', 'Teaching Schedule Deleted Successfully');
    }
}
