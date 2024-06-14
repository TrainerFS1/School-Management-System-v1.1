<!-- resources/views/grades/show.blade.php -->
@extends('layouts.master')

@section('title', 'Grade Details')

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
                            <li class="breadcrumb-item active">Detail Nilai</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="container mt-5">
            <h1 class="mt-5">Grade Details</h1>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Siswa</th>
                            <td>{{ $grade->student->name }}</td>
                        </tr>
                        <tr>
                            <th>Nomor Induk Siswa</th>
                            <td>{{ $grade->student->student_id }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $grade->student->class }}</td>
                        </tr>
                        <tr>
                            <th>Subyek</th>
                            <td>{{ $grade->subject }}</td>
                        </tr>
                        <tr>
                            <th>Nilai</th>
                            <td>{{ $grade->grade }}</td>
                        </tr>
                    </table>
                    <br>
                    <a href="{{ route('listGrades') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
