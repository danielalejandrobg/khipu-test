<!DOCTYPE html>
<html>
<head>
    <title>Integración Khipu</title>
</head>
<body>
    <h1>Bienvenido a la integración Khipu</h1>

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





    
    <form action="{{ url('/crear-cobro') }}" method="get">
        <button type="submit">Generar cobro de prueba</button>
    </form>
</body>
</html>


