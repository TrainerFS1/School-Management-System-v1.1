<!-- resources/views/teaching_schedules/show.blade.php -->
@extends('layouts.master')

@section('title', 'View Teaching Schedule')
@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listTeachingschedules') }}">Jadwal Mengajar Guru</a>
                            </li>
                            <li class="breadcrumb-item active">Detail Jadwal Mengajar Guru</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Detail Jadwal Mengajar Guru</h1>
                <div class="card bg-white">
                    <div class="card-body">
                        <table class="table table-bordered bg-white">
                            <tr>
                                <th>Nama Guru</th>
                                <td>{{ $teachingSchedule->teacher->name }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Unik Guru</th>
                                <td>{{ $teachingSchedule->teacher->teacher_id }}</td>
                            </tr>
                            <tr>
                                <th>Subyek</th>
                                <td>{{ $teachingSchedule->subject }}</td>
                            </tr>
                            <tr>
                                <th>Hari Mengajar</th>
                                <td>{{ $teachingSchedule->teaching_day }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Mulai</th>
                                <td>{{ Carbon::parse($teachingSchedule->start_time)->format('H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Selesai</th>
                                <td>{{ Carbon::parse($teachingSchedule->end_time)->format('H:i') }}</td>
                            </tr>
                        </table>
                        <br>
                        <a href="{{ route('listTeachingschedules') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
