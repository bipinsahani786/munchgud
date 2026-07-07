@extends('storefront.account.layout')

@section('styles')
    <!-- Leaflet CSS & JS for Location Pinpoint -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        #addressMap {
            height: 300px;
            width: 100%;
            border-radius: 16px;
            z-index: 10;
        }
    </style>
@endsection

@section('account_content')
<div x-data="addressForm()" class="pb-10">
    <div class="flex items-center justify-between mb-8">
        <h2 class="font-heading text-3xl font-bold text-mg-dark">Saved Addresses</h2>
        <button type="button" @click="openAdd()" x-show="!showForm" class="bg-mg-green text-white font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-mg-green-dark transition-all flex items-center gap-2">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Add Address
        </button>
    </div>

    <!-- Toggleable Add/Edit Form -->
    <div x-show="showForm" x-cloak x-transition class="bg-white rounded-3xl p-8 border border-mg-dark/5 shadow-xl shadow-mg-dark/5 mb-8">
        <h3 class="font-bold text-mg-dark mb-6 text-lg border-b border-mg-dark/5 pb-4" x-text="editMode ? 'Edit Address' : 'Add New Address'"></h3>
        
        <form :action="editMode ? `{{ route('account.addresses') }}/${addressId}` : '{{ route('account.addresses.store') }}'" method="POST" class="space-y-6">
            @csrf
            <template x-if="editMode">
                <input type="hidden" name="_method" value="PATCH">
            </template>

            <!-- Map Pinpoint Selector -->
            <div class="bg-mg-cream/50 border border-mg-dark/10 rounded-2xl p-5 mb-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h4 class="font-bold text-mg-dark text-sm flex items-center gap-1">
                            <span>📍</span> Quick Pinpoint Delivery Location
                        </h4>
                        <p class="text-xs text-mg-muted mt-0.5">Click the map to automatically pinpoint your address coordinates and pre-fill this form!</p>
                    </div>
                    <button type="button" @click="initAddressMap()" class="bg-mg-green/10 text-mg-green border border-mg-green/20 hover:bg-mg-green hover:text-white transition-all text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-1.5 self-start sm:self-center">
                        ⚡ Point Location on Map
                    </button>
                </div>
                
                <div id="addressMapContainer" class="hidden mt-4">
                    <div id="addressMap" class="w-full h-[280px] rounded-xl border border-mg-dark/10 shadow-inner mb-3"></div>
                    <p class="text-[11px] text-mg-muted flex items-center gap-1">
                        <span>ℹ️</span> Drop a pin anywhere on the map or drag the marker. We'll automatically resolve city, state, pincode, and road details.
                    </p>
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Address Type/Label</label>
                    <select name="label" x-model="label" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                        <option value="Home">Home</option>
                        <option value="Work">Work/Office</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                
                <div class="sm:col-span-2">
                    <label class="block text-sm font-bold text-mg-dark mb-2">Recipient Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" x-model="name" required class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Phone Number <span class="text-red-500">*</span></label>
                    <input type="text" name="phone" x-model="phone" required maxlength="10" minlength="10" pattern="[0-9]{10}" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20" placeholder="10-digit mobile number">
                </div>
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Country</label>
                    <input type="text" name="country" x-model="country" required class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-mg-dark mb-2">Flat / House No. / Building Name <span class="text-red-500">*</span></label>
                <input type="text" name="line1" x-model="line1" required maxlength="50" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
            </div>

            <div class="grid sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Area / Street / Sector <span class="text-red-500">*</span></label>
                    <input type="text" name="line2" x-model="line2" required maxlength="50" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Landmark (Optional)</label>
                    <input type="text" name="landmark" x-model="landmark" maxlength="50" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">City <span class="text-red-500">*</span></label>
                    <input type="text" name="city" x-model="city" required maxlength="50" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">State <span class="text-red-500">*</span></label>
                    <input type="text" name="state" x-model="state" required maxlength="50" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
                <div>
                    <label class="block text-sm font-bold text-mg-dark mb-2">Pincode <span class="text-red-500">*</span></label>
                    <input type="text" name="pincode" x-model="pincode" required maxlength="6" minlength="6" pattern="[0-9]{6}" class="w-full bg-mg-cream border border-mg-dark/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-mg-green/20">
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_default" value="1" x-model="is_default" id="is_default" class="w-4 h-4 text-mg-green focus:ring-mg-green rounded">
                <label for="is_default" class="text-sm font-semibold text-mg-dark cursor-pointer">Set as default shipping address</label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-mg-dark/5">
                <button type="button" @click="showForm = false" class="bg-mg-cream border border-mg-dark/10 text-mg-dark font-bold px-6 py-3 rounded-xl hover:bg-mg-dark/5 transition-all">Cancel</button>
                <button type="submit" class="bg-mg-green text-white font-bold px-8 py-3 rounded-xl hover:bg-mg-green-dark transition-all">Save Address</button>
            </div>
        </form>
    </div>

    <!-- Address Cards -->
    <div class="grid sm:grid-cols-2 gap-6">
        @forelse($addresses as $addr)
            <div class="bg-white rounded-3xl p-6 border {{ $addr->is_default ? 'border-mg-green border-2 shadow-lg shadow-mg-green/5' : 'border-mg-dark/5 shadow-xl shadow-mg-dark/5' }} flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full bg-mg-green/8 text-mg-green">
                            {{ $addr->label ?? 'Home' }}
                        </span>
                        @if($addr->is_default)
                            <span class="px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-full bg-mg-orange text-white">
                                Default
                            </span>
                        @endif
                    </div>
                    <p class="font-heading text-lg font-bold text-mg-dark mb-2">{{ $addr->name }}</p>
                    <p class="text-sm text-mg-muted leading-relaxed mb-4">
                        {{ $addr->line1 }}<br>
                        {{ $addr->line2 }}<br>
                        @if($addr->landmark)Landmark: {{ $addr->landmark }}<br>@endif
                        {{ $addr->city }}, {{ $addr->state }} - {{ $addr->pincode }}<br>
                        {{ $addr->country }}
                    </p>
                    <p class="text-xs text-mg-dark/70 font-semibold flex items-center gap-1.5 mb-6">
                        <svg class="w-4 h-4 text-mg-muted" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $addr->phone }}
                    </p>
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-mg-dark/5 mt-auto">
                    <div class="flex items-center gap-3">
                        <button type="button" @click='openEdit(@json($addr))' class="text-xs font-bold text-mg-green hover:underline">Edit</button>
                        <form action="{{ route('account.addresses.destroy', $addr->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this address?')" class="text-xs font-bold text-red-500 hover:underline">Remove</button>
                        </form>
                    </div>
                    @if(!$addr->is_default)
                        <form action="{{ route('account.addresses.default', $addr->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-xs font-bold text-mg-dark hover:underline">Set as Default</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-3xl p-10 border border-mg-dark/5 text-center shadow-xl shadow-mg-dark/5">
                <span class="text-5xl mb-4 block">📍</span>
                <h3 class="font-heading text-xl font-bold text-mg-dark mb-2">No Saved Addresses</h3>
                <p class="text-mg-muted mb-6">Add a shipping address for faster, hassle-free checkout.</p>
                <button type="button" @click="openAdd()" class="bg-mg-green text-white font-bold text-sm px-6 py-2.5 rounded-xl hover:bg-mg-green-dark transition-all">
                    Add Address
                </button>
            </div>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('addressForm', () => ({
            showForm: false, 
            editMode: false,
            addressId: null,
            label: '',
            name: '',
            phone: '',
            line1: '',
            line2: '',
            landmark: '',
            city: '',
            state: '',
            pincode: '',
            country: 'India',
            is_default: false,
            
            map: null,
            marker: null,
            mapLoaded: false,
            
            resetForm() {
                this.editMode = false;
                this.addressId = null;
                this.label = 'Home';
                this.name = {!! json_encode(auth()->user()->name ?? '') !!};
                this.phone = {!! json_encode(auth()->user()->phone ?? '') !!};
                this.line1 = '';
                this.line2 = '';
                this.landmark = '';
                this.city = '';
                this.state = '';
                this.pincode = '';
                this.country = 'India';
                this.is_default = false;
                if (this.mapLoaded && this.map) {
                    document.getElementById('addressMapContainer').classList.add('hidden');
                }
            },
            
            openAdd() {
                this.resetForm();
                this.showForm = true;
                this.editMode = false;
            },
            
            openEdit(addr) {
                this.addressId = addr.id;
                this.label = addr.label || 'Home';
                this.name = addr.name;
                this.phone = addr.phone;
                this.line1 = addr.line1;
                this.line2 = addr.line2 || '';
                this.landmark = addr.landmark || '';
                this.city = addr.city;
                this.state = addr.state;
                this.pincode = addr.pincode;
                this.country = addr.country || 'India';
                this.is_default = !!addr.is_default;
                this.editMode = true;
                this.showForm = true;
                if (this.mapLoaded && this.map) {
                    document.getElementById('addressMapContainer').classList.add('hidden');
                }
            },
            
            initAddressMap() {
                const container = document.getElementById('addressMapContainer');
                container.classList.remove('hidden');
                
                if (this.mapLoaded) {
                    setTimeout(() => {
                        this.map.invalidateSize();
                    }, 100);
                    return;
                }
                
                setTimeout(() => {
                    this.map = L.map('addressMap', { attributionControl: false }).setView([20.5937, 78.9629], 5);
                    
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {
                        maxZoom: 19
                    }).addTo(this.map);
                    
                    this.marker = L.marker([20.5937, 78.9629], { draggable: true }).addTo(this.map);
                    
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition((position) => {
                            const lat = position.coords.latitude;
                            const lon = position.coords.longitude;
                            this.map.setView([lat, lon], 15);
                            this.marker.setLatLng([lat, lon]);
                            this.reverseGeocode(lat, lon);
                        }, (err) => {
                            console.log('Geolocation denied or failed, staying on India view.');
                        });
                    }
                    
                    this.map.on('click', (e) => {
                        this.marker.setLatLng(e.latlng);
                        this.reverseGeocode(e.latlng.lat, e.latlng.lng);
                    });
                    
                    this.marker.on('dragend', () => {
                        const pos = this.marker.getLatLng();
                        this.reverseGeocode(pos.lat, pos.lng);
                    });
                    
                    this.mapLoaded = true;
                }, 100);
            },
            
            reverseGeocode(lat, lon) {
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data && data.address) {
                            const addr = data.address;
                            const parts = [
                                addr.amenity || addr.building || addr.house_number || '',
                                addr.road || addr.suburb || addr.neighbourhood || '',
                                addr.county || ''
                            ].filter(p => p !== '');
                            
                            this.line1 = parts.join(', ') || 'Pinpoint Location';
                            this.city = addr.city || addr.town || addr.village || '';
                            this.state = addr.state || '';
                            this.pincode = addr.postcode || '';
                            this.country = addr.country || 'India';
                        }
                    })
                    .catch(err => console.error("Geocoding error:", err));
            }
        }));
    });
</script>
@endsection
