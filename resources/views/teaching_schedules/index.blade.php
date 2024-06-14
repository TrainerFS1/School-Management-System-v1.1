<!-- resources/views/teaching_schedules/index.blade.php -->
@extends('layouts.master')

@section('title', 'Teaching Schedules')
@php
    use Carbon\Carbon;
@endphp

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
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Jadwal Mengajar Guru</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Jadwal Mengajar Guru SMK Gamelab</h1>
                    <a href="{{ route('createTeachingschedules') }}" class="btn btn-primary">Tambah Jadwal Mengajar Guru</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover mb-0" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Guru</th>
                                    <th>Nomor Unik Guru</th>
                                    <th>Subyek</th>
                                    <th>Hari Mengajar</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teachingSchedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->teacher->name }}</td>
                                        <td>{{ $schedule->teacher->teacher_id }}</td>
                                        <td>{{ $schedule->subject }}</td>
                                        <td>{{ $schedule->teaching_day }}</td>
                                        <td>{{ Carbon::parse($schedule->start_time)->format('H:i') }}</td>
                                        <td>{{ Carbon::parse($schedule->end_time)->format('H:i') }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('showTeachingschedules', $schedule) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('editTeachingschedules', $schedule) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete(this)"
                                                data-url="{{ route('deleteTeachingschedules', ['teaching_schedule' => $schedule->id]) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <form id="delete-form" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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
