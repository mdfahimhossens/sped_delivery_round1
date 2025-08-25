@extends('layouts.app')

@section('content')
<h2>Add Delivery Zone for {{ $restaurant->name }}</h2>

<form action="{{ route('delivery-zones.store') }}" method="POST">
    @csrf
    <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">

    Type:
    <select name="type" id="zoneType">
        <option value="radius">Radius</option>
        <option value="polygon">Polygon</option>
    </select>

    <div id="radiusFields">
        Center Latitude: <input type="text" name="center_lat"><br>
        Center Longitude: <input type="text" name="center_lng"><br>
        Radius (km): <input type="text" name="radius"><br>
    </div>

    <div id="polygonFields" style="display:none;">
        Coordinates (JSON array): <textarea name="coordinates" placeholder='[{"lat":23.81,"lng":90.41},{"lat":23.82,"lng":90.42}]'></textarea>
    </div>

    <input type="hidden" name="data" id="dataInput">

    <button type="submit">Save</button>
</form>

<script>
    const zoneType = document.getElementById('zoneType');
    const radiusFields = document.getElementById('radiusFields');
    const polygonFields = document.getElementById('polygonFields');
    const form = document.querySelector('form');
    const dataInput = document.getElementById('dataInput');

    zoneType.addEventListener('change', function(){
        if(this.value === 'radius'){
            radiusFields.style.display = '';
            polygonFields.style.display = 'none';
        } else {
            radiusFields.style.display = 'none';
            polygonFields.style.display = '';
        }
    });

    form.addEventListener('submit', function(e){
        let data = {};
        if(zoneType.value === 'radius'){
            data = {
                center: {
                    lat: parseFloat(form.center_lat.value),
                    lng: parseFloat(form.center_lng.value)
                },
                radius: parseFloat(form.radius.value)
            };
        } else {
            try {
                data = { coordinates: JSON.parse(form.coordinates.value) };
            } catch(err){
                alert('Invalid JSON in coordinates');
                e.preventDefault();
            }
        }
        dataInput.value = JSON.stringify(data);
    });
</script>

@endsection
