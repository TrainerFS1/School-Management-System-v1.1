<!-- resources/views/teachers/show.blade.php -->
@extends('layouts.master')

@section('title', 'Teacher Details')

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
                            <li class="breadcrumb-item"><a href="{{ route('listTeachers') }}">Guru</a></li>
                            <li class="breadcrumb-item active">Detail Guru</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Detail Guru</h1>
                <div class="card bg-white">
                    <div class="card-body">
                        <table class="table table-bordered bg-white">
                            <tr>
                                <th>Nama Guru</th>
                                <td>{{ $teacher->name }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Unik Guru</th>
                                <td>{{ $teacher->teacher_id }}</td>
                            </tr>
                            <tr>
                                <th>Spesialisasi</th>
                                <td>{{ $teacher->specialization }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telefon</th>
                                <td>{{ $teacher->phone_number }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $teacher->address }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $teacher->email }}</td>
                            </tr>
                        </table>
                        <br>
                        <a href="{{ route('listTeachers') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
