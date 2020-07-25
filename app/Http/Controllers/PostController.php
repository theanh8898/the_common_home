<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {

        return view('posts.show');
    }
}
