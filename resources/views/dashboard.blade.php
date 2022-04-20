@extends('layout.app')

@section('title','Dashboard | UD. Arisya')

@section('container')

@include('layout.navbar')
@include('layout.sidebar')
<div class="content-body">
<div class="container-fluid mt-3">
    <div class="row">
        <a href="/dashboard/estimasi" class="col-lg-3 col-md-6 col-sm-12">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Penjualan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">54497</h2>
                        <p class="text-white mb-0">Jan - March 2019</p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </a>
        <a href="barang/index" class="col-lg-3 col-md-6 col-sm-12">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Barang</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white"></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                </div>
            </div>
        <a href="/dashboard/gedung" class="col-lg-3 col-md-6 col-sm-12">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Pembeli</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white"></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-building"></i></span>
                </div>
            </div>
        <a href="/dashboard/sarana" class="col-lg-3 col-md-6 col-sm-12">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">Karyawan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white"></h2>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-road"></i></span>
                </div>
            </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Line Chart</h4>
                <div id="morris-line-chart"></div>
            </div>
        </div>
    </div>
</div>
@endsection