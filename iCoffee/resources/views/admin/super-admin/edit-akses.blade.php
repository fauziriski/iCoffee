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

						<form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
							@csrf							
							<div class="container">
								<div class="col-md-12">
									<div class="row">
										<div class="table-responsive col-md-12 col-sm-12">
											<table cellpadding="10" border="0">
													<div class="form-group">
														<th width="35%" style="text-align: center;">Pilih Hak Akses </th>	
														<th width="55%">
												

                                                        @foreach($permissions as $data)
														
                                                        <input type="checkbox" name="tampung[]" value="{{$data->id}}" {{ in_array($data->id, $role) ? "checked" : "" }}/>&nbsp;&nbsp;{{$data->name}}<br />
														
                                                      </div>
													
                                                        @endforeach
                                                        </div>
													</div>	
												</tr>
										</table>
									</div>
								</div>
								<br />
								<div align="right">
									<input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Simpan" />
								</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>





@endsection