

<template>

  <div class="row my-4">
    
    <div class="row g-3 align-items-center">
      <div class="col-auto">
        <input type="text" class="form-control mr-sm-2" id="city-input" placeholder="City" v-model="form.city" />
      </div>
      <div class="col-auto">
        <input type="text" class="form-control mr-sm-2" id="country-input" placeholder="Country Code" v-model="form.country" />
      </div>

      <div class="col-auto">
        <button type="button" @click="search" class="btn btn-primary">Search</button>
      </div>
    </div>
  </div>
  <div class="row my-4">

    <div v-for="(location, index) in locations" :key="index" class="card my-2 mx-2" style="width: 18rem;">
      <img src="" class="card-img-top" alt="" :src="location.iconImage">
      <div class="card-body">
        <h5 class="card-title">
          {{ location.city }} - {{ location.country }}
          <img :src="location.weather_icon" class="mx-auto my-auto" height="50px">
        </h5>

        <p class="card-text">{{ location.weather_description }}</p>
        <p class="card-text">
          <small class="text-muted">Latitude:{{ location.lat  }}</small><br />
          <small class="text-muted">Longitude:{{ location.lng  }}</small>
        </p>
        <button @click="remove(location.id)" class="btn btn-danger">Remove</button>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue';

const form = ref({
  city: '',
  country: ''
});

const locations = ref([]);

const loadData = async () => {
  const { data }  = await axios.get('/api/locations');
  locations.value = data.data;
};

const search = async () => {

  await axios.post('/api/locations/search', {
    city: form.value.city,
    country: form.value.country
  });

  await loadData();
};

const remove = async (id) => {

  await axios.delete(`/api/locations/delete/${id}`)
  
  await loadData();
};

loadData();

</script>