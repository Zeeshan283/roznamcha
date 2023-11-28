<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Roznamchas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\GhulamkhanOrders;
use App\Models\KharlachiOrders;
use App\Models\ThorkhamOrders;
use App\Models\WanaOrders;

class DashboardController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {
        if (is_null($this->user) || !$this->user->can('dashboard.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view dashboard !');
        }

        $total_roles = count(Role::select('id')->get());
        $total_admins = count(Admin::select('id')->get());
        $total_permissions = count(Permission::select('id')->get());

        // ordes logic implemented here with calculation 

        $users = Admin::where('username','!=','admin')->select('id', 'name')->take(10)->get();
        $userDetails = [];

        foreach ($users as $user) {
            // Get the Roznamcha details for the specific user
            $roznamcha = Roznamchas::where('khata_banam', $user->id)->get();
    
            // Initialize variables to store separate sums
            $pk_jama = 0;
            $pk_bnam = 0;
            $af_jama = 0;
            $af_bnam = 0;
            $usa_jama = 0;
            $usa_bnam = 0;
    
            // Loop through Roznamcha entries to calculate sums
            foreach ($roznamcha as $entry) {
                if ($entry->state == 'جمع') {
                    if ($entry->country == 'Pakistan') {
                        $pk_jama += $entry->amount_pk;
                    } elseif ($entry->country == 'Afghanistan') {
                        $af_jama += $entry->amount_af;
                    } elseif ($entry->country == 'USA') {
                        $usa_jama += $entry->amount_usa;
                    }
                } elseif ($entry->state == 'بنام') {
                    if ($entry->country == 'Pakistan') {
                        $pk_bnam += $entry->amount_pk;
                    } elseif ($entry->country == 'Afghanistan') {
                        $af_bnam += $entry->amount_af;
                    } elseif ($entry->country == 'USA') {
                        $usa_bnam += $entry->amount_usa;
                    }
                }
            }

            $total_jama = $pk_jama + $af_jama + $usa_jama ;
            $total_bnam = $pk_bnam + $af_bnam + $usa_bnam;
            $user_name = $user->name;

            // Store user details and calculated totals in an array
            $userDetails[] = [
                'user' => $user_name,
                'total_jama' => $total_jama,
                'total_bnam' => $total_bnam,

            ];
        }
    
    
        $orderDetails = [];
        
        $ghulamkhan_profit_pk = 0;
        $ghulamkhan_loss_pk = 0;
        $ghulamkhan_profit_af = 0;
        $ghulamkhan_loss_af = 0;
        
        $kharlachi_profit_pk = 0;
        $kharlachi_loss_pk = 0;
        $kharlachi_profit_af = 0;
        $kharlachi_loss_af = 0;
        
        $wana_profit_pk = 0;
        $wana_loss_pk = 0;
        $wana_profit_af = 0;
        $wana_loss_af = 0;
        
        $thorkham_profit_pk = 0;
        $thorkham_loss_pk = 0;

        // Ghulam Khan Orders
        $ghulamkhan_orders = GhulamkhanOrders::all();
        foreach ($ghulamkhan_orders as $ghulamkhan) {
            $pk_jama = 0;
            $pk_bnam = 0;
            $af_jama = 0;
            $af_bnam = 0;

            $ghulamkhan_profit_pk += $pk_jama;
            $ghulamkhan_loss_pk += $pk_bnam;
            $ghulamkhan_profit_af += $af_jama;
            $ghulamkhan_loss_af += $af_bnam;
            
        }
        $orderDetails[] = [
            'title_profit' => 'غلام خان منافع کلدار',
            'title_loss' => 'غلام خان نقصان کلدار',
            'profit' => $ghulamkhan_profit_pk,
            'loss' => $ghulamkhan_loss_pk,

        ];
        $orderDetails[] = [
            'title_profit' => 'غلام خان منافع افعانی',
            'title_loss' => 'غلام خان نقصان افعانی',
            'profit' => $ghulamkhan_profit_af,
            'loss' => $ghulamkhan_loss_af,

        ];
        
        // Kharlachi Orders
        $kharlachi_orders = KharlachiOrders::all();
        foreach ($kharlachi_orders as $kharlachi) {
            $pk_jama = 0;
            $pk_bnam = 0;
            $af_jama = 0;
            $af_bnam = 0;

            $kharlachi_profit_pk += $pk_jama;
            $kharlachi_loss_pk += $pk_bnam;
            $kharlachi_profit_af += $af_jama;
            $kharlachi_loss_af += $af_bnam;
            
        }
        $orderDetails[] = [
            'title_profit' => 'خرلاچی منافع کلدار',
            'title_loss' => 'خرلاچی نقصان کلدار',
            'profit' => $kharlachi_profit_pk,
            'loss' => $kharlachi_loss_pk,

        ];
        $orderDetails[] = [
            'title_profit' => 'خرلاچی منافع افعانی',
            'title_loss' => 'خرلاچی نقصان افعانی',
            'profit' => $kharlachi_profit_af,
            'loss' => $kharlachi_loss_af,

        ];
        
        // Wana Orders
        $wana_orders = WanaOrders::all();
        foreach ($wana_orders as $wana) {
            $pk_jama = 0;
            $pk_bnam = 0;
            $af_jama = 0;
            $af_bnam = 0;

            $wana_profit_pk += $pk_jama;
            $wana_loss_pk += $pk_bnam;
            $wana_profit_af += $af_jama;
            $wana_loss_af += $af_bnam;
            
        }
        $orderDetails[] = [
            'title_profit' => 'Wana Profit PK',
            'title_loss' => 'Wana Loss PK',
            'profit' => $wana_profit_pk,
            'loss' => $wana_loss_pk,

        ];
        $orderDetails[] = [
            'title_profit' => 'Wana Profit AF',
            'title_loss' => 'Wana Loss AF',
            'profit' => $wana_profit_af,
            'loss' => $wana_loss_af,

        ];
        
                
        // Thorkham Orders
        $thorkham_orders = ThorkhamOrders::all();
        foreach ($thorkham_orders as $thorkham) {
            $pk_jama = 0;
            $pk_bnam = 0;
            $af_jama = 0;
            $af_bnam = 0;

            $thorkham_profit_pk += $pk_jama;
            $thorkham_loss_pk += $pk_bnam;
        }
        $orderDetails[] = [
            'title_profit' => 'طورخم منافع کلد',
            'title_loss' => 'طورخم نقصان کلدار',
            'profit' => $thorkham_profit_pk,
            'loss' => $thorkham_loss_pk,

        ];
        
        $still_free = 0;

    
        // Roznamchas
        $roznamcha = Roznamchas::all();
        $pk_jama = 0;
        $pk_bnam = 0;
        $af_jama = 0;
        $af_bnam = 0;
        $usa_jama = 0;
        $usa_bnam = 0;

        foreach ($roznamcha as $entry) {
            if ($entry->state == 'جمع') {
                if ($entry->country == 'Pakistan') {
                    $pk_jama += $entry->amount_pk;
                } elseif ($entry->country == 'Afghanistan') {
                    $af_jama += $entry->amount_af;
                } elseif ($entry->country == 'USA') {
                    $usa_jama += $entry->amount_usa;
                }
            } elseif ($entry->state == 'بنام') {
                if ($entry->country == 'Pakistan') {
                    $pk_bnam += $entry->amount_pk;
                } elseif ($entry->country == 'Afghanistan') {
                    $af_bnam += $entry->amount_af;
                } elseif ($entry->country == 'USA') {
                    $usa_bnam += $entry->amount_usa;
                }
            }
        }

        $totak_pk = $pk_jama - $pk_bnam;
        $toak_af = $af_jama - $af_bnam;
        $total_usa = $usa_jama - $usa_bnam;

        return view('backend.pages.dashboard.index', compact('total_admins', 'total_roles', 'total_permissions','userDetails', 'orderDetails', 'totak_pk','toak_af','total_usa', 'still_free'));
    }

    public function invoice()
    {
        return view('backend.pages.invoice.index');
    }

 }
