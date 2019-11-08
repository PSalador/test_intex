<template>
    <l-map :zoom="zoom" :center="center" >
        <l-tile-layer :url="url" :attribution="attribution" />
        <div class="uk-card uk-card-default uk-width-1-4">
            <div class="uk-card-header">
                <div class="uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-expand">
                        <h4 class="uk-card-title uk-margin-remove-bottom">Категории</h4>
                        <multiselect v-model="category.value" :options="category.options" label="name" track-by="id" :multiple="true" :taggable="true" @tag="addTag"></multiselect>
                    </div>
                </div>
            </div>
            <div class="uk-card-body">
                <h5 class="uk-card-title uk-margin-remove-bottom">Коментарий</h5>
                <textarea v-model="point.comment" class="uk-textarea" rows="5" placeholder="Textarea"></textarea>
            </div>
            <div class="uk-card-footer">
                <a @click="addMarker" class="uk-button uk-button-text">Добавить</a>
            </div>
        </div>
        <div class="btn-group bottom-btn">
            <router-link :to="{name: 'map'}" class="uk-icon-button uk-margin-small-right" uk-icon="icon: location; ratio: 12">
            </router-link>
        </div>
        <l-marker :lat-lng="marker.position" :draggable="marker.draggable" @dragend="getMarkerPosition($event)"></l-marker>
    </l-map>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    export default {
        components: { Multiselect },
        data() {
            return {
                loading: true,
                zoom:13,
                center: L.latLng(55.75, 37.60),
                url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                attribution:'ИНТЕКС',
                marker: {
                    position: { lat: 55.75, lng: 37.60 },
                    draggable: true
                },
                category:{
                    value: null,
                    options: [
                    ]
                },
                point: {
                    comment:'',
                }
            };
        },
        created() {
            var app = this;
            axios.post('/api/getcategory')
                .then(function (resp) {
                    app.category.options = resp.data;
                    console.log(app.category);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load category");
                });
        },
        methods: {
            addTag (newTag) {
                var app = this;
                var newCategory = {
                    name: newTag
                };
                axios.post('/api/addcategory', newCategory)
                    .then(function (resp) {
                        app.category.options.push(resp.data);
                        app.category.value.push(resp.data);
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not add category");
                    });
            },
            addMarker() {
                var app = this;
                var newPoint = {
                    comment: this.point.comment,
                    category: this.category.value,
                    lat: this.marker.position.lat,
                    lng: this.marker.position.lng,
                };
                axios.post('/api/addpoint', newPoint)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not add point");
                    });

            },
            getMarkerPosition (marker) {
                this.marker.position.lat = marker.target._latlng.lat;
                this.marker.position.lng = marker.target._latlng.lng;
            }
        }
    };
</script>