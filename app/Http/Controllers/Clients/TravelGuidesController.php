<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TravelGuidesController extends Controller
{
    public function index()
    {
        return view('clients.travel-Guides');
    }
}
