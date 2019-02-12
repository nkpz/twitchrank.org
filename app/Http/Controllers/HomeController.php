<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    /**
     * @param  int  $id
     * @return View
     */
    public function index()
    {
        $streams = Redis::get('smashstreams:stats');
        return view('home', ['data' => $streams]);
    }
}
