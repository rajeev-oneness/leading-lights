<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
   {
      $data = array();
      $data['students_count'] = User::where('role_id',4)->count();
      $data['teachers_count'] = User::where('role_id',3)->count();
      return view('admin.dashboard')->with($data);
   }
}
