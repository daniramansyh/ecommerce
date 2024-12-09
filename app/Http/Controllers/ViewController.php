<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ViewController extends Controller
{
    // Dashboard 
    public function dashboard()
    {
        $products = Product::all();
        return view('pages.dashboard', compact( 'products'));
    }
    // Home
    public function index()
    {
        $user = User::all();
        $products = Product::all();
        return view('pages.home', compact( 'products'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
