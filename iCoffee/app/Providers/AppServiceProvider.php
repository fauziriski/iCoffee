<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use App\Order;
use App\Auction_Order;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Authenticated;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        Schema::defaultStringLength(191);

        Blade::directive('money', function ($amount) {
            return "<?php echo 'Rp. ' . number_format($amount, 2); ?>";
        });
        
        View::composer('*', function($view)
        {
            $count = 0;   
            if (Auth::check()){
                $count_order_produk = Order::where('id_penjual',Auth::id())->where('status', 3)->count();
                $count_order_lelang = Auction_Order::where('id_penjual',Auth::id())->where('status', 3)->count();

                $auction_winner = count(DB::select(
                    'SELECT * FROM `auction_winners` WHERE `id_pemenang` = '.Auth::id().' AND `status` = 1'));
                
                $cart = count(DB::select('SELECT * FROM `jbcarts` WHERE `id_pelanggan` = '.Auth::id()));
                

                $count_notif = $count_order_produk+$count_order_lelang;
                $count = array(
                    'count_order_produk' => $count_order_produk,
                    'count_order_lelang' => $count_order_lelang,
                    'count_notif' => $count_notif,
                    'cart' => $cart,
                    'auction_winner' => $auction_winner
                );
         
            }
        View::share('count_order', $count);

        });
        

       
    }
}
