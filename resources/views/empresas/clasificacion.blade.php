@foreach ($clasificacion as $clasificacion)
    <option value="{{$clasificacion->nombre}}">{{$clasificacion->nombre}}</option>   
@endforeach