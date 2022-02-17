<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Fee;
use App\Models\Group;
use App\Models\OtherPaymentDetails;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_payments = Fee::where('transaction_id','>',0)->latest('id')->get();
        return view('admin.transaction.index',compact('all_payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['groups'] = Group::latest()->get();
        $data['classes'] = Classes::latest()->get();
        $data['users'] = User::where('role_id', 4)->latest()->get();
        return view('admin.transaction.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::find($id)->delete();
        OtherPaymentDetails::where('payment_id',$id)->delete();
        return redirect()->back()->with('success','Payment history is deleted');
    }

    /**
     * Payment Due For A Specific Student
     */

    public function paymentDueForSpecificStudent(Request $request){
        $this->validate($request,[
            'student_id' => 'required'
        ]);
        $data = (object)[];
        $data->user_id = $request->student_id;
        $data->user_details = User::find($request->student_id);
        $data->due_payment = Fee::where('user_id', $data->user_id)->where('transaction_id', 0)->latest('id')->get();
        return view('admin.transaction.payment',compact('data'));
    }
}
