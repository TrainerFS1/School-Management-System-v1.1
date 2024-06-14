<!-- resources/views/students/edit.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Student')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Optionally, you can add a header title here -->
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listStudents') }}">Siswa</a></li>
                            <li class="breadcrumb-item active">Edit Siswa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Edit Siswa</h1>
                <form action="{{ route('updateStudents', $student) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $student->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Nomor Induk Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="student_id" id="student_id" class="form-control"
                            value="{{ $student->student_id }}" required>
                    </div>
                    <div class="form-group">
                        <label for="class">Kelas <span class="text-danger">*</span></label>
                        <select class="form-control" id="class" name="class" required>
                            <option selected disabled>Pilih Kelas</option>
                            <option value="10" {{ $student->class == 10 ? 'selected' : '' }}>10</option>
                            <option value="11" {{ $student->class == 11 ? 'selected' : '' }}>11</option>
                            <option value="12" {{ $student->class == 12 ? 'selected' : '' }}>12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="birth_date">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control"
                               value="{{ $student->birth_date->format('Y-m-d') }}" required>
                    </div>                    
                    <div class="form-group">
                        <label for="address">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $student->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            value="{{ $student->phone_number }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ $student->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto (kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="photo" class="form-control-file" id="photo">
                        @if($student->photo)
                            <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Current Photo" width="100" class="mt-2">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('listStudents') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
