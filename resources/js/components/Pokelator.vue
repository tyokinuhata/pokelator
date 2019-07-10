<template>
  <div class="container">
    <h1 class="text-center">Pokelator</h1>
    <h2 class="text-center">Pokemon damage simulator</h2>
    <div class="row mb-4">
      <input type="number" class="form-control col-md-9" v-model="keyword" autofocus>
      <button type="button" class="col-md-3" @click="search">Search</button>
    </div>
    <div v-if="pokemon">
      <table class="table table-striped table-bordered">
        <tr>
          <th>No</th>
          <td>{{ pokemon.no }}</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>{{ pokemon.name }}</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      keyword: '',
      pokemon: null,
    }
  },
  methods: {
    search() {
      axios.get(`/api/pokemon/search/${this.keyword}`).then(response => {
        this.pokemon = response.data;
      });
    }
  }
}
</script>