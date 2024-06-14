<!-- resources/views/grades/create.blade.php -->
@extends('layouts.master')

@section('title', 'Grades')

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
                            <li class="breadcrumb-item active">Tambah Nilai</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="container mt-5">
            <h1 class="mt-5">Tambah Nilai</h1>
            <form action="{{ route('storeGrades') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="student_name">Nama Siswa <span class="text-danger">*</span></label>
                    <select name="student_id" id="student_name" class="form-control" required>
                        <option selected disabled>Pilih Nama Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nis">Nomor Induk Siswa <span class="text-danger">*</span></label>
                    <input type="text" id="nis" name="nis" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="student_class">Kelas <span class="text-danger">*</span></label>
                    <input type="text" id="student_class" name="student_class" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label for="subject">Subyek <span class="text-danger">*</span></label>
                    <input type="text" name="subject" id="subject" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="grade">Nilai <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="grade" id="grade" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('listGrades') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var students = @json($students);

            // Event listener untuk mengubah data siswa dan mengupdate NIS serta Kelas
            document.getElementById('student_name').addEventListener('change', function() {
                var selectedStudentId = this.value;
                var selectedStudent = students.find(student => student.id == selectedStudentId);

                if (selectedStudent) {
                    document.getElementById('nis').value = selectedStudent.student_id;
                    document.getElementById('student_class').value = selectedStudent.class;
                }
            });
        });
    </script>
@endsection
