<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        var_dump(session()->get());
        die();

        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        return view('dashboard');
    }
}