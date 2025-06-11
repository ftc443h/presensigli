<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function masterData()
    {
        return view('admin.master_data.index', [
            'active' => 'masterData'
        ]);
    }
}
