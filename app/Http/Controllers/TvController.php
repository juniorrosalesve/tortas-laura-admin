<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TvInfo;

class TvController extends Controller
{
    public function getTv(Request $r) {
        $get    =   TvInfo::where('showIn', $r->tv)->first();
        return $get->toJson();
    }
}
