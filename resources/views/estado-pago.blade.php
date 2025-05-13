<!DOCTYPE html>
<html>
<head>
    <title>Confirmar estado de pago</title>
</head>
<body>
    <h1>Estado del Pago</h1>

    @if(isset($pago))
        <ul>
            <li><strong>ID:</strong> {{ $pago['payment_id'] }}</li>
            <li><strong>Estado:</strong> {{ $pago['status'] }}</li>
            <li><strong>Cliente:</strong> {{ $pago['payer_name'] ?? 'N/A' }}</li>
            <li><strong>Monto:</strong> {{ $pago['amount'] }} {{ $pago['currency'] }}</li>
        </ul>
    @elseif(isset($error))
        <p style="color:red;">{{ $error }}</p>
    @endif

    <p><a href="{{ url('/') }}">Volver</a></p>
</body>
</html>
