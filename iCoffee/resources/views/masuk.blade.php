@extends('layouts.app')
@section('header')
@endsection
@section('content')
@section('footer')
@endsection

<div class="container ftco-animate">
	<div class="text-center">
		<img src="logo.png" width="20%" height="20%" style="margin-top: 5%">
    <h6 class="mb-4" style="margin-top: 1%">Belum punya akun? Registrasi disini.</h6>
  </div>
    <div class="col-md-6 d-flex mb-5 mt-5 mx-auto">
      <div class="cart-detail cart-total p-3 p-md-4">
        <div class="container">
            <h4>Masuk</h4>
            <small class="text-muted">Silahkan masuk disini</small>
            <form>
              <div class="form-group col-sm-12">
                <label for="formGroupExampleInput" class="bmd-label-floating">Email</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
              </div>
              <div class="form-group bmd-form-group col-sm-12"> <!-- manually specified --> 
                <label for="formGroupExampleInput2" class="bmd-label-floating">Password</label>
                <input type="text" class="form-control" id="formGroupExampleInput2">
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <p class="form-check-label" for="exampleCheck1">Tetap masuk</p>
                  <p style="text-align: right; margin-top: -30px;">Lupa Password?</p>
               
              </div>
              <a href="#" class="btn btn-primary">Masuk</a>
              <div class="text-center mt-3">atau</div>
              <a href="#" class="btn loginBtn--facebook mt-3 col-md-12 text-white"><i class="fa fa-facebook-f white-text"></i> Login with Facebook</a>
              <br>
              <a href="#" class="btn loginBtn--google mt-2 col-md-12 text-white"><i class="fa fa-google-plus"></i> Login with google</a>
            </form>
  </div>
      </div>
    </div>
	</div>
@endsection