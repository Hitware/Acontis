@foreach ($servicios as $servicio)
    <option value="{{$servicio->nombre}}">{{$servicio->nombre}}</option>
@endforeach