<?php

namespace App\Http\Controllers\Admin;

use App\Model\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentsController extends Controller
{
    public function list(Request $request, $payment_type = 'all')
    {
        $payment = Payment::orderBy('id', 'DESC')
            ->with(['user' => function ($q) {
                return $q->select('id', 'fname', 'lname', 'email');
            }]);

        if (is_numeric($payment_type)) {
            $payment->where('payment_type', $payment_type);
        }

        $payments = $payment->paginate(20);

        if ($request->ajax()) {
            try {
                return view('layouts.material.admin.payments.table', compact('payments'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.admin.payments.list', compact('payments'));

    }
}
