<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Tracking Map</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        body, html { margin: 0; padding: 0; height: 100%; font-family: 'Outfit', sans-serif; background: #FAFAF5; overflow: hidden; }
        #map { height: 100vh; width: 100vw; z-index: 1; }
        .custom-tooltip {
            background: rgba(15, 31, 22, 0.95);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 11px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .custom-tooltip::before {
            border-top-color: rgba(15, 31, 22, 0.95);
        }
        /* Animated pulsing dot for active state */
        .pulsing-icon {
            background: #2B6E2F;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(43, 110, 47, 0.7);
            animation: pulse 1.6s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(43, 110, 47, 0.7);
            }
            70% {
                transform: scale(1.1);
                box-shadow: 0 0 0 10px rgba(43, 110, 47, 0);
            }
            100% {
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(43, 110, 47, 0);
            }
        }
    </style>
</head>
<body>

    <!-- Loading Screen -->
    <div id="loading" class="absolute inset-0 bg-stone-900/90 z-[9999] flex flex-col items-center justify-center text-white">
        <div class="animate-spin rounded-full h-12 w-12 border-4 border-emerald-500 border-t-transparent mb-4"></div>
        <p class="text-sm font-semibold tracking-wider text-emerald-400 uppercase">Connecting to Logistics Map...</p>
        <p class="text-xs text-stone-400 mt-1">Resolving route to {{ $order->shipping_city }}, {{ $order->shipping_state }}</p>
    </div>

    <!-- Map Container -->
    <div id="map"></div>

    <!-- Dynamic Status Overlay -->
    <div class="absolute bottom-6 left-6 right-6 z-[999] bg-[#0F1F16]/95 backdrop-blur-md rounded-2xl p-4 border border-white/[0.08] shadow-2xl flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-xl">
                @if($order->status === 'delivered')
                    ✅
                @elseif($order->status === 'cancelled')
                    ❌
                @else
                    🚚
                @endif
            </div>
            <div>
                <p class="text-xs text-white/40 uppercase tracking-widest font-bold">Live Order Tracker</p>
                <p class="text-sm font-bold text-white mt-0.5">Order #{{ $order->order_number }} • <span class="text-emerald-400 font-semibold">{{ ucfirst($order->status) }}</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-6">
            <div class="text-right hidden sm:block">
                <p class="text-xs text-white/40">Fulfillment Hub</p>
                <p class="text-xs font-semibold text-white mt-0.5">Patna, Bihar (Farms)</p>
            </div>
            <div class="h-8 w-px bg-white/10 hidden sm:block"></div>
            <div class="text-right">
                <p class="text-xs text-white/40">Shipping Destination</p>
                <p class="text-xs font-semibold text-white mt-0.5">{{ $order->shipping_city }}, {{ $order->shipping_state }}</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const originFarms = [25.5941, 85.1376]; // Patna, Bihar (MunchGud Sourcing)
            const originHub = [28.6139, 77.2090]; // New Delhi Hub (Fulfillment Center)
            let destination = null;
            
            const city = "{{ $order->shipping_city }}";
            const state = "{{ $order->shipping_state }}";
            const status = "{{ $order->status }}";

            // Initialize Map
            const map = L.map('map', {
                zoomControl: false,
                attributionControl: false
            }).setView([23.5, 80.0], 5); // Center on India

            // Custom Leaflet Dark/Muted Tile Theme (CartoDB Positron/Dark Matter)
            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                maxZoom: 19
            }).addTo(map);

            // Add Custom Zoom Control to top right
            L.control.zoom({ position: 'topright' }).addTo(map);

            // Geocode Customer City using OSM Nominatim (free)
            const geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(city + ',' + state + ',India')}`;
            
            fetch(geocodeUrl)
                .then(res => res.json())
                .then(data => {
                    if (data && data.length > 0) {
                        destination = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                    } else {
                        // Fallback coordinates for major cities if geocoding fails
                        console.warn("Geocoding failed, falling back to major hub.");
                        const fallbacks = {
                            'mumbai': [19.0760, 72.8777],
                            'delhi': [28.6139, 77.2090],
                            'bangalore': [12.9716, 77.5946],
                            'hyderabad': [17.3850, 78.4867],
                            'kolkata': [22.5726, 88.3639],
                            'chennai': [13.0827, 80.2707],
                            'patna': [25.5941, 85.1376],
                            'pune': [18.5204, 73.8567],
                            'jaipur': [26.9124, 75.7873],
                            'lucknow': [26.8467, 80.9462],
                        };
                        const key = city.toLowerCase().trim();
                        destination = fallbacks[key] || [19.0760, 72.8777]; // Default to Mumbai
                    }
                    
                    renderRoute();
                })
                .catch(err => {
                    console.error("Error geocoding city:", err);
                    destination = [19.0760, 72.8777]; // Default fallback
                    renderRoute();
                });

            function renderRoute() {
                // Remove loader
                document.getElementById('loading').style.display = 'none';

                // Icons
                const farmIcon = L.divIcon({
                    html: '<div class="w-8 h-8 rounded-full border-2 border-white shadow-lg bg-emerald-700 flex items-center justify-center text-xs">🌿</div>',
                    className: '', iconSize: [32, 32], iconAnchor: [16, 16]
                });

                const hubIcon = L.divIcon({
                    html: '<div class="w-8 h-8 rounded-full border-2 border-white shadow-lg bg-amber-600 flex items-center justify-center text-xs">🏢</div>',
                    className: '', iconSize: [32, 32], iconAnchor: [16, 16]
                });

                const homeIcon = L.divIcon({
                    html: '<div class="w-8 h-8 rounded-full border-2 border-white shadow-lg bg-sky-600 flex items-center justify-center text-xs">📍</div>',
                    className: '', iconSize: [32, 32], iconAnchor: [16, 16]
                });

                // Add Markers
                L.marker(originFarms, {icon: farmIcon}).addTo(map)
                    .bindTooltip("MunchGud Makhana Farms<br><span class='text-[10px] text-stone-400 font-normal'>Sourced directly from Mithila, Bihar</span>", {
                        permanent: false, direction: 'top', className: 'custom-tooltip'
                    });

                L.marker(originHub, {icon: hubIcon}).addTo(map)
                    .bindTooltip("MunchGud Fulfillment Hub<br><span class='text-[10px] text-stone-400 font-normal'>New Delhi Central Hub</span>", {
                        permanent: false, direction: 'top', className: 'custom-tooltip'
                    });

                L.marker(destination, {icon: homeIcon}).addTo(map)
                    .bindTooltip(`Shipping Address<br><span class='text-[10px] text-stone-400 font-normal'>${city}, ${state}</span>`, {
                        permanent: true, direction: 'top', className: 'custom-tooltip'
                    });

                // Draw Path
                const farmToHubCoords = [originFarms, originHub];
                const hubToDestCoords = [originHub, destination];

                // Farm to Hub (Patna -> Delhi) - Solid green line representing sourcing
                L.polyline(farmToHubCoords, {
                    color: '#047857', weight: 3, opacity: 0.5, dashArray: '5, 8'
                }).addTo(map);

                // Hub to Destination - Shipment transit route
                const transitPath = L.polyline(hubToDestCoords, {
                    color: '#2563EB', weight: 4, opacity: 0.8
                }).addTo(map);

                // Determine truck position along the transit line
                let truckLocation = originHub; // Default
                let positionLabel = "Fulfillment Hub (Delhi)";

                if (status === 'delivered') {
                    truckLocation = destination;
                    positionLabel = "Delivered at Destination!";
                } else if (status === 'shipped') {
                    // Place truck in middle of transit route
                    truckLocation = [
                        (originHub[0] + destination[0]) / 2,
                        (originHub[1] + destination[1]) / 2
                    ];
                    positionLabel = "In Transit (Out for Delivery)";
                } else if (status === 'cancelled') {
                    truckLocation = originHub;
                    positionLabel = "Cancelled";
                } else {
                    // pending, confirmed, processing
                    truckLocation = originHub;
                    positionLabel = "Fulfillment Center (Processing)";
                }

                // Add Truck / Delivery Dot Marker
                const truckIcon = L.divIcon({
                    html: '<div class="w-9 h-9 rounded-full border-2 border-white shadow-xl bg-emerald-600 flex items-center justify-center pulsing-icon text-sm">🚚</div>',
                    className: '', iconSize: [36, 36], iconAnchor: [18, 18]
                });

                L.marker(truckLocation, {icon: truckIcon}).addTo(map)
                    .bindTooltip(`Package Status: ${positionLabel}`, {
                        permanent: true, direction: 'bottom', className: 'custom-tooltip'
                    });

                // Adjust bounds to fit route
                const group = new L.featureGroup([
                    L.marker(originFarms),
                    L.marker(originHub),
                    L.marker(destination)
                ]);
                map.fitBounds(group.getBounds().pad(0.15));
            }
        });
    </script>
</body>
</html>
