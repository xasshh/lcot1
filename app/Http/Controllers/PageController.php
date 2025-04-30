<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function gallery() { return view('gallery'); }
    public function center() { return view('center'); }
    public function faculty() { return view('faculty'); }
    public function history() { return view('history'); }
    public function management() { return view('management'); }
    public function nonTeachingStaff() { return view('non-teaching-staff'); }
    public function payment() { return view('payment'); }
    public function rectorsDesk() { return view('rectors-desk'); }
    public function reference() { return view('reference'); }
}

