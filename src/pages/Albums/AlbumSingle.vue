<template>
    <q-page>
        <h1 class="q-mt-none q-mb-md">Album Title</h1>

        <q-infinite-scroll @load="onLoad"
                           class="row"
                           :offset="250">
            <div v-for="(image, index) in images"
                 :key="index"
                 class="text-center col-md-3">
                <q-img :src="image.thumbnail_url"
                       spinner-color="white"
                       class="q-mb-sm"
                       style="max-width: 150px"
                />

                <div class="text-center">
                    <q-btn color="primary" class="q-mr-xs" label="View" />
                    <q-btn color="secondary" class="q-mr-xs" label="Edit" />
                    <q-btn color="deep-orange" label="Remove" />
                </div>
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
export default {
  name: 'AlbumSingle',

  data () {
    return {
      images: []
    }
  },

  methods: {
    onLoad (index, done) {
      this.images = [
        {
          title: 'some image title',
          url: 'http://some-url.com/',
          thumbnail_url: 'https://via.placeholder.com/150/92c952'
        }
      ]

      done(true)
    }
  }
}
</script>

<style scoped>

</style>
