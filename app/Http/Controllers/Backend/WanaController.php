<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OtherDeliveryWana;
use App\Models\Roznamchas;
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
            'crm' => 'required|numeric',
            'img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $record = new WanaOrders();
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
        $record->crm = $request->input('crm');
        $record->date = $request->input('date');

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
              if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $fileName = uniqid() . '.' . $extension;
                $path = $image->move('upload/wana/', $fileName);
                $images[] = $path->getPathname();
              }
            }
      
            $existingImages = json_decode($record->images, true);
      
            if (is_array($existingImages)) {
              $images = array_merge($existingImages, $images);
            } else {
              // Handle the case where JSON decoding failed or $existingImages is not an array
            }
            $record->images = json_encode($images);
            $record->save();
          }


        $record->save();

        $savedId = $record->id;

        $validatedData = $request->validate([
            'comission' => 'required|string',
            'name' => 'required|string',
        ]);
        
        $record = new SelfDeliveryExpenseWana();
        $record->musalsal_num = $savedId;
        $record->comission = $request->input('comission');
        $record->name = $request->input('name');
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

    //     $record = new WanaOrders();
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
    //     ;

    // }

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


        $validatedData = $request->validate([
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);

        $kharlachi_order = WanaOrders::where('id','=',$request->input('musalsal_num'))->first();

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
        
        session()->flash('success', 'Record created successfully');
        return redirect()->back();
    }
    public function wself(Request $request)
        {
            // dd($request->all());
            $validatedData = $request->validate([
                'musalsal_num' => 'required|string',
                'exchange_rate' => 'required|string',
                'us_malwala' => 'required|string',
            ]);
            
            $record = new SelfDeliveryWana();
            $record->musalsal_num = $request->input('musalsal_num');
            $record->exchange_rate = $request->input('exchange_rate');
            $record->us_malwala = $request->input('us_malwala');
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
        $roznamcha = Roznamchas::where('serial_num',$record->musalsal_num)->first();
        return view('backend.pages.orders.wana.edit',compact('admins','wana','record','self','self_expense','roznamcha') );
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
            'crm' => 'required|numeric',

        ]);
        
        $record = WanaOrders::findOrFail($id);
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
        $record->crm = $request->input('crm');
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
            'exchange_rate' => 'required|string',
            'us_malwala' => 'required|string',
        ]);
    
        $record = SelfDeliveryWana::findOrFail($id);
        $record->musalsal_num = $request->input('musalsal_num');
        $record->exchange_rate = $request->input('exchange_rate');
        $record->us_malwala = $request->input('us_malwala');
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

    public function roznamchast(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'date_af' => 'required|string',
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'name' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);

        $record = new Roznamchas();
        $record->serial_num = $request->input('musalsal_num');
        $record->date_af = $request->input('date_af');
        $record->amount_af = $request->input('amount_af');
        $record->state = $request->input('state');
        $record->khata_banam = $request->input('name');
        $record->country = $request->input('country');
        $record->detail = $request->input('detail');
        $record->save();


        session()->flash('success', 'Record Created successfully');
        return redirect()->back();
    }   

    public function updateroznamchast(Request $request, $id)
    {
        $validatedData = $request->validate([
            'musalsal_num' => 'required|string',
            'amount_af' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'detail' => 'required|string',
        ]);
        
        $wana_order = WanaOrders::where('id','=',$request->input('musalsal_num'))->first();
        
        $name1 = $wana_order->name1;
        $date_af = $wana_order->date;
    
        $record = Roznamchas::findOrFail($id);
        $record->serial_num = $request->input('musalsal_num');
        $record->date_af = $date_af;
        $record->amount_af = $request->input('amount_af');
        $record->state = $request->input('state');
        $record->khata_banam = $name1;
        $record->country = $request->input('country');
        $record->detail = $request->input('detail');
        $record->save();
    
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }

    public function invoice($id)
    {
        $inv = WanaOrders::with('self', 'expense')->with('admin')->findOrFail($id);

        return view('backend.pages.invoice.index',compact('inv'));
    }

    public function images(Request $request,$id)
    {
        $info = WanaOrders::where('id', $id)->select('id', 'musalsal_num', 'name_driver', 'vehicle_num')->first();
        $details = WanaOrders::where('id', $id)->first('images');
        $images = json_decode($details->images, true);
        return view('backend.pages.invoice.images', compact('info','images'));
    }
}
