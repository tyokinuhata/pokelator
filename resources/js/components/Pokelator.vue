<template>
  <div class="container">
    <h1 class="text-center">Pokelator</h1>
    <h2 class="text-center">Pokemon damage simulator</h2>
    <div class="row mb-4">
      <input type="text" class="form-control col-md-9" v-model="keyword" @keyup.enter="search" autofocus>
      <button type="button" class="btn btn-primary col-md-3" @click="search">Search</button>
    </div>
    <div v-if="pokemon">
      <img :src="`storage/images/${pokemon.image}`" alt="" width="200px">
      <table class="table table-striped table-bordered">
        <tr>
          <th>No</th>
          <td>{{ pokemon.no }}</td>
        </tr>
        <tr>
          <th>Name</th>
          <td>{{ pokemon.name }}</td>
        </tr>
        <tr>
          <th>タイプ</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in pokemon.types">
              <span class="badge badge-normal" v-if="type === 'ノーマル'">{{ type }}</span>
              <span class="badge badge-fighting" v-if="type === 'かくとう'">{{ type }}</span>
              <span class="badge badge-flying" v-if="type === 'ひこう'">{{ type }}</span>
              <span class="badge badge-poison" v-if="type === 'どく'">{{ type }}</span>
              <span class="badge badge-ground" v-if="type === 'じめん'">{{ type }}</span>
              <span class="badge badge-rock" v-if="type === 'いわ'">{{ type }}</span>
              <span class="badge badge-bug" v-if="type === 'むし'">{{ type }}</span>
              <span class="badge badge-ghost" v-if="type === 'ゴースト'">{{ type }}</span>
              <span class="badge badge-steel" v-if="type === 'はがね'">{{ type }}</span>
              <span class="badge badge-fire" v-if="type === 'ほのお'">{{ type }}</span>
              <span class="badge badge-water" v-if="type === 'みず'">{{ type }}</span>
              <span class="badge badge-grass" v-if="type === 'くさ'">{{ type }}</span>
              <span class="badge badge-electric" v-if="type === 'でんき'">{{ type }}</span>
              <span class="badge badge-psychic" v-if="type === 'エスパー'">{{ type }}</span>
              <span class="badge badge-ice" v-if="type === 'こおり'">{{ type }}</span>
              <span class="badge badge-dragon" v-if="type === 'ドラゴン'">{{ type }}</span>
              <span class="badge badge-dark" v-if="type === 'あく'">{{ type }}</span>
              <span class="badge badge-fairy" v-if="type === 'フェアリー'">{{ type }}</span>
            </h5>
          </td>
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

<style lang="scss" scoped>
  .badge {
    &-normal {
      background: #aea886;
    }
    &-fighting {
      background: #9a3d3e;
    }
    &-flying {
      background: #7e9ecf;
    }
    &-poison {
      background: #8f5b98;
    }
    &-ground {
      background: #916d3c;
    }
    &-rock {
      background: #878052;
    }
    &-bug {
      background: #989001;
    }
    &-ghost {
      background: #555fa4;
    }
    &-steel {
      background: #9b9b9b;
    }
    &-fire {
      background: #f45c19;
    }
    &-water {
      background: #4a96d6;
    }
    &-grass {
      background: #28b25c;
    }
    &-electric {
      background: #eaa317;
    }
    &-psychic {
      background: #d56d8b;
    }
    &-ice {
      background: #45a9c0;
    }
    &-dragon {
      background: #454ba6;
    }
    &-dark {
      background: #7a0049;
    }
    &-fairy {
      background: #ffbbff;
    }
  }
</style>