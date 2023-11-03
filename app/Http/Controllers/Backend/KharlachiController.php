<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherDeliveryKharlachi;
use App\Models\SelfDeliveryExpenseKharlachis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\KharlachiOrders;
use App\Models\SelfDeliveryKharlachi;

class KharlachiController extends Controller
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
        if (is_null($this->user) || !$this->user->can('orders.kharlachi.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view order !');
        }

        $kharlachiOrdersData = KharlachiOrders::with('self', 'expense')->with('admin')->get();
        
        return view('backend.pages.orders.kharlachi.index', compact('kharlachiOrdersData'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('orders.kharlachi.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create order !');
        }

        $kharlachi  = KharlachiOrders::all();
        $admins  = Admin::all();
        return view('backend.pages.orders.kharlachi.create', compact('kharlachi', 'admins'));
    }


    public function store(Request $request){
        
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

        $record = new KharlachiOrders();
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

    }

    public function kselfexpense(Request $request)
    {
        // dd($request->all());    
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'comission' => 'required|string',
            'name' => 'required|string',
        ]);
        
        $record = new SelfDeliveryExpenseKharlachis();
        $record->musalsal_num = $request->input('musalsal_num');
        $record->comission = $request->input('comission');
        $record->name = $request->input('name');
        $record->save();

        
        session()->flash('success', 'Record created successfully');
        return redirect()->back();
    }
    public function kself(Request $request)
        {
            // dd($request->all());
            $validatedData = $request->validate([
                'musalsal_num' => 'required|string',
                'name' => 'required|string',
                'exchange_rate' => 'required|string',
                'amount' => 'required|string',
            ]);
            
            $record = new SelfDeliveryKharlachi();
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

        $record = KharlachiOrders::find($id);

        $self = SelfDeliveryKharlachi::where('musalsal_num',$record->id)->first();
        $self_expense = SelfDeliveryExpenseKharlachis::where('musalsal_num',$record->id)->first();


        $admins  = Admin::all();
        $kharlachi  = KharlachiOrders::all();
        return view('backend.pages.orders.kharlachi.edit',compact('admins','kharlachi','record','self','self_expense') );
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
        
        $record = KharlachiOrders::findOrFail($id);
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
    
        $record = SelfDeliveryExpenseKharlachis::findOrFail($id);
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
    
        $record = SelfDeliveryKharlachi::findOrFail($id);
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
        $record = KharlachiOrders::find($id);
        if ($record) {
            $selfRecord = SelfDeliveryKharlachi::where('musalsal_num', $record->id)->first();
    
            if ($selfRecord) {
                $selfRecord->delete();
            }
            $selfRecordExpense = SelfDeliveryExpenseKharlachis::where('musalsal_num', $record->id)->first();
    
            if ($selfRecordExpense) {
                $selfRecordExpense->delete();
            }
            $record->delete();
            session()->flash('success', 'Record Deleted successfully');
            return redirect()->back();
        } else {
            session()->flash('error', 'Unable to delete the Record');
            return redirect()->back();
        }
    }
    

    public function show($id)
    {
        // dd('hello');
        $record = KharlachiOrders::find($id); 
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        return view('backend.pages.orders.kharlachi.order', ['record'=> $record]);    

    } 


   
}
