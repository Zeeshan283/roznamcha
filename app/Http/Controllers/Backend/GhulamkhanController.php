<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherDeliveryGhulamkhan;
use App\Models\Roznamchas;
use App\Models\SelfDeliveryExpenseGhulamkhan;
use App\Models\SelfDeliveryGhulamkhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\GhulamkhanOrders;

class GhulamkhanController extends Controller
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
        if (is_null($this->user) || !$this->user->can('orders.ghulamkhan.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view order !');
        }

        $GhulamkhanOrders = GhulamkhanOrders::with('self', 'expense')->with('admin')->get();



        return view('backend.pages.orders.ghulamkhan.index', compact('GhulamkhanOrders'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('orders.ghulamkhan.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create order !');
        }

        $ghulam  = GhulamkhanOrders::all();
        $admins  = Admin::all();
        return view('backend.pages.orders.ghulamkhan.create', compact('ghulam', 'admins'));
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'name1' => 'required|string',
            'name2' => 'required|string',
            'bulit_no' => 'required|string',
            'name_driver' => 'required|string',
            'driver_num' => 'required|string',
            'vehicle_num' => 'required|string',
            'loading_place' => 'required|string',
            'port' => 'required|string',
            'p_of_d' => 'required|string',
            'n_plate_usd' => 'required|string',
            'product' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'kariya' => 'required|numeric',
        ]);

        $record = new GhulamkhanOrders();
        $record->musalsal_num = $request->input('musalsal_num');
        $record->name1 = $request->input('name1');
        $record->name2 = $request->input('name2');
        $record->bulit_no = $request->input('bulit_no');
        $record->name_driver = $request->input('name_driver');
        $record->driver_num = $request->input('driver_num');
        $record->vehicle_num = $request->input('vehicle_num');
        $record->loading_place = $request->input('loading_place');
        $record->port = $request->input('port');
        $record->p_of_d = $request->input('p_of_d');
        $record->n_plate_usd = $request->input('n_plate_usd');
        $record->product = $request->input('product');
        $record->quantity = $request->input('quantity');
        $record->weight = $request->input('weight');
        $record->kariya = $request->input('kariya');
        $record->date = $request->input('date');
        $record->save();


        session()->flash('success', 'Record Created successfully');
        return redirect()->back();


    }
    // public function store1(Request $request){
        
    //     $validatedData = $request->validate([
    //         'musalsal_num' => 'required|string',
    //         'name1' => 'required|string',
    //         'name2' => 'required|string',
    //         'bulit_no' => 'required|string',
    //         'name_driver' => 'required|string',
    //         'driver_num' => 'required|string',
    //         'vehicle_num' => 'required|string',
    //         'loading_place' => 'required|string',
    //         'port' => 'required|string',
    //         'p_of_d' => 'required|string',
    //         'n_plate_usd' => 'required|integer',
    //         'product' => 'required|string',
    //         'quantity' => 'required|numeric',
    //         'weight' => 'required|numeric',
    //     ]);

    //     $record = new GhulamkhanOrders();
    //     $record->musalsal_num = $request->input('musalsal_num');
    //     $record->name1 = $request->input('name1');
    //     $record->name2 = $request->input('name2');
    //     $record->bulit_no = $request->input('bulit_no');
    //     $record->name_driver = $request->input('name_driver');
    //     $record->driver_num = $request->input('driver_num');
    //     $record->vehicle_num = $request->input('vehicle_num');
    //     $record->loading_place = $request->input('loading_place');
    //     $record->port = $request->input('port');
    //     $record->p_of_d = $request->input('p_of_d');
    //     $record->n_plate_usd = $request->input('n_plate_usd');
    //     $record->product = $request->input('product');
    //     $record->quantity = $request->input('quantity');
    //     $record->weight = $request->input('weight');
    //     $record->date = $request->input('date');
    //     $record->save();


    //     session()->flash('success', 'Record created successfully');

    //     return redirect()->back();

    // }

    public function gselfexpense(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'comission' => 'required|string',
            'name' => 'required|string',
        ]);
        $record = new SelfDeliveryExpenseGhulamkhan();
        $record->musalsal_num = $request->input('musalsal_num');
        $record->comission = $request->input('comission');
        $record->name = $request->input('name');
        $record->save();

        $validatedData = $request->validate([
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);
        
        $ghulamkhan_order = GhulamkhanOrders::where('id','=',$request->input('musalsal_num'))->first();
        $name1 = $ghulamkhan_order->name1;
        $date_af = $ghulamkhan_order->date;

        $record = new Roznamchas();
        $record->serial_num = $request->input('musalsal_num');;
        $record->date_af = $date_af;
        $record->amount_af = $request->input('amount_af');
        $record->state = $request->input('state');
        $record->khata_banam = $name1;
        $record->country = $request->input('country');
        $record->detail = $request->input('detail');
        $record->save();


        session()->flash('success', 'Record Created successfully');
        return redirect()->back();
        

    }
    public function gself(Request $request)
        {
            // dd($request->all());
            $validatedData = $request->validate([
                'musalsal_num' => 'required|string',
                'exchange_rate' => 'required|string',
                'us_malwala' => 'required|string',
            ]);
            
            $record = new SelfDeliveryGhulamkhan();
            $record->musalsal_num = $request->input('musalsal_num');
            $record->exchange_rate = $request->input('exchange_rate');
            $record->us_malwala = $request->input('us_malwala');
            $record->save();

            
            session()->flash('success', 'Record created successfully');
            return redirect()->back();
        }
  
    public function edit($id)
    {

        $record = GhulamkhanOrders::find($id);


        $self = SelfDeliveryGhulamkhan::where('musalsal_num',$record->id)->first();
        $self_expense = SelfDeliveryExpenseGhulamkhan::where('musalsal_num',$record->id)->first();

        $admins  = Admin::all();
        $ghulamkhan  = GhulamkhanOrders::all();
        $roznamcha = Roznamchas::where('serial_num',$record->musalsal_num)->first();

        return view('backend.pages.orders.ghulamkhan.edit',compact('admins','ghulamkhan','record','self','self_expense','roznamcha') );
    }

    public function update(Request $request, $id) {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'name1' => 'required|string',
            'name2' => 'required|string',
            'bulit_no' => 'required|string',
            'name_driver' => 'required|string',
            'driver_num' => 'required|string',
            'vehicle_num' => 'required|string',
            'loading_place' => 'required|string',
            'port' => 'required|string',
            'p_of_d' => 'required|string',
            'n_plate_usd' => 'required|string',
            'product' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
            'kariya' => 'required|numeric',
        ]);
        
        $record = GhulamkhanOrders::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->name1 = $request->input('name1');
        $record->name2 = $request->input('name2');
        $record->bulit_no = $request->input('bulit_no');
        $record->name_driver = $request->input('name_driver');
        $record->driver_num = $request->input('driver_num');
        $record->vehicle_num = $request->input('vehicle_num');
        $record->vehicle_num = $request->input('loading_place');
        $record->port = $request->input('port');
        $record->p_of_d = $request->input('p_of_d');
        $record->n_plate_usd = $request->input('n_plate_usd');
        $record->product = $request->input('product');
        $record->quantity = $request->input('quantity');
        $record->weight = $request->input('weight');
        $record->kariya = $request->input('kariya');
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
    
        $record = SelfDeliveryExpenseGhulamkhan::findOrFail($id);
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
            'exchange_rate' => 'required|string',
            'us_malwala' => 'required|string',
        ]);
    
        $record = SelfDeliveryGhulamkhan::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->exchange_rate = $request->input('exchange_rate');
        $record->us_malwala = $request->input('us_malwala');
        $record->save();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $record = GhulamkhanOrders::find($id);
        if ($record) {
            $selfRecord = SelfDeliveryGhulamkhan::where('musalsal_num', $record->id)->first();
    
            if ($selfRecord) {
                $selfRecord->delete();
                dd($selfRecord);
            }
            $selfRecordExpense = SelfDeliveryExpenseGhulamkhan::where('musalsal_num', $record->id)->first();
    
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
        // $GhulamkhanOrders = GhulamkhanOrders::with('self', 'expense')->with('admin')->get();
        $GhulamkhanOrder = GhulamkhanOrders::with('self', 'expense', 'admin')->find($id);

        if (!$GhulamkhanOrder) {
            return redirect()->back()->with('error', 'no record found');
        }
        return view('backend.pages.orders.ghulamkhan.order', compact('GhulamkhanOrder'));    

    } 


    public function roznamchasg(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);
        
        $ghulamkhan_order = GhulamkhanOrders::where('id','=',$request->input('musalsal_num'))->first();
        
        $name1 = $ghulamkhan_order->name1;
        $date_af = $ghulamkhan_order->date;

        $record = new Roznamchas();
        $record->serial_num = $request->input('musalsal_num');
        $record->date_af = $date_af;
        $record->amount_af = $request->input('amount_af');
        $record->state = $request->input('state');
        $record->khata_banam = $name1;
        $record->country = $request->input('country');
        $record->detail = $request->input('detail');
        $record->save();


        session()->flash('success', 'Record Created successfully');
        return redirect()->back();
    }   

    public function updateroznamchasg(Request $request, $id)
    {
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'date_af' => 'required|string',
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'name' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);
    
        $record = Roznamchas::findOrFail($id);
        $record->serial_num = $request->input('musalsal_num');
        $record->date_af = $request->input('date_af');
        $record->amount_af = $request->input('amount_af');
        $record->state = $request->input('state');
        $record->khata_banam = $request->input('name');
        $record->country = $request->input('country');
        $record->detail = $request->input('detail');
        $record->save();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }

    public function invoice($id)
    {
        $inv = GhulamkhanOrders::with('self', 'expense','roznamcha')->with('admin')->findOrFail($id);

        return view('backend.pages.invoice.index',compact('inv'));
    }
}
