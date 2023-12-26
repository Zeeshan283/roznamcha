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
        // dd($user->id);

        $roznamchas = Roznamchas::where('khata_banam', '=', $admin->id)->with('admin')->get();
        $amount_recv = 0;
        $amount_paid = 0;

        foreach ($roznamchas as $entry) {
            if ($entry->amount_pk != null) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_pk;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_pk;
                }
            }

            if ($entry->amount_af != null) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_af;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_af;
                }
            }

            if ($entry->amount_usa != null) {
                if ($entry->state == 'جمع') {
                    $amount_paid += $entry->amount_usa;
                } elseif ($entry->state == 'بنام') {
                    $amount_recv += $entry->amount_usa;
                }
            }
        }

        return view('backend.pages.khatas.personal', compact('admin', 'amount_recv', 'amount_paid'));
    }
}
