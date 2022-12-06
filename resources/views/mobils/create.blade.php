@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tambahkan Data Mobil</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('mobils.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Terjadi Masalah Pada Inputan<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('mobils.store') }}" method="POST">
        @csrf
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Id Mobil:</strong>
                    <input type="text" name="id_mobil" class="form-control" placeholder="Id Mobil">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Merk:</strong>
                    <input type="text" name="merk" class="form-control" placeholder="Merk">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Tahun:</strong>
                    <input type="number" name="tahun" class="form-control" placeholder="tahun">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Harga:</strong>
                    <input type="number" name="harga" class="form-control" placeholder="harga">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>KTP PEMILIK:</strong>
                    <input type="number" name="ktp_pemilik" class="form-control" placeholder="ktp_pemilik">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>KTP PEMBELI:</strong>
                    <input type="number" name="ktp_pembeli" class="form-control" placeholder="ktp_pembeli">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection