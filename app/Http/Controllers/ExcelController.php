<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;

class ExcelController extends Controller
{
    // 🔹 Export Data
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    // 🔹 Import Data
    public function import(Request $request) 
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);
        ini_set('max_execution_time', 600);
        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success', 'Users Imported Successfully!');
    }
}

