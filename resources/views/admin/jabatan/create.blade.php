@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    {{-- <div class="page-pretitle">Overview</div> --}}
                    <h2 class="page-title">Tambah Data Jabatan</h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">

            <div class="card col-md-6">
                <div class="card-body">

                    <form action="{{ route('jabatan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="">Nama Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" name="jabatan"
                                value="{{ old('jabatan') }}" id="jabatan">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
