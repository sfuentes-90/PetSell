@include('usuario.header')

<h1>Mostrando {{ $aviso->titulo }}</h1>

    <div class="jumbotron text-center">
        <h2>{{ $aviso->titulo }}</h2>
        <p>
            <strong>Descripcion:</strong> {!! $aviso->descripcion !!}<br>
            <strong>Precio:</strong> {{ $aviso->precio }}
        </p>
    </div>

</div>
</body>
</html>
