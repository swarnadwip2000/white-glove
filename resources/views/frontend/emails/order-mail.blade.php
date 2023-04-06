<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0\">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Confirmation</title>
</head>
<body>
    <p>Hi {{$order->shipping_name}} </p>
    <p>Your order has been successfully placed & your order id is {{ $order['order_number'] }}</p>
    <br/>

    <table style="width: 600px; text-align:right; boder:1px solid grey;">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->orderItems as $item)
                <tr>
                    <td><img src="{{ URL::asset('storage') }}/{{ $item->product->image }}" width="50px" height="50px" /></td>
                    <td>{{$item->product_name}}</td>
                    <td>{{$item->product_quantity}}</td>
                    <td>${{$item->product_price * $item->product_quantity}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="border-top:1px solid #ccc;"></td>
                <td style="font-size:14px;font-weight:bold;border-top:1px solid #ccc;">Subtotal : ${{$order->grand_total}}</td>
            </tr>
            
            <tr>
                <td colspan="3"></td>
                <td  style="font-size:14px;font-weight:bold;">Shipping : Free Shipping</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td style="font-size:14px;font-weight:bold;">Total : ${{$order->grand_total}}</td>
            </tr>
        </tbody>
    </table>    
</body>
</html>