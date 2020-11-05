<div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('updated'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($message = Session::get('delete'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="col">
        <label class="font-weight-bold">Rekening Bank</label>
        <button type="button" class="btn btn-sm btn-success float-right " data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus-circle fa-sm"></i> Tambah Rekening</button>
    </div>
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rekening Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addbank">
                        <div class="form-group">
                            <label  for="recipient-name" class="col-form-label">Bank</label>
                            <input wire:model="bank_name" type="text" class="form-control" name="bank_name" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Atas Nama</label>
                            <input wire:model="name" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Nomor Rekening</label>
                            <input wire:model="norek" type="number" class="form-control" name="norek" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button  type="submit" class="btn btn-success">Simpan</button>
                </div>
                    </form>
            </div>
        </div>
    </div>
        <table class="table table-responsive-sm table-hover mt-2">
            <thead>
              <tr>
                <th scope="col">Nama</th>
                <th scope="col">Bank</th>
                <th scope="col">Norek</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{$bank->name}}</td>
                        <td>{{$bank->bank_name}}</td>
                        <td>{{$bank->norek}}</td>
                        <td>
                        <button wire:click="update({{$bank->id}})" type="button" data-toggle="modal" data-target="#updateModal" class="btn btn-sm btn-info"><i class="fas fa-edit fa-sm"></i></button>
                        <button wire:click="delete({{$bank->id}})" type="button" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt fa-sm"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination justify-content-end">
            {{ $banks->links() }}
        </ul>
        <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Rekening Bank</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="updatebank">
                            <div class="form-group">
                                <label  for="recipient-name" class="col-form-label">Bank</label>
                                <input wire:model="bank_name" type="text" class="form-control" name="bank_name" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Atas Nama</label>
                                <input wire:model="name" type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Nomor Rekening</label>
                                <input wire:model="norek" type="number" class="form-control" name="norek" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button  type="submit" class="btn btn-success">Simpan</button>
                    </div>
                        </form>
                </div>
            </div>
        </div>
</div>


