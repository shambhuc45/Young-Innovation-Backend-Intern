<!DOCTYPE html>
<html>
<head>
    <title>Petroleum Sales</title>
</head>
<body>
    <h1>Petroleum Sales Report</h1>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Year</th>
                <th>Avg</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($totalSalesByProduct as $product => $yearRangeSales)
            @foreach ($yearRangeSales as $yearRange => $totalSale)
                <tr>
                    <td>{{ $product }}</td>
                    <td>{{ $yearRange }}</td>
                    <td>{{ $totalSale }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</body>
</html>