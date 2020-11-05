<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Rekening Bank</h5>
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
        </div>
    </div>
</div>