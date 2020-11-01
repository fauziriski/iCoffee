@extends('jual-beli.layouts.app')
@section('title', 'Profle | Edit Profile')
@section('content')

    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
        <ul class="nav nav-pills justify-content-md-start mt-2 border-bottom justify-content-sm-around" id="pills-tab"
            role="tablist">
            <li class="nav-item p-2 flex-fill text-center">
                <a class="nav-link active" id="pills-edit-profile-tab" data-toggle="pill" href="#pills-edit-profile"
                    role="tab" aria-controls="pills-edit-profile" aria-selected="true">Edit Profile</a>
            </li>
            <li class="nav-item p-2 flex-fill text-center">
                <a class="nav-link" id="pills-edit-password-tab" data-toggle="pill" href="#pills-edit-password" role="tab"
                    aria-controls="pills-edit-password" aria-selected="false">Edit Password</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-edit-profile" role="tabpanel"
                aria-labelledby="pills-edit-profile-tab">
                <form action="/profile/edit_profile" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" name="nama" required
                                            value="{{ $user->name }}">
                                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <div class="input-group">
                                            <input type="email" class="form-control" placeholder="" name="email" required
                                                value="{{ $user->email }}">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password">Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="" placeholder="" name="password"
                                                required value="">
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary py-3 px-4">Edit Profile</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade show" id="pills-edit-password" role="tabpanel"
                aria-labelledby="pills-edit-password-tab">
                <form action="/profile/edit_password" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password_lama">Kata Sandi Lama</label>
                                        <div class="input-group">
                                            <input type="password" style="border-radius: 10px" class="form-control" id=""
                                                placeholder="" name="password_lama" required value="">
                                            <span class="text-danger">{{ $errors->first('password_lama') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password_baru">Kata Sandi Baru</label>
                                        <div class="input-group">
                                            <input type="password" style="border-radius: 10px" class="form-control" id=""
                                                placeholder="" name="password_baru" required value="">
                                            <span class="text-danger">{{ $errors->first('password_baru') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cek_password_baru">Ulangi Kata Sandi</label>
                                        <div class="input-group">
                                            <input type="password" style="border-radius: 10px" class="form-control" id=""
                                                placeholder="" name="cek_password_baru" required value="">
                                            <span class="text-danger">{{ $errors->first('cek_password_baru') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 col-sm-12 text-center">
                            <button type="submit" class="btn btn-primary py-3 px-4">Edit Password</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </main>
    </div>
    </div>
    </div>
    </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(function() {
                var hash = window.location.hash;
                hash && $('ul.nav a[href="' + hash + '"]').tab('show');
                $('.nav-tabs a').click(function(e) {
                    $(this).tab('show');
                    var scrollmem = $('body').scrollTop();
                    window.location.hash = this.hash;
                    $('html,body').scrollTop(scrollmem);
                });
            });

        });

    </script>

@endsection

@section('footer')

@endsection
