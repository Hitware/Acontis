@foreach ($sedes as $sede)
    <option value="{{$sede->nombre_ciudad}}">{{$sede->nombre_ciudad}}</option>
@endforeach