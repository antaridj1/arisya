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
            </a>
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
            </a>
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
            </a>
        </div>

        <div class="d-flex justify-content-around">
            <div class="card col-lg-6 col-md-12 col-sm-12 m-1">
                <div class="card-body">
                    <h4 class="card-title">Grafik Barang Terjual</h4>
                    <div id="distributed-series" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
            <div class="card col-lg-6 col-md-12 col-sm-12 m-1">
                <div class="card-body">
                    <h4 class="card-title">Grafik Laba Rugi</h4>
                    <div id="bi-polar-bar" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
    
   //Distributed series
$.get("{{ route('getBarangs') }}",function(barangs){
    $.get("{{ route('getJumlah') }}",function(jumlah){
        new Chartist.Bar('#distributed-series', {
            labels: barangs,
            series: jumlah
        }, {
            distributeSeries: true,
            plugins: [
            Chartist.plugins.tooltip()
            ]
        });
    });
});
  
  
</script>

<script>
var data = {
    labels: ['W1', 'W2', 'W3', 'W4', 'W5', 'W6', 'W7', 'W8', 'W9', 'W10'],
    series: [
      [1, 2, 4, 8, 6, -2, -1, -4, -6, -2]
    ]
  };
  
  var options = {
    high: 10,
    low: -10,
    axisX: {
      labelInterpolationFnc: function(value, index) {
        return index % 2 === 0 ? value : null;
      }
    },
    plugins: [
      Chartist.plugins.tooltip()
    ]
  };
  
  new Chartist.Bar('#bi-polar-bar', data, options);
</script>

@endpush
@endsection
