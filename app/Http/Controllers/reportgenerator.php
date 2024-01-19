<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportgenerator extends Controller
{
    public function retrieveData()
    {
        $data = DB::table('data')->get();

        return response()->json($data);
    }

    public function TotalSales()
    {
        $TotalSales = Data::select(DB::raw('SUM(sale) as total_sale'))
            ->first();

        echo "Overall Total Sales: " . $TotalSales->total_sale;
    }
    public function calculateTotalSalesByProduct()
{
    $yearRanges = [
        ['start_year' => 2007, 'end_year' => 2010],
        ['start_year' => 2011, 'end_year' => 2014]
    ];

    $totalSalesByProduct = [];

    foreach ($yearRanges as $yearRange) {
        $data = Data::whereBetween('year', [$yearRange['start_year'], $yearRange['end_year']])
            ->groupBy('petroleum_product')
            ->select('petroleum_product', DB::raw('SUM(sale) as total_sale'))
            ->get();

        foreach ($data as $sale) {
            $yearRangeLabel = $yearRange['start_year'] . '-' . $yearRange['end_year'];
            $totalSalesByProduct[$sale->petroleum_product][$yearRangeLabel] = $sale->total_sale;
        }
    }

    return view('petroleum_sales', compact('totalSalesByProduct'));
}
    public function calculateSalesByCountry()
    {
        $totalSalesByCountry = Data::groupBy('country')
            ->select('country', DB::raw('SUM(sale) as total_sale'))
            ->orderBy('total_sale', 'desc')
            ->get();

        foreach ($totalSalesByCountry as $sale) {
            echo $sale->country . " = " . $sale->total_sale . "\n";
        }

        // $top3Countries = $totalSalesByCountry->take(3);

        // $lowest3Countries = $totalSalesByCountry->orderBy('total_sale')->take(3);

        // echo "Top 3 Countries with the Highest Total Sales:\n";
        // foreach ($top3Countries as $country) {
        //     echo $country->country . " = " . $country->total_sale . "\n";
        // }



    }
    public function topCountry()
    {
        $totalSalesByCountry = Data::groupBy('country')
            ->select('country', DB::raw('SUM(sale) as total_sale'))
            ->orderBy('total_sale', 'desc')
            ->get();
            

        $top3Countries = $totalSalesByCountry->take(3);

        echo "Top 3 Countries with the Highest Total Sales:\n";
        foreach ($top3Countries as $country) {
            echo $country->country . " = " . $country->total_sale . "\n";
        }




        $totalSalesByCountry1 = Data::groupBy('country')
        ->select('country', DB::raw('SUM(sale) as total_sale'))
        ->orderBy('total_sale', 'asc')
        ->get();

        $lowest3Countries = $totalSalesByCountry1->take(3);

      
        echo "\n Top 3 Countries with the Lowest Total Sales:\n";
        foreach ($lowest3Countries as $country) {
            echo $country->country . " = " . $country->total_sale . "\n";
        }
    }


}