@extends('layouts.master')

@section('title', 'Create Teaching Schedule')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listTeachingschedules') }}">Jadwal Mengajar
                                    Guru</a></li>
                            <li class="breadcrumb-item active">Tambah Jadwal Mengajar Guru</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Tambah Jadwal Mengajar Guru</h1>
                <form action="{{ route('storeTeachingschedules') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="teacher_name">Nama Guru <span class="text-danger">*</span></label>
                        <select name="teacher_id" id="teacher_id" class="form-control">
                            <option selected disabled>Pilih Nama Guru</option>
                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}" data-teacherid="{{ $teacher->teacher_id }}">{{ $teacher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subyek <span class="text-danger">*</span></label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="teaching_day">Hari Mengajar <span class="text-danger">*</span></label>
                        <select name="teaching_day" id="teaching_day" class="form-control">
                            <option selected disabled>Pilih Hari Mengajar</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Waktu Mulai <span class="text-danger">*</span></label>
                        <input type="time" name="start_time" id="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">Waktu Selesai <span class="text-danger">*</span></label>
                        <input type="time" name="end_time" id="end_time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('listTeachingschedules') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Script JavaScript untuk mengisi otomatis nomor unik guru berdasarkan pilihan nama guru -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const teacherNameSelect = document.getElementById('teacher_id');

            teacherNameSelect.addEventListener('change', function () {
                const selectedOption = teacherNameSelect.options[teacherNameSelect.selectedIndex];
                const selectedTeacherId = selectedOption.getAttribute('data-teacherid');
                teacherNameSelect.value = selectedOption.value; // Set nilai select
            });
        });
    </script>
@endsection
