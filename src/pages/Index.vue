<template>
  <q-page>
      <q-infinite-scroll @load="onLoad"
                         class="row"
                         :offset="250">
        <div v-for="(album, index) in albums" :key="index" class="text-center col-md-4">
          <a href="#">
            <h2 class="text-h5">{{ album.title }}</h2>
          </a>
        </div>

        <template v-slot:loading>
          <div class="row justify-center q-my-md">
            <q-spinner-dots color="primary" size="40px" />
          </div>
        </template>
      </q-infinite-scroll>
  </q-page>
</template>

<script>
import { api } from 'boot/axios'

export default {
  name: 'PageIndex',

  data () {
    return {
      albums: []
    }
  },

  methods: {
    onLoad (index, done) {
      api.get('/api/albums', {
        params: { page: index }
      }).then(({ data }) => {
        this.albums = this.albums.concat(data.data)

        done(data.meta.current_page >= data.meta.last_page)
      })
    }
  }
}
</script>
