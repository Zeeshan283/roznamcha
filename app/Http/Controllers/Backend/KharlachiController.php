<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherDeliveryKharlachi;
use App\Models\Roznamchas;
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
        
        $orderData = [];
        

        $kharlachiOrdersData = KharlachiOrders::with('self', 'expense')->with('admin')->get();
        
        foreach($kharlachiOrdersData as $kharlachiData){
            $currentMusalsalNum = $kharlachiData['id'];
            $matchedSelf = collect($kharlachiData['self'])->firstWhere('musalsal_num', $currentMusalsalNum);
            $matchedexpense = collect($kharlachiData['expense'])->firstWhere('musalsal_num', $currentMusalsalNum);
            $name = '';
            $comission = '';
            $us_malwala = '';
            $exchange_rate = '';
            if($matchedSelf){
                $name = $matchedexpense['admin']['name'];
                $comission = $matchedexpense['comission'];
                $us_malwala = $matchedSelf['us_malwala'];
                $exchange_rate = $matchedSelf['exchange_rate'];
            }
            $expense = Roznamchas::where('serial_num', '=', $kharlachiData['musalsal_num'])->sum('amount_af');
            $total_amount_af = intval($expense) - intval($comission);
            $malwala_amount_af = intval($us_malwala) * intval($exchange_rate);
            $total_munafa = $total_amount_af + $malwala_amount_af;
            $orderData[] = [
                'id' => $kharlachiData->id,
                'date' => $kharlachiData->date,
                'musalsal_num' => $kharlachiData->musalsal_num,
                'name1' => $kharlachiData['admin']->name,
                'name2' => $kharlachiData['admin1']->name,
                'vehicle_num' => $kharlachiData->vehicle_num,
                'port' => $kharlachiData->port,
                'p_of_d' => $kharlachiData->p_of_d,
                'n_plate_usd' => $kharlachiData->n_plate_usd,
                'product' => $kharlachiData->product,
                'quantity' => $kharlachiData->quantity,
                'weight' => $kharlachiData->weight,
                'name' => $name,
                'comission' => $comission,
                'expense' => $expense,
                'total_amount_af' => $total_amount_af,
                'us_malwala' => $us_malwala,
                'exchange_rate' => $exchange_rate,
                'total_munafa' => $total_munafa,
                'matchedSelf' => $matchedSelf,
                ];
                // dd($orderData);
        }
        
        return view('backend.pages.orders.kharlachi.index', compact('orderData'));
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
            'bulit_no' => 'required|string',
            'name_driver' => 'required|string',
            'driver_num' => 'required|string',
            'vehicle_num' => 'required|string',
            'loading_place' => 'required|string',
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
                'exchange_rate' => 'required|string',
                'us_malwala' => 'required|string',
            ]);
            
            $record = new SelfDeliveryKharlachi();
            $record->musalsal_num = $request->input('musalsal_num');
            $record->exchange_rate = $request->input('exchange_rate');
            $record->us_malwala = $request->input('us_malwala');
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
        $roznamcha = Roznamchas::where('serial_num',$record->musalsal_num)->first();
        return view('backend.pages.orders.kharlachi.edit',compact('admins','kharlachi','record','self','self_expense','roznamcha') );
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
            'n_plate_usd' => 'required|integer',
            'product' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'required|numeric',
        ]);
        
        $record = KharlachiOrders::findOrFail($id);
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
            'exchange_rate' => 'required|string',
            'us_malwala' => 'required|string',
        ]);
    
        $record = SelfDeliveryKharlachi::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->exchange_rate = $request->input('exchange_rate');
        $record->us_malwala = $request->input('us_malwala');
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

    public function roznamchask(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);
        
        $kharlachi_order = KharlachiOrders::where('musalsal_num','=',$request->input('musalsal_num'))->first();
        
        $name1 = $kharlachi_order->name1;
        $date_af = $kharlachi_order->date;

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

    public function updateroznamchask(Request $request, $id)
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
        $inv = KharlachiOrders::with('self', 'expense')->with('admin')->findOrFail($id);

        return view('backend.pages.invoice.index',compact('inv'));
    }
}
