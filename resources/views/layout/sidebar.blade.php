<div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu"> 
                        <li>
                            <a href="/dashboard" aria-expanded="false">
                                <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        @if(auth()->user()->isOwner == false)
                            <li class="nav-label">Penjualan</li>
                            <li>
                                <a href="{{ route('penjualan.create') }}" aria-expanded="false">
                                    <i class="icon-plus"></i><span class="nav-text">Tambah Data</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('penjualan.index') }}" aria-expanded="false">
                                <i class="icon-chart"></i><span class="nav-text">Data Penjualan</span>
                            </a>
                        </li>
                        @if(auth()->user()->isOwner == true)
                        <li>
                            <a href="{{route('barang.index')}}" aria-expanded="false">
                                <i class="icon-basket-loaded"></i><span class="nav-text">Barang</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="{{ route('karyawan.index') }}" aria-expanded="false">
                                <i class="icon-people"></i><span class="nav-text">Karyawan</span>
                            </a>
                        </li>
                        @endif
                </ul>
            </div>
        </div>