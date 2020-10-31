@extends('jual-beli.layouts.app')
@section('title', 'Profile | Top Up')
@section('content')


    <main class="col bg-faded py-1 border flex-grow-1 mt-2" style="border-radius: 20px">
        <h2 class="text-center">Top Up Saldo</h2>
        <form action="/profile/top_up/proses" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row align-items-end mt-2 pl-4 pr-4 mb-5">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <div class="select-wrap">
                            <select name="bank" id="" class="form-control" required>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="Mandiri">Mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" min="50000" placeholder="Contoh : 50000"
                            max="1000000" required>
                        <span class="text-danger">{{ $errors->first('jumlah') }}</span>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary py-3 px-4">Top Up</button>
                </div>

            </div>
        </form>
    </main>
    </div>
    </div>
    </div>
    </div>
    </section>
@endsection
