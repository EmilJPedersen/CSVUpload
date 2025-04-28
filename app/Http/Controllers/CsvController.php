<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class CsvController extends Controller
{
    public function index()
    {
        $data = Session::get('csv_data', []);
        return view('csv', compact('data'));
    }

    public function upload(Request $request)
    {
        // Check if file is received
        if (!$request->hasFile('csv_file')) {
            return back()->with('error', 'No file uploaded.');
        }

        $file = $request->file('csv_file');

        // Check if file is valid
        if (!$file->isValid()) {
            return back()->with('error', 'Uploaded file is not valid.');
        }

        $csvData = array_map(function ($line) {
            $row = str_getcsv($line, ';');
            return array_filter($row, function($cell) {
                return $cell !== null && $cell !== '';
            });
        }, file($file->getRealPath()));

        // Check what data we parsed
        if (empty($csvData)) {
            return back()->with('error', 'CSV file is empty or invalid.');
        }

        // Store data in session
        Session::put('csv_data', $csvData);

        return redirect('/');
    }


    public function downloadPdf()
    {
        $data = Session::get('csv_data', []);
        $pdf = Pdf::loadView('pdf', compact('data'));
        return $pdf->download('table.pdf');
    }
}
