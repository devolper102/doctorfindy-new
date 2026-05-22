<template>
  <div>
<!--    <iframe width="520" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=%20Lahore+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://www.symptoma.com/en/info/covid-19'></a>-->
    <google-map
        class="google_map"
        :center="{lat:this.$parent.lati.coords.latitude, lng:this.$parent.lati.coords.longitude}"
        :zoom="12"
        marker="true"
        :draggable="true"
        :options="{gestureHandling: 'greedy'}"
    >
     <!--  <GmapMarker
          v-for="(m, index) in markers"
          :key="index"
          :position="{lat: parseFloat(m.location.latitude), lng: parseFloat(m.location.longitude)}"
          :clickable="true"
          :draggable="true"
          :icon="markerIcon('doctor')"
      />
      <GmapMarker
          :position="{lat:this.$parent.lati.coords.latitude, lng:this.$parent.lati.coords.longitude}"
          :clickable="true"
          :draggable="true"
      /> -->
                            <gmap-info-window
                                    :zoom="12"
                                    :options="{width: 250}"
                                    :position="infoWindow.position"
                                    :opened="infoWindow.open"
                                    @closeclick="infoWindow.open=false">
                                <div v-html="infoWindow.template"></div>
                            </gmap-info-window>
      <GmapMarker ref="myMarker"
            :position="{lat:this.$parent.lati.coords.latitude, lng:this.$parent.lati.coords.longitude}"
            :title="'Your Current Postion'"
            :clickable="true"
            :draggable="true"
      />
                            <GmapMarker v-for="(doc, index) in this.markers"
                                        v-if="doc.roles[0].name === 'hospital'"
                                        v-bind:data="doc"
                                        v-bind:key="doc.text"
                                        ref="myMarker"
                                        :title="doc.first_name + ' '+ doc.last_name"
                                        :center="center"
                                        :zoom="15"
                                        :clickable="true"
                                        :draggable="true"
                                        :position="{lat:Number(doc.profile.latitude), lng:Number(doc.profile.longitude)}"
                                        @click="openInfoWindowTemplate(doc)"
                                        :icon="markerIcon('hospital')"
                            />
                            <GmapMarker v-for="(doc, index) in this.markers"
                                        v-if="doc.roles[0].name === 'doctor'"
                                        v-bind:data="doc"
                                        v-bind:key="doc.text"
                                        ref="myMarker"
                                        :title="doc.first_name + ' '+ doc.last_name"
                                        :center="center"
                                        :zoom="15"
                                        :clickable="true"
                                        :draggable="true"
                                        :position="{lat:Number(doc.profile.latitude), lng:Number(doc.profile.longitude)}"
                                        @click="openInfoWindowTemplate(doc)"
                                        :icon="markerIcon('doctor')"                            />
    </google-map>
  </div>
</template>

<script>
import * as VueGoogleMaps from 'vue2-google-maps'
import GmapMarker from 'vue2-google-maps/src/components/marker'
Vue.component('GmapMarker', GmapMarker)

/*Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCTtKFT6ROLiapWLQf-ATNCdy5fn_VJ68s',
  },
  installComponents: false
});*/


Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCTtKFT6ROLiapWLQf-ATNCdy5fn_VJ68s',
    libraries: 'places',
  },
})
Vue.component('google-map', VueGoogleMaps.Map);
Vue.component('gmap-info-window', VueGoogleMaps.InfoWindow)

export default {
  name: "MapSectionComponent",
  data() {
    return {
      markers: [],
      infoWindow: {
                position: {lat: 0, lng: 0},
                open: false,
                template: ''
              },
      markerIcons: {
        doctor: null,
        hospital: null,
      },
    }
  },
  created () {
    this.markers = this.$parent.userData
  },
  mounted () {
    this.loadMarkerIcon('doctor')
    this.loadMarkerIcon('hospital')
  },
   methods: {
          loadMarkerIcon (type) {
          const url = `/uploads/markers/${type}.png`
          const image = new Image()
          image.onload = () => {
            this.$set(this.markerIcons, type, {url})
          }
          image.onerror = () => {
            this.$set(this.markerIcons, type, null)
          }
          image.src = url
        },
          markerIcon (type) {
          return this.markerIcons[type] || null
        },
          openInfoWindowTemplate (item) {
          this.setInfoWindowTemplate(item)
          this.infoWindow.position = {lat:Number(item.profile.latitude), lng:Number(item.profile.longitude)};
          this.infoWindow.open = true
        },
        setInfoWindowTemplate: function (marker) {
          
          this.infoWindow.template = `
          <div>
          <img src="${'/uploads/users/'+marker.profile.user_id+'/small-' + marker.profile.avatar}" :alt="marker.profile.avatar" :alt-text="marker.first_name + ' ' + marker.last_name" class="map_img">
            <div class="item_details">
              <h6>${marker.first_name+' '+marker.last_name}</h6> <p>${marker.profile.sub_heading}</p>
              <p>${marker.profile.address}</p>
              <p>${marker.assistant_phone_number}</p>
            </div>
           </div>`;
          return this.infoWindow.template;
        }
        },
}
</script>

<style>
.map_img{
  float: left;
  width: 50px;
  margin-right:10px;
}
.gm-style .gm-style-iw-c{
  max-width: 250px !important;
  max-height: 250px !important;
}
.item_details{
  width:160px;
  float:left;
}
</style>