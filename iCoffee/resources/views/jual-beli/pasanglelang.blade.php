@extends('investasi.layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-3 cart-detail sidebar ftco-animate">
                <div class="sidebar-box">
                    <row class="row justify-content-md-center">

                        <div class="text-center">
                            <img src="/images/tonii.png" width="60%" style="border-radius: 50%">
                            
                        </div>
                        </row>
                    <br>

                    <row class="row justify-content-md-5">
                        <div class="col-md-12 col-sm-12">
                            <h5 class="text-center">Ahmad Fathoni</h5>
                            </div>
                    </row>
                    <br>

                    <row class="row justify-content-md-center">
                        <div class="col-sm-12">
                            <p><a href="#"class="btn btn-primary py-3 px-4">Edit Profil</a></p>
                            </div>
                    </row>
                    <br>
                    

                    <row class="row justify-content-md-center">
                        <div class="col-sm-12">
                            <ul class="nav flex-column">

                              <li class="nav-item">
                                <h5>Jual Beli</h5>
                                <hr>
                              </li>
                                
                              <li class="nav-item ">
                                <a href="#"><span class="icon icon-tags"></span><span class="text"> Penjualan</span></a>
                              </li>
                              <li class="nav-item ">
                                   <a href="#"><span class="oi oi-loop"></span><span class="text"> Transaksi Jual</span></a>
                              </li>

                            </ul>
                            </div>
                    </row>
                    <br>

                    <row class="row justify-content-md-center">
                        <div class="col-sm-12">
                            <ul class="nav flex-column">

                              <li class="nav-item">
                                <h5>Lelang</h5>
                                <hr>
                              </li>
                                
                              <li class="nav-item">
                                <a href="#"><span class="icon icon-timer"></span><span class="text"> Produk Lelang</span></a>
                              </li>
                              <li class="nav-item">
                                   <a href="#"><span class="oi oi-list"></span><span class="text"> Riwayat Lelang</span></a>
                              </li>

                            </ul>
                            </div>
                    </row>
                    <br>

                    <row class="row justify-content-md-center">
                        <div class="col-sm-12">
                            <ul class="nav flex-column">

                              <li class="nav-item">
                                <h5>Investasi</h5>
                                <hr>
                              </li>
                                
                              <li class="nav-item">
                                <a href="#"><span class="oi oi-people"></span><span class="text"> Jadi Mitra</span></a>
                              </li>
                              <li class="nav-item">
                                   <a href="#"><span class="oi oi-bar-chart"></span><span class="text"> Progress Investasi</span></a>
                              </li>

                            </ul>
                            </div>
                    </row>
            
                </div>
               </div>

               <div style="margin-left: 2%;"></div>
                    <div class="col-md-7 ftco-animate cart-detail">
                        <form action="#">
                            <h3 class="mt-3 pl-2">Pasang Produk Investasi</h3>
                <div class="row align-items-end pl-3">
                    <div class="col-md-12">
                    <div class="form-group">
                        <div class="images">
                            <div class="pic">
                              Tambah
                            </div>
                          </div>
                        <label for="firstname">Nama Produk</label>
                    <input type="text" class="form-control" placeholder="">
                    </div>
                </div>

                <div class="w-100"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Harga Awal</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="" placeholder="Dalam Rupiah">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Kelipatan</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="" placeholder="Dalam Rupiah">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp</div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Stok</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="Dalam Kilogram">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Kg</div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Kategori</label>
                            <div class="select-wrap">
                            <select name="" id="" class="form-control">
                                <option value="">Arabika</option>
                                <option value="">Robusta</option>
                                <option value="">Luwak</option>
                                <option value="">Jawa</option>
                                <option value="">Flores</option>
                                <option value="">Hijau</option>
                            </select>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="country">Jangka Waktu</label>
                            <div class="select-wrap">
                            <select name="" id="" class="form-control">
                                <option value="">3 Hari</option>
                                <option value="">1 Minggu</option>
                                <option value="">2 Minggu</option>
                            </select>
                        </div>
                        </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="streetaddress">Deskripsi</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" type="text"></textarea>
                    </div>
                    </div>
                


                    <div class="w-100"></div>

                    <br>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="w-100"></div>
                            <p><a href="#"class="btn btn-primary py-3 px-4">Tambah Produk</a></p>
                        </div>

                        
                    </div>

                    
            
                </div>
            </form><!-- END -->
                        </div>
                        
            </div>
        </div>
    </div>
    </div>
</section>

@endsection