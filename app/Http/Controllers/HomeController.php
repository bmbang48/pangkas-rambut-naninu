<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $barbers = Barber::all();
        $services = Service::all();
        return view('home', compact('barbers', 'services'));
    }
}
