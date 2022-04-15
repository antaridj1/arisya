@extends('layout.app')

@section('title','penjualan | UD. Arisya')

@section('container')


@include('layout.navbar')
@include('layout.sidebar')

<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">penjualan</a></li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data penjualan</h4>
                        <div class="d-flex justify-content-between">
                            <form action="{{route('penjualan.index')}}">
                                <div class="input-group">
                                    <div class="d-flex justify-content-center">
                                        <input class="form-control border-end-0 border col-5" type="search" placeholder="Search" id="example-search-input" aria-describedby="button-addon2" name="search" value="{{request('search')}}">
                                        <span class="input-group-append">
                                            <button class="btn btn-outline-secondary border-start-0 border-bottom-0 border" type="submit" >
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <a href="{{route('penjualan.create')}}" class="btn btn-primary mt-2 mb-3">
                                Tambahkan Data
                            </a>
                        </div>

                        <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Ukuran</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga per m3</th>
                                    <th>Jumlah per m3</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                           
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip();   
        });
</script>
@endsection