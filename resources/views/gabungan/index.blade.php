@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Mobil yang Tersisa</h2>
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
            <th>Nama Pemilik</th>
            <th>KTP Pemilik</th>
            <th>Merk Mobil</th>
        </tr>
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->nama }}</td>
            <td>{{ $join->ktp_pemilik }}</td>
            <td>{{ $join->merk }}</td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
@endsection