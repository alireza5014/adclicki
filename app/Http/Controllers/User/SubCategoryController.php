<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    public function list(Request $request)
    {
        $subcategory = [];
        if ($request->ajax()) {
            try {
                return view('layouts.material.user.subcategory.table', compact('subcategory'))->render();
            } catch (\Throwable $e) {
            }
        }
        return view('layouts.material.user.subcategory.list', compact('subcategory'));
    }
}
