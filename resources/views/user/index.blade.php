<?php

use App\Models\Bill;
use App\Models\Patient;

$user_id = auth()->user()->id;
$patients = Patient::where('user_id', $user_id)->get();

// Initialize counts for unpaid and paid bills
$unpaidBillsCount = 0;
$paidBillsCount = 0;
$billCount = 0;

foreach ($patients as $patient) {
    $bills = Bill::where('patient_id', $patient->id)->get();
    foreach ($bills as $bill) {
        $billCount += 1;
        if ($bill->bill_status == '2') {
            $unpaidBillsCount += $bill->bill_amount;
        } else {
            $paidBillsCount += $bill->bill_amount;
        }
    }
}
$totalPatientsCount = $patients->count();
$totalBillsCount =  $paidBillsCount;
?>

@extends('user.layout.main')
@section('content')
<div class="container mt-5">
    <h1 class="fw-bold text-lg my-2">Dashboard</h1>
    <div class="row">
        <div class="col-lg-3 text-center">
            <div class="card p-4">
                <h1 class="fw-bold">{{ $billCount }}</h1>
                <span class="text-center">Bill</span>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="card p-4">
                <h1 class="fw-bold">{{ $totalPatientsCount }}</h1>
                <span class="text-center">Patient</span>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="card p-4">
                <h1 class="fw-bold">Rs {{ $unpaidBillsCount }}</h1>
                <span class="text-center">Unpaid Bill</span>
            </div>
        </div>
        <div class="col-lg-3 text-center">
            <div class="card p-4">
                <h1 class="fw-bold">{{ $paidBillsCount }}</h1>
                <span class="text-center">Paid Bill</span>
            </div>
        </div>
    </div>
</div>
@endsection