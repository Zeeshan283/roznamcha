<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherDeliveryWana;
use App\Models\SelfDeliveryExpenseWana;
use App\Models\SelfDeliveryWana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\WanaOrders;

class WanaController extends Controller
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
        if (is_null($this->user) || !$this->user->can('orders.wana.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view order !');
        }


        $WanaOrders = WanaOrders::with('self', 'expense')->with('admin')->get();

        return view('backend.pages.orders.wana.index', compact('WanaOrders'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('orders.wana.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create order !');
        }

        $wana  = WanaOrders::all();
        $admins  = Admin::all();
        $user_pak = Admin::where('currency','pak')->get();
        $user_af = Admin::where('currency','af')->get();
        return view('backend.pages.orders.wana.create', compact('wana', 'admins','user_pak','user_af'));
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'name1' => 'required|string',
            'name2' => 'required|string',
            'n_plate' => 'required|string',
            'port' => 'required|string',
            'p_of_d' => 'required|string',
            'n_plate_usd' => 'required|integer',
            'product' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);

        $record = new WanaOrders();
        $record->musalsal_num = $request->input('musalsal_num');
        $record->name1 = $request->input('name1');
        $record->name2 = $request->input('name2');
        $record->vehicle_num = $request->input('n_plate');
        $record->port = $request->input('port');
        $record->p_of_d = $request->input('p_of_d');
        $record->n_plate_usd = $request->input('n_plate_usd');
        $record->product = $request->input('product');
        $record->quantity = $request->input('quantity');
        $record->weight = $request->input('weight');
        $record->date = $request->input('date');
        $record->save();


        session()->flash('success', 'Record created successfully');

        return redirect()->back();
        ;

    }

    public function wselfexpense(Request $request)
    {
        // dd($request->all());    
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'comission' => 'required|string',
            'name' => 'required|string',
        ]);
        
        $record = new SelfDeliveryExpenseWana();
        $record->musalsal_num = $request->input('musalsal_num');
        $record->comission = $request->input('comission');
        $record->name = $request->input('name');
        $record->save();

        
        session()->flash('success', 'Record created successfully');
        return redirect()->back();
    }
    public function wself(Request $request)
        {
            // dd($request->all());
            $validatedData = $request->validate([
                'musalsal_num' => 'required|string',
                'name' => 'required|string',
                'exchange_rate' => 'required|string',
                'amount' => 'required|string',
            ]);
            
            $record = new SelfDeliveryWana();
            $record->musalsal_num = $request->input('musalsal_num');
            $record->name = $request->input('name');
            $record->exchange_rate = $request->input('exchange_rate');
            $record->amount = $request->input('amount');
            $record->save();

            
            session()->flash('success', 'Record created successfully');
            return redirect()->back();
        }

    public function edit($id)
    {

        $record = WanaOrders::find($id);

        $self = SelfDeliveryWana::where('musalsal_num',$record->id)->with('admin')->first();
        $self_expense = SelfDeliveryExpenseWana::where('musalsal_num',$record->id)->first();

        $admins  = Admin::all();
        $wana  = WanaOrders::all();
        return view('backend.pages.orders.wana.edit',compact('admins','wana','record','self','self_expense') );
    }

    public function update(Request $request, $id) {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'name1' => 'required|string',
            'name2' => 'required|string',
            'n_plate' => 'required|string',
            'port' => 'required|string',
            'p_of_d' => 'required|string',
            'n_plate_usd' => 'required|integer',
            'product' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);
        
        $record = WanaOrders::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->name1 = $request->input('name1');
        $record->name2 = $request->input('name2');
        $record->vehicle_num = $request->input('n_plate');
        $record->port = $request->input('port');
        $record->p_of_d = $request->input('p_of_d');
        $record->n_plate_usd = $request->input('n_plate_usd');
        $record->product = $request->input('product');
        $record->quantity = $request->input('quantity');
        $record->weight = $request->input('weight');
        $record->date = $request->input('date');
        $record->update();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }
    
    public function updatekselfexpense(Request $request, $id) {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'comission' => 'required|string',
            'name' => 'required|string',
        ]);
    
        $record = SelfDeliveryExpenseWana::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->comission = $request->input('comission');
        $record->name = $request->input('name');
        $record->update();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }

    public function updatekself(Request $request, $id) {
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'name' => 'required|string',
            'exchange_rate' => 'required|string',
            'amount' => 'required|string',
        ]);
    
        $record = SelfDeliveryWana::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->name = $request->input('name');
        $record->exchange_rate = $request->input('exchange_rate');
        $record->amount = $request->input('amount');
        $record->save();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $record = WanaOrders::find($id);
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
        $record = WanaOrders::find($id); 
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        return view('backend.pages.orders.wana.order', ['record'=> $record]);    

    } 

}
