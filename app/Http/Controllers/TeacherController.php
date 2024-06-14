<?php

namespace App\Http\Controllers;

use App\Models\Teachers;
use Illuminate\Http\Request;
use App\Imports\TeachersImport;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TeachingSchedules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kelola Profil Guru";
        $teachers = Teachers::all();
        return view('teachers.index', compact('teachers', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Profil Guru";
        return view('teachers.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'teacher_id' => 'required|unique:teachers',
            'specialization' => 'required',
            'phone_number' => 'required|max:15',
            'address' => 'required',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'nullable|min:6', // Password is optional and at least 6 characters
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Photo is optional and must be an image
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password); // Hash the password if present
        }

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        Teachers::create($data);
        return redirect()->route('listTeachers')->with('success', 'Teacher Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teachers $teacher)
    {
        $title = "Detail Profil Guru";
        return view('teachers.show', compact('teacher', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teachers $teacher)
    {
        $title = "Edit Profil Guru";
        return view('teachers.edit', compact('teacher', 'title'));
    }

    public function update(Request $request, Teachers $teacher)
    {
        // Atur aturan validasi untuk input
        $rules = [
            'name' => 'required',
            'teacher_id' => 'required|unique:teachers,teacher_id,' . $teacher->id,
            'specialization' => 'required',
            'phone_number' => 'required|max:15',
            'address' => 'required',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Foto opsional
        ];

        // Tambahkan aturan validasi untuk password jika diisi
        if ($request->filled('password')) {
            $rules['password'] = 'required|min:6';
        }

        // Validasi input dari request
        $request->validate($rules);

        // Ambil semua data dari request
        $data = $request->only([
            'name', 'teacher_id', 'specialization', 'phone_number', 'address', 'email',
        ]);

        // Handle password jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle photo jika ada file baru diunggah
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($teacher->photo && Storage::exists('public/photos/' . $teacher->photo)) {
                Storage::delete('public/photos/' . $teacher->photo);
            }

            // Simpan foto baru yang diunggah
            $photoPath = $request->file('photo')->store('public/photos');
            $data['photo'] = basename($photoPath);
        }

        // Update data guru
        $teacher->update($data);

        // Redirect ke halaman daftar guru dengan pesan sukses
        return redirect()->route('listTeachers')->with('success', 'Teacher Updated Successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teachers $teacher)
    {
        // Delete related teaching schedules
        TeachingSchedules::where('teacher_id', $teacher->id)->delete();
        
        // Delete photo if exists
        if ($teacher->photo && File::exists(public_path('storage/photos/' . $teacher->photo))) {
            File::delete(public_path('storage/photos/' . $teacher->photo));
        }

        $teacher->delete();
        return redirect()->route('listTeachers')->with('success', 'Teacher Deleted Successfully');
    }

    /**
     * Import teachers from an Excel file.
     */
    public function importTeachers(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        // Ensure the directory exists
        $directoryPath = public_path('Teachers_Import_Data');
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Save the file to the specified folder
        $path = $file->move($directoryPath, $file->getClientOriginalName());

        try {
            // Import the file from the storage path
            Excel::import(new TeachersImport, $path);
            return redirect()->route('listTeachers')->with('success', 'Data Is Imported Successfully');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Import Error: ' . $e->getMessage());
            Log::error('File Path: ' . $path);
            return redirect()->route('listTeachers')->with('error', 'An Error Occurred While Importing Data');
        }
    }
}
