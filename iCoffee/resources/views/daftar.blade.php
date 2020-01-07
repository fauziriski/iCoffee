@extends('layouts.app')
@section('header')
@endsection
@section('content')
@section('footer')
@endsection

@include('sweetalert::alert')


<div class="container ftco-animate">
    <div class="text-center">
        <img src="logo.png" width="20%" height="20%" style="margin-top: 10%">
    </div>
    <div class="col-md-7 d-flex mb-5 mt-5 mx-auto">
      <div class="cart-detail cart-total p-3 p-md-4">
        <div class="container">
            <h4 class="text-center">Daftar</h4>
           
            <form action="{{url('/daftar_user')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group col-sm-12 mt-4">
                    <label for="formGroupExampleInput" class="bmd-label-floating">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                    <span class="text-danger">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group col-sm-12 mt-4">
                    <label for="formGroupExampleInput" class="bmd-label-floating">Email</label>
                    <input type="email" class="form-control" name="email" value="{{old('email')}}"/>
                    <span class="text-danger">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group bmd-form-group col-sm-12"> <!-- manually specified --> 
                    <label for="formGroupExampleInput2" class="bmd-label-floating">Password</label>
                    <input type="password"  class="form-control" name="password" value="{{old('password')}}"/>
                    <span class="text-danger">{{$errors->first('password')}}</span>
                </div>
                <div class="form-group bmd-form-group col-sm-12"> <!-- manually specified --> 
                    <label for="formGroupExampleInput2" class="bmd-label-floating">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                    <span class="text-danger">{{$errors->first('password_confirmation')}}</span><br>
                </div>
                <button type="submit" class="btn btn-primary mt-5">Daftar</button>
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