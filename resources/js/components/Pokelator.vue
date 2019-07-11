<template>
  <div class="container">
    <h1 class="text-center">Pokelator</h1>
    <h2 class="text-center">Pokemon damage simulator</h2>
    <div class="row mb-4">
      <input type="text" class="form-control col-md-9" v-model="keyword" @keyup.enter="searchPokemon" autofocus>
      <button type="button" class="btn btn-primary col-md-3" @click="searchPokemon">Search</button>
    </div>
    <div v-if="pokemon.hasOwnProperty('name')">
      <img :src="`storage/images/${pokemon.image}`" alt="" class="mb-2" width="200px">
      <table class="table table-striped table-bordered">
        <tr>
          <th>No</th>
          <td>{{ pokemon.no }}</td>
        </tr>
        <tr>
          <th>名前</th>
          <td>{{ pokemon.name }}</td>
        </tr>
        <tr>
          <th>タイプ</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in pokemon.types">
              <span class="badge text-white" :class="getBadgeClass(type)">{{ type }}</span>
            </h5>
          </td>
        </tr>
        <tr>
          <th>ばつぐん</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in affinities.good">
              <span class="badge text-white" :class="getBadgeClass(type)">{{ type }}</span>
            </h5>
          </td>
        </tr>
        <tr>
          <th>等倍</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in affinities.normal">
              <span class="badge text-white" :class="getBadgeClass(type)">{{ type }}</span>
            </h5>
          </td>
        </tr>
        <tr>
          <th>いまひとつ</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in affinities.poor">
              <span class="badge text-white" :class="getBadgeClass(type)">{{ type }}</span>
            </h5>
          </td>
        </tr>
        <tr>
          <th>なし</th>
          <td>
            <h5 class="d-inline mr-1" v-for="type in affinities.bad">
              <span class="badge text-white" :class="getBadgeClass(type)">{{ type }}</span>
            </h5>
          </td>
        </tr>
      </table>
    </div>
    <div v-if="!pokemon.hasOwnProperty('name')">
      <p class="text-center">該当するポケモンがいませんでした</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      keyword: '',
      pokemon: [],
      affinities: [],
    }
  },
  methods: {
    // ポケモンの検索
    searchPokemon() {
      axios.get(`/api/pokemon/search/${this.keyword}`).then(response => {
        this.pokemon = response.data;
        console.log(response.data.hasOwnProperty('name'))
        this.fetchAffinities(response.data.types);
      });
    },
    // ポケモンのタイプに対するわざの相性を取得
    fetchAffinities(types) {
      axios.get(`/api/pokemon/affinity`, {
        params: {
          types: types
        }
      }).then(response => {
        this.affinities = response.data;
      });
    },
    // ポケモンのタイプによってbadgeのclassを設定
    getBadgeClass(type) {
      const obj = {};

      if      (type === 'ノーマル') obj['badge-normal'] = true;
      else if (type === 'かくとう') obj['badge-fighting'] = true;
      else if (type === 'ひこう') obj['badge-flying'] = true;
      else if (type === 'どく') obj['badge-poison'] = true;
      else if (type === 'じめん') obj['badge-ground'] = true;
      else if (type === 'いわ') obj['badge-rock'] = true;
      else if (type === 'むし') obj['badge-bug'] = true;
      else if (type === 'ゴースト') obj['badge-ghost'] = true;
      else if (type === 'はがね') obj['badge-steel'] = true;
      else if (type === 'ほのお') obj['badge-fire'] = true;
      else if (type === 'みず') obj['badge-water'] = true;
      else if (type === 'くさ') obj['badge-grass'] = true;
      else if (type === 'でんき') obj['badge-electric'] = true;
      else if (type === 'エスパー') obj['badge-psychic'] = true;
      else if (type === 'こおり') obj['badge-ice'] = true;
      else if (type === 'ドラゴン') obj['badge-dragon'] = true;
      else if (type === 'あく') obj['badge-dark'] = true;
      else if (type === 'フェアリー') obj['badge-fairy'] = true;

      return obj;
    },
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