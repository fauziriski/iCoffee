@extends('layout.app')
@section('header')
@endsection

@section('content')

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Syarat dan Ketentuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <ul id="sk-group" class="list-group list-group-flush">
                <li class="list-group-item" id="sk-item">1. Cras justo odio</li>
            </ul>
        </div>
    </div>
    </div>
</div>
@section('footer')
@endsection


@include('sweetalert::alert')


<div class="container ftco-animate">
    <div class="text-center">
        <img src="{{ asset('landing_page/images/LOGO.png') }}" style="margin-top: 5%">
    </div>
    <div class="col-md-7 d-flex mb-5 mt-5 mx-auto">
      <div class="cart-detail cart-total p-3 p-md-4">
        <div class="container">
            <h4 class="text-center">Daftar</h4>
           
            <form method="POST" action="{{ route('register') }}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group col-sm-12 mt-4">
                    <label for="formGroupExampleInput" class="bmd-label-floating">Nama</label>

                    @if(!empty($name))
                    <input type="text" class="form-control" name="name" value="{{ $name }}"/>
                    <span class="text-danger">{{$errors->first('name')}}</span>
                    @else
                    <input type="text" class="form-control" name="name" value="{{old('name')}}"/>
                    @endif

                </div>
                <div class="form-group col-sm-12 mt-4">
                    <label for="formGroupExampleInput" class="bmd-label-floating">Email</label>

                    @if(!empty($email))
                    <input type="email" class="form-control" name="email" value="{{ $email }}"/>
                    <span class="text-danger">{{$errors->first('email')}}</span>
                    @else
                    <input type="email" class="form-control" name="email" value="{{old('email')}}"/>
                    @endif

                </div>
                <div class="form-group bmd-form-group col-sm-12"> <!-- manually specified --> 
                    <label for="formGroupExampleInput2" class="bmd-label-floating">Password</label>
                    <input type="password"  class="form-control" name="password" value="{{old('password')}}"/>
                    <span class="text-danger">{{$errors->first('password')}}</span>
                </div>
                <div class="form-group bmd-form-group col-sm-12" style="margin-bottom: 0px"> <!-- manually specified --> 
                    <label for="formGroupExampleInput2" class="bmd-label-floating">Konfirmasi Password</label>
                    <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}"/>
                    <span class="text-danger">{{$errors->first('password_confirmation')}}</span><br>
                </div>
                <div class="form-group bmd-form-group col-sm-12" style="margin-top: 0px"> <!-- manually specified --> 
                    <label for="formGroupExampleInput2" class="bmd-label-floating">
                        Dengan mendaftar, saya menyetujui 
                        <a href="#" name="term_condition" data-toggle="modal" data-target="#exampleModalLong">Syarat dan Ketentuan </a>
                        
                    </label>
                </div>

                <button type="submit" class="btn btn-primary mt-3 py-3">Daftar</button>
                <div class="text-center mt-3">atau</div>
                <a href="{{ url('login/facebook') }}" class="btn loginBtn--facebook mt-3 col-md-12 text-white py-3"><i class="fab fa-facebook-f fa-fw"></i> Daftar dengan Facebook</a>
               <br>
                 <a href="{{ url('login/google') }}" class="btn loginBtn--google mt-2 col-md-12 text-white py-3"><i class="fab fa-google fa-fw"></i> Daftar dengan google</a>
            </form>
        </div>
    </div>
</div>


</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        
        $('a[name="term_condition"]').on('click', function() {
            $.ajax({
                    url: "/term-condition",
                    method: "GET",
                    success: function(data) {
                        // console.log(data[1]);
                        var z = 0;
                    $('#sk-group').empty();
                    for (i=0; i < data.length; i++) {
                  
                        if (data[i].branch == null) {
                            var z = z+1
                            $('#sk-group').append('<li class="list-group-item" id="sk-item">'+z+
                            '.'+data[i].text+'</li>');   
                        } else {
                            var number
                            var branchs
                            if (branchs == data[i].branch) {
                                number = ++number
                                $('#sk-group').append('<li class="list-group-item" id="sk-item">'+z+
                            '.'+ number+'.'+data[i].text+'</li>');
                            }
                            else {
                                var number = 1
                                branchs = data[i].branch;
                                $('#sk-group').append('<li class="list-group-item" id="sk-item">'+z+
                            '.'+ number+ '.'+data[i].text+'</li>');

                            }
                        }
                    
                    }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        errorMessage('Gagal Membuka Syarat Dan Kondosi');
                    }
                });
        });
    });
</script>

@endsection