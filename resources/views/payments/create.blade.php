<!-- resources/views/payments/create.blade.php -->
@extends('layouts.master')

@section('title', 'Add Payment')

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
                            <li class="breadcrumb-item"><a href="{{ route('listPayments') }}">Pembayaran</a></li>
                            <li class="breadcrumb-item active">Tambah Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Tambah Pembayaran</h1>
                <form action="{{ route('storePayments') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="student_name">Nama Siswa <span class="text-danger">*</span></label>
                        <select class="form-control" id="student_name" name="student_name" required>
                            <option selected disabled>Pilih Nama Siswa</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Nomor Induk Siswa <span class="text-danger">*</span></label>
                        <select class="form-control" id="student_id" name="student_id" required>
                            <option selected disabled>Pilih Nomor Induk Siswa</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->student_id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Kelas <span class="text-danger">*</span></label>
                        <select class="form-control" id="class" name="class" required>
                            <option selected disabled>Pilih Kelas</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="academic_year">Tahun Ajaran <span class="text-danger">*</span></label>
                        <select class="form-control" id="academic_year" name="academic_year" required>
                            <option selected disabled>Pilih Tahun Ajaran</option>
                            <option value="2022-2023">2022-2023</option>
                            <option value="2023-2024">2023-2024</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jenis Pembayaran <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="SPP"
                                id="SPP" required>
                            <label class="form-check-label" for="SPP">SPP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Gedung"
                                id="Gedung">
                            <label class="form-check-label" for="Gedung">Gedung</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Buku"
                                id="Buku">
                            <label class="form-check-label" for="Buku">Buku</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Seragam"
                                id="Seragam">
                            <label class="form-check-label" for="Seragam">Seragam</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount">Jumlah Pembayaran <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            placeholder="Masukkan Jumlah Pembayaran" required min="0" step="1000">
                    </div>
                    <div class="form-group">
                        <label for="payment_date">Tanggal Pembayaran <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Pembayaran <span class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Lunas</option>
                            <option value="0">Belum Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan deskripsi" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <a href="{{ route('listPayments') }}" class="btn btn-secondary">Kembali</a>
                </form>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
