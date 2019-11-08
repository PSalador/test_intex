<template>
    <div v-if="loading" class="uk-height-1-1">
        <div class="uk-height-1-1 uk-flex uk-flex-center uk-flex-middle">
            <div uk-spinner="ratio: 3"></div>
        </div>
    </div>
    <l-map
            v-else
            :zoom="zoom"
            :center="center"
            @update:center="centerUpdate"
            @update:zoom="zoomUpdate"
    >
        <l-tile-layer :url="url" :attribution="attribution" />
        <div class="btn-group bottom-btn">
            <router-link :to="{name: 'addMarker'}" class="uk-icon-button uk-margin-small-right" uk-icon="icon: plus-circle; ratio: 12">
            </router-link>
        </div>
        <l-marker v-for="marker in markers" :key="marker.id" :lat-lng="marker">
            <l-popup>
                <div>
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">{{ marker.categories_in_string }}</h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">{{ marker.created_at }}</time></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div>
                    <p>{{ marker.comment }}</p>
                </div>
            </l-popup>
        </l-marker>
    </l-map>
</template>

<script>
    export default {
        data() {
            return {
                loading: true,
                zoom:13,
                center: L.latLng(55.75, 37.60),
                url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution:'ИНТЕКС',
                markers: []
            };
        },
        created() {
            var app = this;
            axios.post('/api/getpoints')
                .then(function (resp) {
                    app.markers = resp.data;
                    app.loading = false;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load points");
                });
       },
        methods: {
            zoomUpdate(zoom) {
                this.currentZoom = zoom;
            },
            centerUpdate(center) {
                this.currentCenter = center;
            },
            addMarker(event) {
                this.markers.push(event.latlng);
            }
        }
    };
</script>