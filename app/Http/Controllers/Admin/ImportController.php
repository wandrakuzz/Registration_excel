<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use App\Notifications\EmailPassword;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    //
    public function import(Request $request)
    {
        if (!$request->has('file')) {
            return back()->with('error', 'No file uploaded, please upload required file.');
        }

        Excel::import(new UsersImport, $request->file('file'));

        return back()->with('success', 'All is well. Congratulation!!');
    }
}
