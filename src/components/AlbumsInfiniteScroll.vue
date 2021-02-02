<template>
    <q-infinite-scroll @load="onLoad"
                       class="row"
                       :offset="250">
        <div v-for="(album, index) in albums"
             :key="index"
             class="text-center col-md-4">
            <router-link :to="{ name: 'albums.single', params: { id: album.id }}">
                <h2 class="text-h5">{{ album.title }}</h2>
            </router-link>
        </div>

        <template v-slot:loading>
            <div class="row justify-center q-my-md">
                <q-spinner-dots color="primary" size="40px" />
            </div>
        </template>
    </q-infinite-scroll>
</template>

<script>
import { api } from 'boot/axios'

export default {
  name: 'AlbumsInfiniteScroll',

  props: {
    apiUrl: {
      type: String,
      required: true
    }
  },

  data: () => ({
    albums: []
  }),

  methods: {
    onLoad (index, done) {
      api.get(this.apiUrl, {
        params: { page: index }
      }).then(({ data }) => {
        this.albums = this.albums.concat(data.data)

        done(data.meta.current_page >= data.meta.last_page)
      })
    }
  }
}
</script>

<style scoped>

</style>
