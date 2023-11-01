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

        $kharlachi_orders = KharlachiOrders::with('admin')->get();
        return view('backend.pages.orders.kharlachi.index', compact('kharlachi_orders'));
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
            'location_id' => 'required|integer',
            'malwala' => 'required|string',
            'musalsal_num' => 'required|string',
            'date' => 'required|date',
            'city' => 'required|string',
            'product' => 'required|string',
            'vehicle_num' => 'required|string',
            'quantity' => 'required|integer',
            'detail' => 'required|string',
            'kiraya' => 'required|numeric',
            'mutabik_kiraya' => 'required|numeric',
            'extra_kiraya' => 'required|numeric',
            'comission' => 'required|numeric',
            'ponch' => 'required|numeric',
            'total' => 'required|numeric',
            'total_af' => 'required|numeric',
            'bilty' => 'required|file',
        ]);

        $record = new KharlachiOrders();
        $record->malwala = $request->input('malwala');
        $record->musalsal_num = $request->input('musalsal_num');
        $record->date = $request->input('date');
        $record->city = $request->input('city');
        $record->product = $request->input('product');
        $record->vehicle_num = $request->input('vehicle_num');
        $record->quantity = $request->input('quantity');
        $record->detail = $request->input('detail');
        $record->kiraya = $request->input('kiraya');
        $record->mutabik_kiraya = $request->input('mutabik_kiraya');
        $record->extra_kiraya = $request->input('extra_kiraya');
        $record->comission = $request->input('comission');
        $record->ponch = $request->input('ponch');
        $record->total = $request->input('total');
        $record->total_af = $request->input('total_af');

        // storing image 
        
        if ($request->hasFile('bilty')) {
            $image = $request->file('bilty');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/kharlachiorders', $imageName);
        
            // Set the 'bilty' column to the file path
            $record->bilty = 'upload/kharlachiorders/' . $imageName;
        }

        $record->save();


        session()->flash('success', 'Record created successfully');

        return redirect()->back();

    }

    public function selfdata(Request $request)
    {
        // dd($request->all()); 
        if($request['sde_munafa'] == '' ){
            $record = new SelfDeliveryKharlachi();
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
            $self_record = new SelfDeliveryExpenseKharlachis();
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

    public function other_expense(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'o_musalsal_num' => 'required|integer',
            'o_dealer_pk' => 'required|integer',
            'o_kiraya_punjab' => 'required|numeric',
            'o_custom_pk' => 'required|integer',
            'o_labour_pk' => 'required|integer',
            'o_nlc_pk' => 'required|integer',
            'o_kanta_pk' => 'required|integer',
            'o_commission_pk' => 'required|integer',
            'o_total_pk' => 'required|integer',
            'o_dealer_af' => 'required|string',
            'o_gumrak_af' => 'required|integer',
            'o_mutabik_kiraya_af' => 'required|integer',
            'o_extra_kiraya_af' => 'required|integer',
            'o_ponch_af' => 'required|integer',
            'o_total_af' => 'required|integer',
            'o_balty_af' => 'required|file',
        ]);
        

        $record = new OtherDeliveryKharlachi();
        $record->musalsal_num = $validatedData['o_musalsal_num'];
        $record->dealer_pk = $validatedData['o_dealer_pk'];
        $record->dealer_af = $validatedData['o_dealer_af'];
        $record->kiraya_punjab = $validatedData['o_kiraya_punjab'];
        $record->custom_pk = $validatedData['o_custom_pk'];
        $record->labour_pk = $validatedData['o_labour_pk'];
        $record->nlc_pk = $validatedData['o_nlc_pk'];
        $record->kanta_pk = $validatedData['o_kanta_pk'];
        $record->commission_pk = $validatedData['o_commission_pk'];
        $record->total_pk = $validatedData['o_total_pk'];
        $record->gumrak_af = $validatedData['o_gumrak_af'];
        $record->mutabik_kiraya_af = $validatedData['o_mutabik_kiraya_af'];
        $record->extra_kiraya_af = $validatedData['o_extra_kiraya_af'];
        $record->ponch_af = $validatedData['o_ponch_af'];
        $record->total_af = $validatedData['o_total_af'];


        if ($request->hasFile('o_balty_af')) {
            $image = $request->file('o_balty_af');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/kharlachiorders/other_expense', $imageName);
        
            // Set the 'bilty' column to the file path
            $record->bilty = 'upload/kharlachiorders/other_expense/' . $imageName;
        }
        $record->save();

        session()->flash('success', 'Record created successfully');
        return redirect()->back();

    }

    public function edit($id)
    {
        $record = KharlachiOrders::find($id);

        if (!$record) {
            // Handle the case where the record with the given ID is not found.
            return redirect()->back()->with('error', 'Record not found.');
        }

        return view('backend.pages.orders.kharlachi.edit', ['record' => $record]);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $record = KharlachiOrders::find($id);
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        $record->update($request->all());
        
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();

    }

    public function destroy($id)
    {
        $record = KharlachiOrders::find($id);
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
        $record = KharlachiOrders::find($id); 
        if (!$record) {
            return redirect()->back()->with('error', 'no record found');
        }
        return view('backend.pages.orders.kharlachi.order', ['record'=> $record]);    

    } 


   
}
