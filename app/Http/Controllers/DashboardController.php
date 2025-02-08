<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(): View
    {
        $totalLowInventory = Inventory::where('stock', '<', 10)->count();
        

        return view("dashboard.index", [
            "totalLowInventory" => $totalLowInventory
        ]);
    }

}
