<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentTypeRequest;
use App\PaymentType;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('payment-types.index', ['paymentTypes' => PaymentType::all()->where('owner_id', '=', Auth::user()->id )->sortBy('name')] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentType = new PaymentType();

        $paymentType = get_old_payment_type_data($paymentType);

        return view( 'payment-types.create', compact('paymentType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Request\PaymentTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentTypeRequest $request)
    {

        $data = $request->validated();

        $data['owner_id'] = Auth::user()->id;
        PaymentType::create($data);

        session()->flash('message', 'New Payment type was created!');
        return redirect(route( 'payment-types.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentType $paymentType)
    {
        $this->authorize('update', $paymentType);

        return view('payment-types.edit', compact('paymentType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Request\PaymentTypeRequest $request
     * @param  \App\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentTypeRequest $request, PaymentType $paymentType)
    {

        $this->authorize('update', $paymentType);
        $data = $request->validated();

        $paymentType->update($data);

        session()->flash('message', 'Payment type updated!');
        return redirect(route('payment-types.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentType $paymentType)
    {
        $name = $paymentType->name;
        $paymentType->delete();

        session()->flash('message', "$name was successfully deleted!");

        return redirect( route('payment-types.index'));
    }
}
