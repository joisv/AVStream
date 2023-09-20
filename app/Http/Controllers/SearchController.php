<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request) {

        return view('search', [
            'keyword' => $request->input('keyword')
        ]);
    }
}
