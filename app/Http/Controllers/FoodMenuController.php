<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FoodMenuController extends Controller
{
    public function index()
    {
        return view('food_detail.master.demo_food_menu');
    }
}
