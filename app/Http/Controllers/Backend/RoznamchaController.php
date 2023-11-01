<?php

namespace App\Http\Controllers\Backend;

use AddressInfo;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Roznamchas;

class RoznamchaController extends Controller
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
        if (is_null($this->user) || !$this->user->can('roznamchas.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view roznamchas !');
        }
        $all_jama = Roznamchas::where('state','جمع')->get();
        $all_banam = Roznamchas::where('state','بنام')->get();

        $pk_bnam = 0 ; 
        $af_bnam = 0 ; 
        $usa_bnam = 0 ; 
        $pk_jama = 0 ; 
        $af_jama = 0 ; 
        $usa_jama = 0 ; 
        
        // dd($all_jama);
        foreach($all_jama as $jama)
        {
            if($jama->state == 'جمع')
            {
                if($jama->country == 'Pakistan'){
                    $pk_jama = $pk_jama + $jama->amount_pk;
                }elseif($jama->country == 'Afghanistan'){
                    $af_jama = $af_jama + $jama->amount_af;
                }else{
                    $usa_jama = $usa_jama + $jama->amount_usa;
                }
            }
        }
        foreach($all_banam as $banam){
            if($banam->state == 'بنام')
            {
                if($banam->country == 'Pakistan'){
                    $pk_bnam = $pk_bnam + $banam->amount_pk;
                }elseif($banam->country == 'Afghanistan'){
                    $af_bnam = $af_bnam + $banam->amount_af;
                }else{
                    $usa_bnam = $usa_bnam + $banam->amount_usa; 
                }
            }
        }

        $currency = $this->user->currency;

        $roznamchas_pk = Roznamchas::where('country','=','Pakistan')->with('admin')->get();
        $roznamchas_af = Roznamchas::where('country','=','Afghanistan')->with('admin')->get();
        $roznamchas_usa = Roznamchas::where('country','=','USA')->with('admin')->get();
        return view('backend.pages.roznamchas.index', compact('roznamchas_pk','roznamchas_af','roznamchas_usa',
         'pk_jama','af_jama','usa_jama','pk_bnam','af_bnam','usa_bnam', 'currency'));
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('roznamchas.create')) {
            abort(403, 'Sorry !! You are Unauthorized to create roznamcha !');
        }

        $currency = $this->user->currency;

        $users = Admin::all(['id', 'name']);
        $roznamchas  = Roznamchas::all();
        return view('backend.pages.roznamchas.create', compact('roznamchas','users','currency'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'country' => 'required|string',
            'user' => 'required|string',
            'sr_no' => 'required|integer',
            'detail' => 'required|string',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'state' => 'required|string',
        ]);

        $data = new Roznamchas();
        $data->country = $validatedData['country'];
        $data->khata_banam = $validatedData['user'];
        $data->serial_num = $validatedData['sr_no'];
        $data->detail = $validatedData['detail'];

        // Set country-specific data
        if ($validatedData['country'] == 'Pakistan') {
            $data->date_pk = $validatedData['date'];
            $data->amount_pk = $validatedData['amount'];
        } else if ($validatedData['country'] == 'Afghanistan') {
            $data->date_af = $validatedData['date'];
            $data->amount_af = $validatedData['amount'];
            // $data->afghani = $validatedData['afghani'];
        } else if ($validatedData['country'] == 'USA') {
            $data->date_usa = $validatedData['date'];
            $data->amount_usa = $validatedData['amount'];
        }

        $data->state = $validatedData['state'];

        // Save the primary data first to obtain an ID

        $uploadedImages = [];

        // Check if the 'bilty' file was uploaded
        if ($request->hasFile('bilty')) {
            $images = $request->file('bilty');
            foreach ($images as $image) {
                $imageName = uniqid() . '.' . $image->extension();
                $image->move('upload/roznamchas', $imageName);
                
                // Save each image's filename in an array
                $uploadedImages[] = 'upload/roznamchas/' . $imageName;
            }
        }

        // Convert the array of image names to a JSON string
        $data->bilty = json_encode($uploadedImages);
        $data->save();

        session()->flash('success', 'Record created successfully');

        return redirect()->back();



    }

    public function edit($id)
    {
        $roznamcha = Roznamchas::findOrFail($id);
        $users = Admin::all();
        return view('backend.pages.roznamchas.edit', compact('roznamcha','users'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'country' => 'required|string',
            'user' => 'required|string',
            'sr_no' => 'required|integer',
            'detail' => 'required|string',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'state' => 'required|string',
            'bilty' => 'file', // File is not required for update
        ]);

        // Find the existing Roznamchas record by ID
        $roznamcha = Roznamchas::findOrFail($id);

        // Update the fields based on the provided data
        $roznamcha->country = $validatedData['country'];
        $roznamcha->khata_banam = $validatedData['user'];
        $roznamcha->serial_num = $validatedData['sr_no'];
        $roznamcha->detail = $validatedData['detail'];

        if ($validatedData['country'] == 'Pakistan') {
            $roznamcha->date_pk = $validatedData['date'];
            $roznamcha->amount_pk = $validatedData['amount'];
        } elseif ($validatedData['country'] == 'Afghanistan') {
            $roznamcha->date_af = $validatedData['date'];
            $roznamcha->amount_af = $validatedData['amount'];
        } elseif ($validatedData['country'] == 'USA') {
            $roznamcha->date_usa = $validatedData['date'];
            $roznamcha->amount_usa = $validatedData['amount'];
        }

        $roznamcha->state = $validatedData['state'];

        // Check if a new 'bilty' file has been uploaded
        if ($request->hasFile('bilty')) {
            $image = $request->file('bilty');
            $imageName = uniqid() . '.' . $image->extension();
            $image->move('upload/roznamchas', $imageName);

            // Update the 'bilty' column with the new file path
            $roznamcha->bilty = 'upload/roznamchas/' . $imageName;
        }

        // Save the updated record
        $roznamcha->save();

        // Flash a success message and redirect back
        session()->flash('success', 'Record updated successfully');
        return redirect()->back();
    }


    
    public function destroy(Request $request){
        $id = $request->id;
        $roznamcha = Roznamchas::find($id);
        $roznamcha->delete();
        session()->flash('success','Record deleted Successfully');
        return redirect()->back();
    }

}
