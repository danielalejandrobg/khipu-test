<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/estilos-khipu.css') }}">

    <title>Integración Khipu</title>



</head>
<body>
    <div class="container">
        <h1>Bienvenido a la integración Khipu por Daniel Alejandro BG</h1>

        <p>
            <a href="{{ url('/bancos') }}">Obtener lista de bancos</a>
        </p>


        @if(isset($bancos))
            <h2>Lista de Bancos:</h2>
            <ul>
                @foreach($bancos as $banco)
                    <li>
                        <strong>{{ $banco['name'] }}</strong><br>
                        <img src="{{ $banco['logo_url'] }}" alt="Logo {{ $banco['name'] }}" width="100"><br>
                        {{ $banco['message'] }}
                    </li>
                @endforeach
            </ul>
        @elseif(isset($error))
            <p>Error: {{ $error }}</p>
        @endif




        <h2>Generar cobro de prueba</h2>
        <form action="{{ url('/crear-pago') }}" method="POST">
            @csrf
            <label for="amount">Monto (CLP):</label>
            <input type="number" name="amount" id="amount" min="1" required>
            <button type="submit">Generar cobro</button>
        </form>


        <h2>Consultar estado de un pago</h2>
        <form action="{{ url('/estado-pago') }}" method="GET">
            <label for="payment_id">ID del pago:</label>
            <input type="text" name="payment_id" id="payment_id" required>
            <button type="submit">Consultar estado</button>
        </form>


        <h2>Eliminar un pago</h2>
        <form action="{{ route('eliminar.pago', ['id' => 'temp']) }}" method="POST" onsubmit="this.action=this.action.replace('temp', document.getElementById('payment_id_delete').value)">
            @csrf
            @method('DELETE')
            <label for="payment_id_delete">ID del pago:</label>
            <input type="text" name="payment_id_delete" id="payment_id_delete" required>
            <button type="submit">Eliminar pago</button>
        </form>




        @if (session('success'))
            <div style="color:green;">{{ session('success') }}</div>
        @endif


        @if ($errors->any())
            <div style="color:red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif



    </div>
</body>
</html>


 