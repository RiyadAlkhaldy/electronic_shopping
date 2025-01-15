<x-front-layout title="Order Details">
    <x-slot:breadcrumb>
        <!-- Start Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Order #{{ $order->number }}</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i>Home</a></li>
                            <li><a href="#"> Orders</a></li>
                            <li>Order #{{ $order->number }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
    </x-slot:breadcrumb>
    <style>
        /*
* Always set the map height explicitly to define the size of the div element
* that contains the map.
*/
        #map {
            height: 50%;
            width: 70%;
        }
    </style>
    <section class="checkout-wrapper section">
        <div class="container">
            <div id="map" style="height: 200vh;"></div>
        </div>
    </section>

    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwI-_zBQgdkANbIUR6lPcLiitYMAw3Q8E"></script>
    <script>
        let map, loc, marker;

        async function initMap() {
            loc = {
                lat: {{ $delivery->lat }},
                lng: {{ $delivery->lng }}
            };
            console.log(loc);

            // loc = {
            //     lat: 15.2061057,
            //     lng: 44.2471192
            // };
            const {
                Map
            } = await google.maps.importLibrary("maps");
            // await google.maps.importLibrary('marker');

            map = new Map(document.getElementById("map"), {
                center: loc,
                zoom: 17,
            });
            // mrkr = new google.maps.Marker({
            //     position: loc,
            //     map
            // });

            marker = new google.maps.Marker({
                position: loc,
                map
            });
        }

        initMap();
        // window.initMap = initMap;
    </script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
            cluster: 'ap2',
            channelAuthorization: {
                endpoint: "/broadcasting/auth",
                headers: {
                    "X-CSRF-Token": "{{ csrf_token() }}"
                },
            },
        });

        var channel = pusher.subscribe("private-deliveries.{{ $order->id }}");
        channel.bind('location-update', function(data) {
            //  alert('data');
            // alert(JSON.stringify(data));
            //   console.log(data.delivery.lat);
            //   console.log(JSON.stringify(data));
            // var  ll = JSON.stringify(data);
            loc = {
                lat: data.delivery.lat,
                lng: data.delivery.lng
            };
            console.log(loc);

            marker.setPosition(loc);

        });
    </script>

</x-front-layout>
