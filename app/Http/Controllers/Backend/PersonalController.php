<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Roznamchas;
use App\Models\GhulamkhanOrders;
use App\Models\KharlachiOrders;
use App\Models\ThorkhamOrders;
use App\Models\WanaOrders;



class PersonalController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }

    public function index($id)
    {
        if (is_null($this->user) || !$this->user->can('khata.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view personal khata !');
        }
        
        $admin = Admin::findOrFail($id);
        
        $roznamchas = Roznamchas::where('khata_banam','=',$id)->with('admin')->get();
        $amount_recv = 0;
        $amount_paid = 0;
        if($admin->currency == "PK"){
            foreach ($roznamchas as $entry) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_pk;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_pk;
                }
            }
        }
        if($admin->currency == "AF"){
            foreach ($roznamchas as $entry) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_af;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_af;
                }
            }
        }
        if($admin->currency == "USD"){
            foreach ($roznamchas as $entry) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_usa;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_usa;
                }
            }
        }

        // $ghulamkhan = GhulamkhanOrders::where('malwala','=',$id)->with('admin')->get();
        // $kharlachi = KharlachiOrders::where('malwala','=',$id)->with('admin')->get();
        // $thorkham = ThorkhamOrders::where('malwala','=',$id)->with('admin')->get();
        // $wana = WanaOrders::where('malwala','=',$id)->with('admin')->get();
    

        return view('backend.pages.khatas.personal', compact('admin', 'amount_recv', 'amount_paid'));
    }
}