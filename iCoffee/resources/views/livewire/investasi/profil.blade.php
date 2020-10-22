<div>
    <form wire:submit.prevent="update">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <img class="shadow-lg p-3 mb-2 mt-2 mx-auto d-block" style="height: 150px; width: 150px; border-radius: 50%; boxSizing: border-box; overflow: hidden;"  src="{{ $photo != null ? $photo->temporaryUrl() : ($foto != null ? asset('Uploads/Investasi/Profil/'.$foto) : asset('picture-default.png')) }}" id="image" >
        @error('photo') <small style="color:red" class="text-center form-text">File diatas 1MB</small>@enderror
        <small id="emailHelp" class="form-text text-center text-muted" >(Format: JPG/PNG, Max 1MB)</small>
        <input type="file" id="myfile" style="display: none;" accept="image/png, image/jpg, image/jpeg" wire:model="photo">
    
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input wire:model="name"  type="text" class="form-control" name="norek">
                    <span class="text-danger">{{$errors->first('nama_produk')}}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="harga">Email</label>
                    <div class="input-group">
                        <input wire:model="email"  type="email" class="form-control"  name="nominal">
                        <span class="text-danger">{{$errors->first('name')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama">Password</label>
                    <input wire:model="password" type="password" class="form-control" name="norek">
                    @error('password') 
                        <small style="color:red" class="form-text">
                            Password minimal 8 karakter
                        </small>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="harga">Nomor Telepon</label>
                    <div class="input-group">
                        <input wire:model="telephone" type="number" class="form-control" min="1" name="nominal">
                    </div>
                </div>
            </div>
        </div>

        <button class="btn btn-success float-right" type="submit">Update</button>
    </form>

    @section('scripts')
        <script>
            $('#image').click(function(){
                $('#myfile').click()
            })
        </script>
        <script>
            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 10000);   
        </script>
        <script type="text/javascript">
            window.livewire.on('userStore', () => {
                $('#exampleModal').modal('hide');
            });
        </script>
        <script type="text/javascript">
            window.livewire.on('update', () => {
                $('#updateModal').modal('hide');
            });
        </script>
    @endsection
</div>
