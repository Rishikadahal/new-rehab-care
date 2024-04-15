<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Patient;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        return view('user/index');
    }

    function storePreAdmitConcern(Request $request)
    {
        $data = Patient::create([
            "name" => $request->name,
            "age" => $request->age,
            "email" => $request->email,
            "gender" => $request->gender,
            "current_health" => $request->current_health,
            "past_illness" => $request->past_illness,
            "medications" => $request->medications,
            "contact_details" => $request->contact_details,
            "user_id" => auth()->user()->id
        ]);
        $data->save();
        return redirect('/pre-admit-concern');
    }

    function updateBill($id){
        $bill = Bill::find($id);
        $bill->bill_status = '1';
        $bill->update();

        return response([
            'status'=>200
        ]);
    }
}
