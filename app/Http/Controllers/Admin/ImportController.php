<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\User;

class ImportController extends Controller
{
    //
    public function import(Request $request)
    {
        // dd($request);
        Excel::import(new UsersImport, $request->file('file'));

        $uploaded_users = User::where('created_at', User::latest()->first()->created_at)->get();
        // dd($uploaded_users);
        return back()->with('success', 'All good');
    }
}
