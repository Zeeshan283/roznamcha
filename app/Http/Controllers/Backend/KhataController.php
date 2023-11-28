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
use App\Models\SelfDeliveryExpenseKharlachis;
use App\Models\SelfDeliveryExpenseGhulamkhan;
use App\Models\SelfDeliveryExpenseThorkhams;
use App\Models\SelfDeliveryExpenseWana;


class KhataController extends Controller
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
        if (is_null($this->user) || !$this->user->can('khatas.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view khatas !');
        }
        $currency = $this->user->currency;
        $roznamchas_pk = Roznamchas::where('country','=','Pakistan')->with('admin')->get();
        $roznamchas_usa = Roznamchas::where('country','=','USA')->with('admin')->get();
        $roznamchas_af = Roznamchas::where('country', 'Afghanistan')->with('admin')->get();


        $kharlachi = SelfDeliveryExpenseKharlachis::select('comission','name', 'musalsal_num',);
        $ghulamkhan = SelfDeliveryExpenseGhulamkhan::select('comission','name', 'musalsal_num',);
        $thorkham = SelfDeliveryExpenseThorkhams::select('comission','name', 'musalsal_num', );
        $wana = SelfDeliveryExpenseWana::select('comission','name', 'musalsal_num',);

        

        $roznamchas_afg = $ghulamkhan->union($kharlachi)->union($thorkham)->union($wana)->get();



        return view('backend.pages.khatas.index', compact('roznamchas_pk','roznamchas_af','roznamchas_afg','roznamchas_usa','currency'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('khatas.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create khatas !');
        }

        $roznamchas  = Roznamchas::all();
        return view('backend.pages.khatas.create', compact('roznamchas'));
    }

}