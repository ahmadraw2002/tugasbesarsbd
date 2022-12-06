@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Pemilik Mobil</h2>
            </div>
            <div class="pull-right">
                @can('pemilik-create')
                <a class="btn btn-success" href="{{ route('pemiliks.create') }}"> Tambahkan Nama Pemilik </a>
                @endcan
                @can('pemilik-delete')
                <a class="btn btn-info" href = "/pemiliks/trash"> Recycle Bin </a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>KTP PEMILIK</th>
            <th>Nama</th>
            <th>NO HP</th>
            <th>Alamat</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($pemiliks as $pemilik)
        <tr>
            <td>{{ $pemilik->ktp_pemilik }}</td>
            <td>{{ $pemilik->nama }}</td>
            <td>{{ $pemilik->no_hp }}</td>
            <td>{{ $pemilik->alamat }}</td>
            <td>
                <form action="{{ route('pemiliks.destroy',$pemilik->ktp_pemilik) }}" method="POST">
                    @can('pemilik-edit')
                    <a class="btn btn-primary" href="{{ route('pemiliks.edit',$pemilik->ktp_pemilik) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('pemilik-delete')
                    @endcan
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $pemilik->ktp_pemilik }}">
                        Delete
                    </button>
                </form>
                <!-- Modal -->
                <div class="modal fade" id="hapusModal{{ $pemilik->ktp_pemilik }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('pemiliks.destroy', $pemilik->ktp_pemilik) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $pemilik->ktp_pemilik }}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
                                        <button type="submit" class="btn btn-success">Ya</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $pemiliks->links() !!}
@endsection