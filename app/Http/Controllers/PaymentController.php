<?php

namespace App\Http\Controllers;


use App\Models\Payments;
use App\Models\Students;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kelola Pembayaran";
        $payments = Payments::all();
        return view('payments.index', compact('payments', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Pembayaran";
        $students = Students::all();
        return view('payments.create', compact('students', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'academic_year' => 'required|string',
            'payment_type' => 'required|array',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        Payments::create($request->all());
        return redirect()->route('listPayments')->with('success', 'Payment Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payments $payment)
    {
        $title = "Detail Pembayaran";
        return view('payments.show', compact('payment', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payments $payment)
    {
        $title = "Edit Pembayaran";
        $students = Students::all();
        return view('payments.edit', compact('payment', 'students', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payments $payment)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'academic_year' => 'required|string',
            'payment_type' => 'required|array',
            'amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|boolean',
            'description' => 'nullable|string',
        ]);

        $payment->update($request->all());
        return redirect()->route('listPayments')->with('success', 'Payment Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payments $payment)
    {
        $payment->delete();
        return redirect()->route('listPayments')->with('success', 'Payment Deleted Successfully');
    }
}
