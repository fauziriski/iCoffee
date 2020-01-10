@extends('layout.app')
@section('header')
@endsection
@section('content')
@section('footer')
@endsection


<div class="container ftco-animate">
    <div class="text-center">
        <img src="logo.png" width="20%" height="20%" style="margin-top: 5%;">
    <h6 class="mb-4" style="margin-top: 1%">Belum punya akun? Daftar <a href ="{{url('register')}}">disini.</a></h6>
  </div>
  <div class="col-md-7 d-flex mb-5 mt-5 mx-auto">
    <div class="cart-detail cart-total p-3 p-md-4">
      <div class="container">
       <h4 class="text-center">Masuk</h4>
       <form method="POST" action="{{ route('login') }}">
        <div class="form-group col-sm-12 mt-4">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <label for="formGroupExampleInput" class="bmd-label-floating">Email</label>
          <input type="email" name="email" class="form-control" id="formGroupExampleInput">
        </div>
        <div class="form-group bmd-form-group col-sm-12"> <!-- manually specified --> 
          <label for="formGroupExampleInput2" class="bmd-label-floating">Password</label>
          <input type="password" name="password" class="form-control" id="formGroupExampleInput2">
        </div>
        <div class="form-group form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <p class="form-check-label" for="exampleCheck1">Tetap masuk</p>
          <p style="text-align: right; margin-top: -30px;">Lupa Password?</p>

        </div>
        <button type="submit" class="btn btn-primary mt-3 py-3">Masuk</button>
        <div class="text-center mt-3">atau</div>
        <a href="#" class="btn loginBtn--facebook mt-3 col-md-12 text-white py-3"><i class="fab fa-facebook-f fa-fw"></i> Login with Facebook</a>
        <br>
        <a href="#" class="btn loginBtn--google mt-2 col-md-12 text-white py-3"><i class="fab fa-google fa-fw"></i> Login with google</a>
      </form>
    </div>
  </div>
</div>
</div>

@endsection