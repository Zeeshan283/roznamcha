<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SelfDeliveryThorkhams;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\ThorkhamOrders;

class ThorkhamController extends Controller
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
        if (is_null($this->user) || !$this->user->can('orders.thorkham.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view order !');
        }

        $thorkham = ThorkhamOrders::all();
        return view('backend.pages.orders.thorkham.index', compact('thorkham'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('orders.thorkham.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create roder !');
        }


        $thorkham  = ThorkhamOrders::all();
        $admins = Admin::all();
        $user_pak  = Admin::where('currency','pak')->get();
        $user_af  = Admin::where('currency','af')->get();
        return view('backend.pages.orders.thorkham.create', compact('thorkham','admins','user_pak','user_af'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $record = new ThorkhamOrders();
        $record->malwala = $request['malwala'];
        $record->musalsal_num = $request['musalsal_num'];
        $record->date = $request['date'];
        $record->city = $request['city'];
        $record->product = $request['product'];
        $record->vehicle_num = $request['vehicle_num'];
        $record->quantity = $request['quantity'];
        $record->detail = $request['detail'];
        $record->weight = $request['weight'];
        $record->weight_acc_to_50kg = $request['weight_acc_to_50kg'];
        $record->total_qty = $request['total_qty'];
        $record->narkh = $request['narkh'];
        $record->comission = $request['comission'];
        $record->ponch = $request['ponch'];
        $record->total = $request['total'];
        $record->gumrak_id	 = $request['gumrak_id'];
        $record->totl_gumrak = $request['totl_gumrak'];


        if ($request->hasFile('bilty')) {
            $image = $request->file('bilty');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/thorkham/self_order', $imageName);
        
            // Set the 'bilty' column to the file path
            $record->bilty = 'upload/thorkham/self_order/' . $imageName;
        }

        // dd($record);


        $record->save();

        session()->flash('success', 'Record created successfully');
        return redirect()->back();

    }

    public function selfdata(Request $request)
    {
        // dd($request->all());

        $record = new SelfDeliveryThorkhams();
        $record->musalsal_num = $request['t_musalsal_num'];
        $record->thorkham_staff_id = $request['t_thorkham_staff_id'];
        $record->custom = $request['t_custom'];
        $record->kustom_expense = $request['t_kustom_expense'];
        $record->custom_total = $request['t_custom_total'];
        $record->country = $request['t_country'];
        $record->detail_kiraya = $request['t_detail_kiraya'];
        $record->kiraya = $request['t_kiraya'];
        $record->labour = $request['t_labour'];
        $record->gumrak = $request['t_gumrak'];
        $record->expense = $request['t_expense'];
        $record->total_expense = $request['t_total_expense'];

        if ($request->hasFile('t_bilty')) {
            $image = $request->file('t_bilty');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/thorkham/selfdeliverythorkhams', $imageName);
        
            // Set the 'bilty' column to the file path
            $record->bilty = 'upload/thorkham/selfdeliverythorkhams/' . $imageName;
        }

        $record->save();

        session()->flash('success', 'Record created successfully');
        return redirect()->back();
    }

    public function edit($id)
    {
        $record = ThorkhamOrders::find($id);

        if (!$record) {
            // Handle the case where the record with the given ID is not found.
            return redirect()->back()->with('error', 'Record not found.');
        }

        return view('backend.pages.orders.thorkham.edit', ['record' => $record]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $record = ThorkhamOrders::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        $record->update($request->all());
        
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();

    }


    public function destroy($id)
    {
        $record = ThorkhamOrders::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        $record->delete();

        session()->flash('success','Record deleted successfully');
        return redirect()->back();
    }


    public function show($id)
    {
        // dd('hello');
        $record = ThorkhamOrders::find($id); 
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        return view('backend.pages.orders.thorkham.order', ['record'=> $record]);    

    } 

}