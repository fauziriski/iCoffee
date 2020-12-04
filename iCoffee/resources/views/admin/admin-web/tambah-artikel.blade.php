@extends('admin.layout.master')

@section('title', 'Admin Web | Tambah Artikel')

@section('content')

@section('css')


@stop

<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">

		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h5 class="h5 mb-0 text-gray-800">Tambah Artikel Blog</h5>
			</div>
			<!-- Card Body -->
			<div class="card-body">
			<form action="{{ route('superadmin.artikel.store') }}" enctype="multipart/form-data" method="POST">
					@csrf
						<div class="form-group">
							@if($errors->has('judul'))
								<div class="alert alert-danger">
									<strong>{{ $errors->first('judul') }}</strong>
								</div>
							@endif
							<label>Judul Artikel</label>
							<input type="text" class="form-control" name="judul">
						</div>

					<div class="form-group">
						@if($errors->has('gambar'))
							<div class="alert alert-danger">
								<strong>{{ $errors->first('gambar') }}</strong>
							</div>
						@endif
						<label>Gambar</label>
						<input type="file" class="form-control" name="gambar">
					</div>

					<div class="form-group">
						<label>Kategori Artikel</label>
						<select name="categoris_id" class="form-control">
							@foreach ($categori as $item)
								<option value={{$item->id}}>{{$item->nama_kategori}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label>Isi Artikel</label>
						@if($errors->has('body'))
						<div class="alert alert-danger">
							<strong>{{ $errors->first('body') }}</strong>
						</div>
						@endif
						<textarea name="body" id="editor1" class="textarea" placeholder="Place some text here"
								style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
						</textarea>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary">Tambah Artikel</button>
						<a href="{{url('akses-superadmin/artikel-blog')}}" class="btn btn-danger">Kembali</a>
					</div>

				</form>
			</div>
		</div>


@endsection
@section('js')

<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/[version.number]/[distribution]/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'editor1' );
</script>
	@stop