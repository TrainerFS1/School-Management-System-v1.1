<!-- resources/views/payments/index.blade.php -->
@extends('layouts.master')
@php
    use Carbon\Carbon;
@endphp

@section('title', 'Payments')

@section('addCss')
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <style>
        .action-buttons {
            display: flex;
            justify-content: space-around;
        }

        .action-buttons a,
        .action-buttons button {
            margin: 0 2px;
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Script tambahan inisialisasi datatables --}}
    <script>
        $(function() {
            $("#data-table").DataTable();
        });
    </script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        function confirmDelete(button) {
            var url = $(button).data('url');
            swal({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Kamu Yakin Ingin Menghapus Data Ini?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function(value) {
                if (value) {
                    var form = $('#delete-form');
                    form.attr('action', url);
                    form.submit();
                }
            });
        }
    </script>
    <script>
        document.getElementById('amount').addEventListener('input', function(e) {
            let value = e.target.value;
            value = value.replace(/\D/g, ''); // Remove all non-digit characters
            e.target.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Add thousand separator
        });
    </script>
@endsection

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
                            <li class="breadcrumb-item active">Pembayaran</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Pembayaran SMK Gamelab</h1>
                    <div>
                        <a href="{{ route('createPayments') }}" class="btn btn-primary">Tambah Pembayaran</a>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover mb-0" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nomor Induk Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tahun Akademik</th>
                                    <th>Jenis Pembayaran</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $payment->student->name }}</td>
                                        <td>{{ $payment->student->student_id }}</td>
                                        <td>{{ $payment->student->class }}</td>
                                        <td>{{ $payment->academic_year }}</td>
                                        <td>{{ implode(', ', array_map('ucfirst', $payment->payment_type)) }}</td>
                                        <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                        <td>{{ $payment->payment_date->format('d-m-Y') }}</td>
                                        <td>{{ $payment->status ? 'Lunas' : 'Belum Lunas' }}</td>
                                        <td>{{ $payment->description }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('showPayments', $payment->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('editPayments', $payment) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" onclick="confirmDelete(this)"
                                                    data-url="{{ route('deletePayments', ['payment' => $payment->id]) }}"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                <!-- Form Delete -->
                                                <form id="delete-form" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
