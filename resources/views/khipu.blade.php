<!DOCTYPE html>
<html>
<head>
    <title>Integración Khipu</title>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        color: #333;
        margin: 0;
        padding: 20px;
    }

    h1 {
        color: #0070c9;
        text-align: center;
        margin-bottom: 30px;
    }

    h2 {
        color: #444;
        margin-top: 40px;
        border-bottom: 2px solid #ddd;
        padding-bottom: 5px;
    }

    a {
        background-color: #0070c9;
        color: white;
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 4px;
        display: inline-block;
        margin-bottom: 20px;
    }

    a:hover {
        background-color: #005fa3;
    }

    form {
        background-color: white;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-top: 20px;
        max-width: 400px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input[type="number"],
    input[type="text"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        background-color: #28a745;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }

    button:hover {
        background-color: #218838;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: white;
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    img {
        margin-top: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    div[style*="color:green"] {
        padding: 10px;
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        border-radius: 4px;
        margin-top: 20px;
    }

    div[style*="color:red"] {
        padding: 10px;
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        margin-top: 20px;
    }

</style>



</head>
<body>
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




</body>
</html>


 