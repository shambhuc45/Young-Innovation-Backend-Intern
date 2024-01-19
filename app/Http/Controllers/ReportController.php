<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function fetchData()
    {
        $response = Http::get('https://raw.githubusercontent.com/younginnovations/internship-challenges/master/programming/petroleum-report/data.json');

        if ($response->successful()) {
            $data = $response->json();
            
            foreach ($data as $item) {
                Data::create([
                    'year' => $item['year'],
                    'petroleum_product' => $item['petroleum_product'],
                    'sale' => $item['sale'],
                    'country' => $item['country'],
                ]);
            }

            return response()->json(['message' => 'Data fetched and stored successfully']);
        }

        return response()->json(['error' => 'API request failed'], $response->status());
    }
}
