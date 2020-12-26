@extends('investasi.mitra.layout.master')
@section('title', 'Investasi | Mitra Investasi')
@section('content')
	@livewire('investasi.mitra.laporan-penjualan')
@endsection
@section('js')
	<script type="text/javascript">
		window.livewire.on('userStore', () => {
			$('#exampleModal').modal('hide');
		});
	</script>
	<script type="text/javascript">
		window.livewire.on('setorModal', () => {
			$('#setorPenjualan').modal('hide');
		});
	</script>
	<script>
		window.setTimeout(function() {
			$(".alert").fadeTo(1000, 0).slideUp(1000, function(){
				$(this).remove(); 
			});
		}, 10000);   
	</script>
@endsection