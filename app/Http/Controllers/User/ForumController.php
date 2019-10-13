<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    public function list()
    {
        return view('layouts.material.user.forums.list');

    }
}
