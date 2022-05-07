<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <!-- Pignose Calender -->
    <link href="{{asset('assets/plugins/pg-calendar/css/pignose.calendar.min.css')}}" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="{{asset('assets/plugins/chartist/css/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css')}}">
    <!-- Custom Stylesheet -->
    <link href="{{asset('assets/plugins/toastr/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    

</head>

<body>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center mb-5">Data Barang</h4>
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
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($barangs as $barang)
                            <tr> 
                                <td>{{$loop->iteration}}</td>
                                <td>{{$barang->nama}}</td>
                                <td>{{$barang->ukuran}}</td>
                                <td>{{$barang->harga_satuan}}</td>
                                <td>{{$barang->harga_paket}}</td>
                                <td>{{$barang->jumlah_paket}}</td>
                                <td>{{$barang->stok}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>



<script type="text/javascript">
    window.print();
</script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/gleek.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/js/toastr.init.js')}}"></script>

    <script src="{{asset('assets/plugins/chartist/js/chartist.min.js')}}"></script>
    <script src="{{asset('assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>
    @stack('scripts')
</body>

</html>