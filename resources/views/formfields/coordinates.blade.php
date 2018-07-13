<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>
@forelse($dataTypeContent->getCoordinates() as $point)
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ $point['lat'] }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ $point['lng'] }}" id="lng"/>
@empty
    <input type="hidden" name="{{ $row->field }}[lat]" value="{{ config('voyager.googlemaps.center.lat') }}" id="lat"/>
    <input type="hidden" name="{{ $row->field }}[lng]" value="{{ config('voyager.googlemaps.center.lng') }}" id="lng"/>
@endforelse

<script type="application/javascript">
    function initMap() {
                @forelse($dataTypeContent->getCoordinates() as $point)
        var center = {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}};
                @empty
        var center = {
                lat: {{ config('voyager.googlemaps.center.lat') }},
                lng: {{ config('voyager.googlemaps.center.lng') }}};
                @endforelse
        var map = new google.maps.Map(document.getElementById('map'), {
                zoom: {{ config('voyager.googlemaps.zoom') }} ,
                center: center
            });
        var markers = [];
                @forelse($dataTypeContent->getCoordinates() as $point)
        var marker = new google.maps.Marker({
                position: {lat: {{ $point['lat'] }}, lng: {{ $point['lng'] }}},
                map: map,
                draggable: true
            });
        markers.push(marker);
                @empty
        var marker = new google.maps.Marker({
                position: center,
                map: map,
                draggable: true
            });
        @endforelse

        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById('lat').value = this.position.lat();
            document.getElementById('lng').value = this.position.lng();
            console.log(event);
            //geocodePosition()
            var geocoder = new google.maps.Geocoder;
            geocoder.geocode({
                latLng: this.position,
            }, function (responses) {
                if (responses && responses.length > 0) {
                    document.getElementById('{{ $row->field }}address').innerHTML = responses[0].formatted_address;
                } else {
                    document.getElementById('{{ $row->field }}address').innerHTML = 'Cannot determine address at this location.';
                }
            });
        });
    }
</script>
<div class="card z-depth-5">
    <div id="map" class="card-body"></div>
    <div id="{{ $row->field }}address" class="font-weight-600 card-footer">
        Move The marker To Select an address.
    </div>
</div>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('voyager.googlemaps.key') }}&callback=initMap"></script>
