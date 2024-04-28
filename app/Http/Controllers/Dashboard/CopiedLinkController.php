<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Copylink;
use App\Models\Customer;
use App\Models\Subscription;
use Illuminate\Support\Facades\Validator;

class CopiedLinkController extends Controller
{
    
        function __construct()
    {
         $this->middleware('permission:روابط الدعوة', ['only' => ['index','show']]);
    }

    public function index(Request $request){
        $customersInvat=Customer::pluck('invited_id')->toArray();     
        $customers = Customer::whereIn('id',$customersInvat)->orderBy('id','DESC')->paginate(5);        
        return view('dashboard.copied-links.index',compact('customers'))
            ->with('i', ($request->input('page', 1) - 1) * 5);        
    }
    public function show($id)
    {
        $customers = Customer::where('invited_id',$id)->get();
      
        return view('dashboard.copied-links.show',compact('customers'));
    }
    public function getCustomerSubscriptions($id)
    {
        $inviteStatus = Customer::where('id',$id)->where('status','new')->whereNotNull('invited_id')->first();
        $subscriptions = Subscription::where('customer_id',$id)->whereNot('status','cancelled')->get();
        //dd($subscriptions);
        return view('dashboard.copied-links.subscriptions',compact('subscriptions','inviteStatus'));
    }
    public function addCustomerInvitationEarn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);
        if($validator->fails()){

          return redirect()->back()->withErrors($validator)->withInput();
        }
        $customer = Customer::findOrFail($request->cust_id);
        $customer->total_earning = $customer->total_earning + $request->amount;
        $customer->save(); 
        $customerInvited = Customer::findOrFail($request->invited_id);
        $customerInvited->status = 'paid';
        $customerInvited->save(); 
        return redirect()->back()->with('success', 'تم اضافة مبلغ الدعوة.');
    } 
    
}
 