<div>
    <div class="row">
        <div class="col-8">
          <h5 class="mt-3">Mulai Pembiayaan di sini...</h5>
        </div>
        <div class="col-4">
            <div class="input-group">
                <input wire:model="search_product" type="text" class="form-control float-right  small" placeholder="Pencarian..">
                <div class="input-group-append">
                  <button class="btn btn-success" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
        </div>
    </div>
        
    <hr>
    <br>
    <div class="row">
        @forelse($products as $data)
            <div class="col-md-6 col-lg-3 ftco-animate fadeInUp ftco-animated">
                <div class="product">
                    <a href="/invest/produk/{{ $data->id }}" class="img-prod"><img class="img-fluid" src="{{ url('/Uploads/Investasi/Produk/'.$data->kode_produk.'/'.$data->gambar) }}" alt="Colorlib Template">
                        <div class="overlay"></div>
                    </a>
                    <div class="text py-3 pb-4 px-3 text-center">
                        <h3><a href="/invest/produk/{{ $data->id }}">{{ Str::limit($data->nama_produk,30) }}</a></h3>
                        <div class="d-flex">
                            <div class="pricing">
                                <p class="price"><span class="price-sale">@money($data->harga) / Unit</span></p>
                            </div>
                        </div>
                        <div class="bottom-area d-flex px-3">
                            <div class="m-auto d-flex">
                                <a href="/invest/produk/{{ $data->id }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                    <span><i class="ion-ios-menu"></i></span>
                                </a>
                                <a href="cart.html" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                    <span><i class="ion-ios-cart"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="font-weight-bold text-center">Data Tidak Tersedia</p>
        @endforelse
    </div>
    <div class="row mt-5">
        <div class="col text-center">
            <div class="block-27">
                <ul>
                    {{ $products->render() }}
                </ul>
            </div>
        </div>
    </div>
</div>
