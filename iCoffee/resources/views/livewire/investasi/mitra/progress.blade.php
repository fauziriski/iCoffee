<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <form wire:submit.prevent="store">
        <div class="form-group mt-0">
            <label for="exampleInputEmail1">Produk Investasi</label>
            <div class="select-wrap">
                <select wire:model="product" class="form-control" required>
                    <option selected value="">Pilih Produk</option>
                    @foreach ($products as $product)
                        <option  value="{{$product->kode_produk}}">{{$product->nama_produk}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Judul Pengajuan</label>
            <input wire:model="judul" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Deskripsi</label>
            <textarea wire:model="deskripsi" class="form-control" required ></textarea>
        </div>
        <div wire:ignore class="row">
            <div class="col-sm">
                <p>Video</p>
                <small class="form-text text-muted">(Pilih satu atau lebih file video, Max 40MB)</small>
                <div id="file-js-example" class="file has-name is-boxed">
                    <label class="file-label">
                        <input class="file-input" wire:model="videos" type="file" accept="video/*" required multiple>
                        <span class="file-cta">
                            <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Pilih File
                        </span>
                        </span>
                        <span id="nama-file" class="file-name">
                            File belum diupload
                        </span>
                    </label>
                </div>
                <div wire:loading wire:target="videos">Uploading...
                    <div style="color: #785ebb" class="la-ball-atom">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <p>Foto</p>
                <small class="form-text text-muted">(Pilih satu atau lebih file foto, Max 2MB)</small>
                <div id="file-foto" class="file has-name is-boxed">
                    <label class="file-label">
                        <input  class="file-input" wire:model="photos" type="file" accept="image/*" required multiple>
                            <span class="file-cta">
                                <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Pilih File
                            </span>
                            </span>
                        <span  class="file-name">
                            File belum diupload
                        </span>
                    </label>
                </div>
                <div wire:loading wire:target="photos">Uploading...
                    <div style="color: #785ebb" class="la-ball-atom">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="row">
            <div class="col">
                @error('videos.*') 
                    <small style="color:red" class="form-text">
                        File Video Terlalu Besar
                    </small>
                @enderror
            </div>
            <div class="col">
                @error('photos.*') 
                    <small style="color:red" class="form-text">
                        File Foto Terlalu Besar
                    </small>
                @enderror
            </div>
        </div>
        <a class="btn btn-secondary mt-5" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Riwayat Progress
        </a>
        <button type="submit" class="btn btn-success float-right mt-5 mb-3">Submit</button>
    </form>
    <div class="collapse" id="collapseExample">
        <div class="accordion mt-5 mb-5" id="accordionExample">
            @forelse($progress as $item)
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                                #{{$loop->iteration}} - {{$item->judul}}
                                  @if($item->status == 1)
                                     <span class="badge badge-warning float-right">Belum Divalidasi</span>
                                      @elseif($item->status == 0)
                                    <span class="badge badge-danger float-right">Ditolak</span>
                                        @elseif($item->status == 2)
                                    <span class="badge badge-success float-right">Divalidasi</span>
                                        @elseif($item->status == 3)
                                    <span class="badge badge-info float-right">On Progress</span>
                                        @endif
                            </button>
                        </h2>
                    </div>
                    <div id="collapse{{$item->id}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <p>Tanggal: {{$item->created_at}}
                            <p>Deskripsi: {{$item->deskripsi}}</p>
                            <div class="row">
                                @foreach($item->files as $i)
                                    @if($i->type == 'video')
                                        <div class="col">
                                            <p>Video:</p>
                                            <video width="400" controls>
                                                <source src="{{ asset('/Uploads/Investasi/Produk/'.$item->kode_produk.'/'.$i->nama) }}">
                                                Your browser does not support HTML video.
                                            </video>
                                        </div>
                                    @endif
                                    @if($i->type == 'photo')
                                        <div class="col">
                                            <p>Foto:</p>
                                            <img height="300px" width="400px" src="{{ asset('/Uploads/Investasi/Produk/'.$item->kode_produk.'/'.$i->nama) }}">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h6>Data Tidak Tersedia</h6>
            @endforelse
        </div>
    </div>
</div>
