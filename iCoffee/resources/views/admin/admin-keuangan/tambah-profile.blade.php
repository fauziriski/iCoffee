@extends('admin.layout.master')

@section('title', 'Admin User | Tambah Profile ')

@section('content')

@section('css')

<style>
	/* input.form-control {
		width: auto;
	} */
</style>

@stop


<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h5 class="h5 mb-0 text-gray-800">Profile Admin</h5>
			</div>
			<!-- Card Body -->
			<div class="card-body mb-5">
				<div class="container-fluid mt-5">
					<div class="row">
						<div class="col-md-6">
						<form action="{{ route('adminkeuangan.profile.tambah') }}" enctype="multipart/form-data" method="POST">
								@csrf
								<div class="table-responsive">
								<table cellpadding="10" border="0">
									<tr>
										<th width="12%" style="text-align: right;">Foto&nbsp;&nbsp;&nbsp;:</th>
										<th width="25%"><img src="" name="foto" id="foto" width="100px" height="100px"/></th>
									</tr>
									<tr>
									<th></th>
									<th width="25%"><input type="file" class="form-control" name="foto"></th>
									</tr>
									<tr>
										<div class="form-group">
											<th width="12%" style="text-align: right;">Nama&nbsp;&nbsp;&nbsp;:</th>	
											<th width="25%"><input type="text" name="nama" id="nama" class="form-control"/></th>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th width="12%" style="text-align: right;">No Hp&nbsp;&nbsp;&nbsp;:</th>				
											<th width="25%"><input type="tel" name="no_hp" id="no_hp" class="form-control"/></th>
										</div>
									</tr>
									<tr>
										<div class="form-group">
											<th width="12%" style="text-align: right;">Alamat&nbsp;&nbsp;&nbsp;:</th>	
											<th width="25%"><textarea name="alamat" name="alamat" id="alamat" class="form-control"></textarea></th>
										</div>
									</tr>
										
									</table>
									<br/>
									<div align="right">
										<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
									</div>
							</form>
						</div>
						</div>


					<div class="col-md-6">
						<form action="{{ route('adminkeuangan.profile2.update') }}" enctype="multipart/form-data" method="POST">
							@csrf
							<div class="container">
							<div class="table-responsive">
							<table cellpadding="10" border="0">
								<tr>
									<div class="form-group">
										<th colspan="2"></th>	
								</tr>
								<tr>
									<div class="form-group">
									<th colspan="2"></th>	
								</tr>
								<tr>
									<div class="form-group">
										<th width="12%" style="text-align: right;">Role Admin&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><input type="text" name="role_admin" id="role_admin" class="form-control" value="{{$role}}" readonly/></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="12%" style="text-align: right;">Email&nbsp;&nbsp;&nbsp;:</th>	
										<th width="25%"><input type="email" name="email" id="email" class="form-control" value="{{$data2->email}}"/></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="12%" style="text-align: right;">Password&nbsp;&nbsp;&nbsp;:</th>
										<th width="25%"><input type="password" name="password" id="password" class="form-control"/></th>
									</div>
								</tr>
								<tr>
									<div class="form-group">
										<th width="12%" style="text-align: right;">Confirm Password&nbsp;&nbsp;&nbsp;:</th>
										<th width="25%"><input type="password" name="password_confirmation" id="password_confirmation" class="form-control"/></th>
									</div>	
								</tr>
						
								</table>
								<br>
								<div align="right">
										<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan Data</button>
									</div>

						</form>
						
				</div>
			</div>
	</div>
</div>





@endsection



