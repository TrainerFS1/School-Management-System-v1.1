<!-- resources/views/students/edit.blade.php -->
@extends('layouts.master')

@section('title', 'Edit Payment')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <!-- Optionally, you can add a header title here -->
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('listPayments') }}">Pembayaran</a></li>
                            <li class="breadcrumb-item active">Edit Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <h1 class="mt-5">Edit Pembayaran</h1>
                <form action="{{ route('updatePayments', $payment) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="student_name" class="form-label">Nama Siswa <span class="text-danger">*</span></label>
                        <select class="form-control" id="student_name" name="student_name">
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $student->id == $payment->student_id ? 'selected' : '' }}>{{ $student->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="student_id">Nomor Induk Siswa <span class="text-danger">*</span></label>
                        <select class="form-control" id="student_id" name="student_id">
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $student->id == $payment->student_id ? 'selected' : '' }}>{{ $student->student_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Kelas <span class="text-danger">*</span></label>
                        <select class="form-control" id="class" name="class" required>
                            <option selected disabled>Pilih Kelas</option>
                            <option value="10" {{ $student->class == 10 ? 'selected' : '' }}>10</option>
                            <option value="11" {{ $student->class == 11 ? 'selected' : '' }}>11</option>
                            <option value="12" {{ $student->class == 12 ? 'selected' : '' }}>12</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="academic_year" class="form-label">Tahun Akademik <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="academic_year" name="academic_year">
                            <option value="2022-2023" {{ $payment->academic_year == '2022-2023' ? 'selected' : '' }}>
                                2022-2023</option>
                            <option value="2023-2024" {{ $payment->academic_year == '2023-2024' ? 'selected' : '' }}>
                                2023-2024</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jenis Pembayaran <span class="text-danger">*</span></label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="SPP"
                                id="SPP" {{ in_array('SPP', $payment->payment_type) ? 'checked' : '' }}>
                            <label class="form-check-label" for="SPP">SPP</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Gedung"
                                id="Gedung" {{ in_array('Gedung', $payment->payment_type) ? 'checked' : '' }}>
                            <label class="form-check-label" for="gedung">Gedung</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Buku"
                                id="Buku" {{ in_array('Buku', $payment->payment_type) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Buku">Buku</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="payment_type[]" value="Seragam"
                                id="Seragam" {{ in_array('Seragam', $payment->payment_type) ? 'checked' : '' }}>
                            <label class="form-check-label" for="Seragam">Seragam</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="form-label">Jumlah Pembayaran <span
                                class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="amount" name="amount"
                            value="{{ $payment->amount }}" placeholder="Masukkan Jumlah Pembayaran">
                    </div>
                    <div class="form-group">
                        <label for="payment_date" class="form-label">Tanggal Pembayaran <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="payment_date" name="payment_date"
                            value="{{ $payment->payment_date->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status Pembayaran <span
                                class="text-danger">*</span></label>
                        <select class="form-control" id="status" name="status">
                            <option value="1" {{ $payment->status ? 'selected' : '' }}>Lunas</option>
                            <option value="0" {{ !$payment->status ? 'selected' : '' }}>Belum Lunas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" placeholder="Masukkan deskripsi">{{ $payment->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('listPayments') }}" class="btn btn-secondary">Kembali</a>
                </form>
                <br>
                <br>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
