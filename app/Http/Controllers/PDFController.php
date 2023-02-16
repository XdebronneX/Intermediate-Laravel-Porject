<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    public function generatePDF()
    {
        // $users = User::get();

        $data = [
            // 'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            // 'users' => $users
        ];

        $pdf = PDF::loadView('myPDF', $data);

        return $pdf->stream('transactions.pdf');
    }
}
