<!-- resources/views/attendances/show.blade.php -->
@extends('layouts.master')

@section('title', 'Attendance Details')
@php
    use Carbon\Carbon;
@endphp

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
                            <li class="breadcrumb-item active">Detail Kehadiran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="container mt-5">
            <h1 class="mt-5">Detail Siswa</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Siswa</th>
                            <td>{{ $attendance->student->name }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Induk Siswa</th>
                            <td>{{ $attendance->student->student_id }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $attendance->student->class }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>{{ Carbon::parse($attendance->date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $attendance->status }}</td>
                        </tr>
                    </table>
                    <br>
                    <a href="{{ route('listAttendances') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
