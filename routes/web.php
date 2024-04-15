<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HealthRecordsController;
use App\Models\Bill;
use App\Models\Meet;
use App\Models\Patient;
use App\Models\PatientActivity;
use App\Models\Review;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Dompdf\Options;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
});

Route::get('/generate-pdf', function () {
    $pdf = new Dompdf();
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $pdf->setOptions($options);
    $html = view('pdf.table')->render(); // Assuming your table is in a blade file named table.blade.php
    $pdf->loadHtml($html);
    $pdf->render();
    $pdf->stream('table.pdf');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

    // book a meet list
    Route::get('/book-meet', function () {
        return view('user/bookameet');
    })->name('book-meet');

    // book a meet form
    Route::get('/add-book-a-meet', function () {
        return view('user/book-a-meet');
    })->name('add-book-meet');

    // store meet
    Route::post('/add-book-a-meet', function (Request $request) {

        $request->validate([
            'email' => 'nullable|email',
            'patient_id' => 'nullable|exists:patients,id',
        ]);
        // Create a new meet instance
        $meet = new Meet();
        // Assign values from the request to the meet object
        $meet->email = $request->email;
        $meet->patient_id = $request->patient_id;
        $meet->status = 1;
        $meet->user_id = auth()->user()->id;

        // Save the meet
        $meet->save();
        return redirect('/book-meet');
    })->name('store-book-meet');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/update-bill-status/{id}', [DashboardController::class, 'updateBill']);

    Route::get('/patient-bills', function(){
        $patients = Patient::where('user_id',auth()->user()->id)->get();
        $biils = [];
        foreach($patients as $patient){
            $bills = Bill::where('patient_id', $patient->id)->get();
        }
        return view('user.patientBill',compact('bills'));
    });

    Route::get('/pre-admit-concern', function () {
        $data = Patient::all()->where("user_id", auth()->user()->id);
        return view('user/preadmitconcern', compact('data'));
    })->name('pre-admit-concern');
    Route::get('/add-pre-admit-concern', function () {
        return view('user/add-preadmit-concern');
    })->name('add-pre-admit-concern');

    Route::post('/add-pre-admit-concern', [DashboardController::class, 'storePreAdmitConcern']);
    Route::post('/add/review', function (Request $request) {
        // Validate the request data
        $validatedData = $request->validate([
            'review' => 'required|integer',
            'message' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        // Create a new review instance
        $newReview = new Review();

        // Assign values to the review properties
        $newReview->review = $validatedData['review'];
        $newReview->message = $validatedData['message'];
        $newReview->user_id = $validatedData['user_id'];

        // Save the review to the database
        $newReview->save();

        // Return the newly created review
        return redirect()->back();
    });

    Route::get('/patient-activity', function () {
        $data = PatientActivity::all();
        $user = [];
        foreach ($data as $key => $value) {

            $patient = Patient::find($value->patient_id);
            if ($patient->user_id == auth()->user()->id) {
                $value->patient_name = $patient->name;
                array_push($user, $value);
            }
        }
        return view("user.patientactivity", compact('user'));
    });

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
