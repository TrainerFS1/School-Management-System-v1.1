@extends('layouts.master')

@section('title', 'Edit Grade')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listGrades') }}">Nilai</a></li>
                            <li class="breadcrumb-item active">Edit Nilai</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="container mt-5">
            <h1>Edit Nilai</h1>
            <form action="{{ route('updateGrades', $grade->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="student_name">Nama Siswa <span class="text-danger">*</span></label>
                    <input type="text" id="student_name" class="form-control" value="{{ $grade->student->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="student_id">Nomor Induk Siswa <span class="text-danger">*</span></label>
                    <input type="hidden" name="student_id" value="{{ $grade->student_id }}">
                    <input type="text" id="nis" name="nis" class="form-control" value="{{ $grade->student->student_id }}" readonly>
                </div>
                <div class="form-group">
                    <label for="student_class">Kelas <span class="text-danger">*</span></label>
                    <input type="text" id="student_class" name="student_class" class="form-control" value="{{ $grade->student->class }}" readonly>
                </div>
                <div class="form-group">
                    <label for="subject">Subyek <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control" value="{{ $grade->subject }}" required>
                </div>
                <div class="form-group">
                    <label for="grade">Nilai <span class="text-danger">*</span></label>
                    <input type="number" name="grade" id="grade" min="0" max="100" class="form-control" value="{{ $grade->grade }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('listGrades') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
