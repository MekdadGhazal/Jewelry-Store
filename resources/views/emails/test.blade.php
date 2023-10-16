<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: system-ui, Arial, sans-serif;
            background-color: #f7f7f7;
            direction: ltr;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
            text-align: center;
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        th {
            background-color: #f2f2f2;
        }
        .total-row {
            font-weight: bold;
        }
        .thank-you {
            text-align: center;
            margin-bottom: 20px;
        }
        .process-id {
            text-align: center;
            margin-bottom: 10px;
            color: #888;
            font-family: monospace;
        }
        .store-again-btn {
            display: block;
            width: auto;
            max-width: 250px;
            margin: 0 auto;
            background-color: #4CAF50;
            color: white!important;
            padding: 15px 20px;
            border: 2px solid #398a3c;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Hello, {{$user->name}}</h1>

    <p class="thank-you">We appreciate your visit! Here is a list of your products:</p>

    <table>
        <thead>
        <tr>
            <th>Product</th>
            <th>count</th>
            <th>Price</th>
        </tr>
        </thead>
        <tbody>
        @php
            $totalPrice = 0;
        @endphp
        @foreach ($list as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['count'] }}</td>
                <td>{{ $product['price'] }}</td>
            </tr>
            @php
                $totalPrice += $product['price'];
            @endphp
        @endforeach
        <tr class="total-row">
            <td colspan="2"><strong>Total</strong></td>
            <td>{{ $totalPrice }}</td>
        </tr>
        </tbody>
    </table>
    <p class="process-id">Process ID: <code>{{ $id }}</code></p>

    <p style="text-align: center;">We hope you are satisfied with your products</p>
    <p style="text-align: center;"> Feel free to explore them further, and remember to visit us again soon for more exciting offers and products</p>
    <a href="{{env('APP_URL')}}" class="store-again-btn">Shop Again</a>
</div>
</body>
</html>
