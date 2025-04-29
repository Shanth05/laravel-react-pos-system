// resources/views/invoice.blade.php
<html>
<body>
<h2>Invoice #{{ $order->id }}</h2>
<table>
<tr><th>Product</th><th>Qty</th><th>Price</th></tr>
@foreach($order->items as $item)
<tr>
<td>{{ $item->product->name }}</td>
<td>{{ $item->quantity }}</td>
<td>{{ number_format($item->unit_price, 2) }} LKR</td>
</tr>
@endforeach
</table>
<p>Total: {{ number_format($order->total_amount, 2) }} LKR</p>
</body>
</html>
