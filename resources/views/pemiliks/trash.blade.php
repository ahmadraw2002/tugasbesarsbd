@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pemilik Deleted</h2>
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
                <form>
                    @can('pemilik-delete')
                    <a class="btn btn-primary" href="trash/{{ $pemilik ->ktp_pemilik }}/restore">Restore</a>
                    @endcan
                    @csrf
                    @can('pemilik-delete')
                    <a class="btn btn-danger" href="trash/{{ $pemilik->ktp_pemilik }}/forcedelete">Force Delete</a>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $pemiliks->links() !!}

@endsection