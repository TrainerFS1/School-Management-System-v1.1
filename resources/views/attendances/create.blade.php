<!-- resources/views/attendances/create.blade.php -->
@extends('layouts.master')

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the date input to today's date
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;

            var students = @json($students);

            document.getElementById('student_name').addEventListener('change', function() {
                var selectedStudentId = this.value;
                var selectedStudent = students.find(student => student.id == selectedStudentId);

                if (selectedStudent) {
                    document.getElementById('nis').value = selectedStudent.student_id;
                    document.getElementById('student_class').value = selectedStudent.class;
                }
            });
        });

        confirmDelete = function(button) {
            var url = $(button).data('url');
            swal({
                'title': 'Konfirmasi Hapus',
                'text': 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                'dangermode': true,
                'buttons': true
            }).then(function(value) {
                if (value) {
                    window.location = url;
                }
            })
        }
    </script>
@endsection

@section('title', 'Attendances')

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
                            <li class="breadcrumb-item"><a href="{{ route('listAttendances') }}">Kehadiran</a></li>
                            <li class="breadcrumb-item active">Tambah Kehadiran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="container mt-5">
            <h1 class="mt-5">Tambah Kehadiran</h1>
            <form action="{{ route('storeAttendances') }}" method="POST">
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
                    <label for="date">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status <span class="text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Present">Present</option>
                        <option value="Absent">Absent</option>
                        <option value="Late">Late</option>
                        <option value="Excused">Excused</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="{{ route('listAttendances') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
