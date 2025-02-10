<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    
    public function index(): View
    {
        $totalLowInventory = Inventory::where('stock', '<', 10)->count();

        $totalNoInventarios = Product::whereNotIn('id', function ($query) {
            $query->select('product_id')
                  ->from('inventories');
        })->count();

        $today = Carbon::today(); // Fin del día
        $totalInvoiceToday = Invoice::whereDate('created_at', $today)->count();
        $invoices = Invoice::whereDate('created_at', $today)
            ->orderBy('updated_at', 'desc')
            ->take(30)
            ->get();

        return view("dashboard.index", [
            "totalLowInventory" => $totalLowInventory,
            'totalInvoiceToday' => $totalInvoiceToday,
            'invoices' => $invoices,
            'totalNoInventarios' => $totalNoInventarios
        ]);
    }

}
