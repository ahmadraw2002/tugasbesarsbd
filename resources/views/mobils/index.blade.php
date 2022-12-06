@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Mobil</h2>
            </div>
            <div class="pull-right">
                @can('mobil-create')
                <a class="btn btn-success" href="{{ route('mobils.create') }}"> Tambahkan Mobil </a>
                @endcan
                @can('mobil-delete')
                <a class="btn btn-info" href = "/mobils/trash"> Recycle Bin </a>
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
            <th>ID Mobil</th>
            <th>Merk</th>
            <th>Tahun</th>
            <th>Harga</th>
            <th>KTP PEMBELI</th>
            <th>KTP PEMILIK</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($mobils as $mobil)
        <tr>
            <td>{{ $mobil->id_mobil }}</td>
            <td>{{ $mobil->merk }}</td>
            <td>{{ $mobil->tahun }}</td>
            <td>{{ $mobil->harga }}</td>
            <td>{{ $mobil->ktp_pembeli }}</td>
            <td>{{ $mobil->ktp_pemilik }}</td>
            <td>
                <form action="{{ route('mobils.destroy',$mobil->id_mobil) }}" method="POST">   
                    @can('mobil-edit')
                    <a class="btn btn-primary" href="{{ route('mobils.edit',$mobil->id_mobil) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('mobil-delete')
                    @endcan
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $mobil->id_mobil }}">
                        Delete
                    </button>
                </form>
                <!-- Modal -->
                    <div class="modal fade" id="hapusModal{{ $mobil->id_mobil }}" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('mobils.destroy', $mobil->id_mobil) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="modal-body">
                                        Apakah anda yakin ingin menghapus {{ $mobil->merk }}?
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
    {!! $mobils->links() !!}
@endsection