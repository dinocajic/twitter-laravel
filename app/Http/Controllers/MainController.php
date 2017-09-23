<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $data['title']         = 'Twitter API in Laravel';
        $data['description']   = 'Use the Twitter API in Laravel';

        return view('index.index', compact('data'));
    }
}
