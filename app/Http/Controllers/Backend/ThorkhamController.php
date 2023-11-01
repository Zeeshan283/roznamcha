<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\SelfDeliveryExpenseThorkhams;
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

        if($request['sde_munafa'] == '' ){
            $record = new SelfDeliveryThorkhams();
            $record->musalsal_num = $request['musalsal_num'];
            $record->name1 = $request['name1'];
            $record->name2 = $request['name2'];
            $record->date = $request['date'];
            $record->kharcha = $request['kharcha'];
            $record->vehicle_num = $request['vehicle_num'];
            $record->details = $request['details'];
            $record->save();
        }
        else {
            $self_record = new SelfDeliveryExpenseThorkhams();
            $self_record->malwala = $request['malwala'];
            $self_record->musalsal_num = $request['sde_musalsal_num'];
            $self_record->ecchange_rate = $request['sde_ecchange_rate'];
            $self_record->total_af = $request['sde_total_af'];
            $self_record->munafa = $request['sde_munafa'];
     
            $self_record->save();    
        }
    
        
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