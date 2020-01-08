<script src="{{ asset('js/sweetalert.all') }}"></script>

@if (Session::has('alert.config'))
<script>
	Swal.fire({!! Session::pull('alert.config') !!});
</script>
@endif
