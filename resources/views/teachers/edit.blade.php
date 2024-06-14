@extends('layouts.master')

@section('title', 'Edit Teacher')

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
                            <li class="breadcrumb-item active">Edit Guru</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Edit Guru</h1>
                <form action="{{ route('updateTeachers', $teacher) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama Guru <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ $teacher->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="teacher_id">Nomor Unik Guru <span class="text-danger">*</span></label>
                        <input type="text" name="teacher_id" id="teacher_id" class="form-control"
                            value="{{ $teacher->teacher_id }}" required>
                    </div>
                    <div class="form-group">
                        <label for="specialization">Spesialisasi <span class="text-danger">*</span></label>
                        <input type="text" name="specialization" id="specialization" class="form-control"
                            value="{{ $teacher->specialization }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                            value="{{ $teacher->phone_number }}" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat <span class="text-danger">*</span></label>
                        <input type="text" name="address" id="address" class="form-control"
                            value="{{ $teacher->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ $teacher->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photo">Foto (kosongkan jika tidak ingin mengubah)</label>
                        <input type="file" name="photo" class="form-control-file" id="photo">
                        @if($teacher->photo)
                            <img src="{{ asset('storage/photos/' . $teacher->photo) }}" alt="Current Photo" width="100" class="mt-2">
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('listTeachers') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
