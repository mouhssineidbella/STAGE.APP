<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function showForm()
    {
        return view('form'); // Ensure "form.blade.php" exists in "resources/views/"
    }
}
