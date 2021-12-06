<?php

namespace App\Http\Controllers;

use App\Models\SalesmanConfirmation;
use Illuminate\Http\Request;

class SalesmanConfirmationController extends Controller
{
    public function confirm(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'companey_name' => 'required'
        ]);
        SalesmanConfirmation::create([
            'user_id' => auth()->user()->id,
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'description' => $request->description,
            'companey_name' =>$request->companey_name,
            'status_id' => 1
        ]);
    }
}
