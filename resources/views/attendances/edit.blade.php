<!-- resources/views/attendances/edit.blade.php -->
@extends('layouts.master')

@section('addJavascript')
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the date input to today's date
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;

            var students = @json($students);
            var selectedStudentId = '{{ $attendance->student_id }}'; // Mendapatkan ID siswa yang terpilih dari kontroler

            // Menemukan siswa yang sesuai dengan ID yang terpilih
            var selectedStudent = students.find(student => student.id == selectedStudentId);

            if (selectedStudent) {
                // Mengisi nilai NIS dan Kelas berdasarkan siswa yang dipilih
                document.getElementById('nis').value = selectedStudent.student_id;
                document.getElementById('student_class').value = selectedStudent.class;
            }
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

@section('title', 'Edit Attendance')

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
                            <li class="breadcrumb-item active">Edit Kehadiran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Edit Kehadiran</h1>
                <form action="{{ route('updateAttendances', $attendance->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="student_name">Nama Siswa <span class="text-danger">*</span></label>
                        <input type="text" id="student_name" class="form-control" value="{{ $attendance->student->name }}" readonly>
                        <input type="hidden" name="student_id" value="{{ $attendance->student_id }}">
                    </div>
                    <div class="form-group">
                        <label for="nis">Nomor Induk Siswa <span class="text-danger">*</span></label>
                        <input type="text" id="nis" name="nis" value="{{ $attendance->student_id }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="student_class">Kelas <span class="text-danger">*</span></label>
                        <input type="text" id="student_class" name="student_class" value="{{ $attendance->student->class }}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal <span class="text-danger">*</span></label>
                        <input type="date" name="date" id="date" value="{{ $attendance->date }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control">
                            <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                            <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                            <option value="Late" {{ $attendance->status == 'Late' ? 'selected' : '' }}>Late</option>
                            <option value="Excused" {{ $attendance->status == 'Excused' ? 'selected' : '' }}>Excused</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('listAttendances') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
