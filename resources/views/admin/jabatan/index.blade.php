@extends('admin.layouts.index')
@section('content')
    <!-- BEGIN PAGE HEADER -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    {{-- <div class="page-pretitle">Overview</div> --}}
                    <h2 class="page-title">Data Jabatan</h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BEGIN PAGE BODY -->
    <div class="page-body">
        <div class="container-xl">

            <a href="{{ route('jabatan.create') }}" class="btn btn-primary rounded-pill">
                <span class="text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                        <path d="M12 11l0 6" />
                        <path d="M9 14l6 0" />
                    </svg>
                </span>
                Tambah Data
            </a>
            <div class="row row-deck row-cards mt-3">

                <table class="table table-bordered">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        <th>Aksi</th>
                    </tr>

                    @php
                        $no = 1;
                    @endphp

                    @forelse ($jabatans as $jabatan)
                        <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td>{{ $jabatan->jabatan }}</td>
                            <td class="text-center">
                                <a href="{{ route('jabatan.edit', $jabatan->id) }}"
                                    class="badge bg-primary rounded-pill text-bg-primary">
                                    Edit
                                </a>
                                <form action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="badge bg-danger rounded-pill text-bg-danger btn-delete">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">
                                Data masih kosong, silakan tambahkan data baru.
                            </td>
                        </tr>
                    @endforelse
                </table>

            </div>
        </div>
    </div>
@endsection
