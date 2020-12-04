function errorMessage(message){
    swal(
        'Gagal',
        message,
        'error'
    );
    
}

function successMessage(message){
    swal(
        'Berhasil',
        message,
        'success'
    );
}

function confirmMessage(ajax){
    swal({
        title: "Apakah Anda Yakin!?",
        type: "warning",
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Yes!",
        showCancelButton: true,
      }, ajax);
}

function timeout(syntax) {
    setTimeout(function(){
        syntax
        }, 1000);
}

