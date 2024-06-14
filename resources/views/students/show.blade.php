<!-- resources/views/students/show.blade.php -->
@extends('layouts.master')

@section('title', 'Detail Siswa')
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
                            <li class="breadcrumb-item"><a href="{{ route('listStudents') }}">Siswa</a></li>
                            <li class="breadcrumb-item active">Detail Siswa</li>
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
                            <td>{{ $student->name }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Induk Siswa</th>
                            <td>{{ $student->student_id }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $student->class }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ Carbon::parse($student->birth_date)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>{{ $student->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $student->email }}</td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                @if ($student->photo)
                                    <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Student Photo" width="100">
                                @else
                                    <span>No Photo</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <br>
                    <a href="{{ route('listStudents') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
