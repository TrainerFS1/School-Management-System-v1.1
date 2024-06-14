@extends('layouts.master')
@php
    use Carbon\Carbon;
@endphp

@section('title', 'Students')

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

        .modal-close-btn {
            position: absolute;
            right: 15px;
            top: 15px;
            z-index: 1051;
            /* Set higher z-index */
        }
    </style>
@endsection

@section('addJavascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script>
        $(function() {
            $("#data-table").DataTable();
        });

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
                            <li class="breadcrumb-item active">Siswa</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Siswa SMK Gamelab</h1>
                    <div>
                        <button class="btn btn-primary mr-2" data-toggle="modal" data-target="#importModal">Import
                            Excel</button>
                        <a href="{{ route('createStudents') }}" class="btn btn-primary">Tambah Siswa</a>
                    </div>
                </div>

                <!-- Import Modal -->
                <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="importModalLabel">Import Siswa Excel File</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('importStudents') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="excel_file">Pilih Excel File</label>
                                        <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls"
                                            class="form-control" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover mb-0" id="data-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Foto</th>
                                    <th>Nama Siswa</th>
                                    <th>Nomor Induk Siswa</th>
                                    <th>Kelas</th>
                                    <th>Tanggal Kelahiran</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($student->photo)
                                                <img src="{{ asset('storage/photos/' . $student->photo) }}" alt="Student Photo" width="50">
                                            @else
                                                <span>No Photo</span>
                                            @endif
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->class }}</td>
                                        <td>{{ Carbon::parse($student->birth_date)->format('d-m-Y') }}</td>
                                        <td>{{ $student->address }}</td>
                                        <td>{{ $student->phone_number }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td class="action-buttons">
                                            <a href="{{ route('showStudents', $student) }}" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('editStudents', $student) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete(this)"
                                                data-url="{{ route('deleteStudents', ['student' => $student->id]) }}"
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <!-- Form Delete -->
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
