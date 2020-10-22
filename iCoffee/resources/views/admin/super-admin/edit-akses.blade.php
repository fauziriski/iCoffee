@extends('admin.layout.master')

@section('title', 'Admin | Edit Hak Akses')

@section('content')

@section('css')


@stop


<body id="page-top">
	<!-- Begin Page Content -->
	<div class="container-fluid">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h5 class="h5 mb-0 text-gray-800">Edit Hak Akses</h5>
			</div>
			<!-- Card Body -->
			<div class="card-body mb-5">
				<div class="container-fluid mt-5">

					<form action="{{ route('superadmin.update-akses') }}" enctype="multipart/form-data" method="POST">
							@csrf		
							<input type="hidden" name="id" value="{{$akses->id}}"/>			
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive col-md-12 col-sm-12">
											<table cellpadding="10" border="0">
													<div class="form-group">
														<tr>
														<th width="30%"></th>
														<th width="20%" style="text-align: center;">Pilih Hak Akses : </th>	
														<th widtg="50%">
                                                        @foreach($permissions as $data)
                                                       		 <input type="checkbox" name="tampung[]" value="{{$data->id}}" {{ in_array($data->id, $role) ? "checked" : "" }}/>&nbsp;&nbsp;{{$data->name}}<br />
                                                        @endforeach
														</tr>
														<tr>
															<th width="30%"></th>
															<th width="20%"></th>	
															<th widtg="50%"></th>	
														</tr>
														<tr>
															<th width="30%"></th>
															<th width="20%"></th>	
															<th widtg="50%"><input type="submit" class="btn btn-primary" id="submit" value="Simpan" /></th>
														
													</tr>
													</div>
                                                </div>
											</div>	
										</tr>
								</table>
							</div>
						</div>
						<br />
								
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


@endsection

