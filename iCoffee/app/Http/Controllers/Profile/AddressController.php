<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Subdistrict;
use App\Helper\Helper;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPostalCode($id)
    {
        $subdistrict = Subdistrict::where('id', $id)->first();

        if ($subdistrict) {
            $postal_code = Helper::instance()->getPostalCode($subdistrict->name);

            if ($postal_code) {
                return response()->json($postal_code);
            }

        }

    }
}
