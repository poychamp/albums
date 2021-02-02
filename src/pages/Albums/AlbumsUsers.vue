<template>
    <q-page v-if="user.id">
        <h2 class="q-mt-none q-mb-md">My Name's Albums</h2>

        <albums-infinite-scroll api-url="/api/albums" />
    </q-page>
</template>

<script>
import AlbumsInfiniteScroll from 'components/AlbumsInfiniteScroll.vue'

export default {
  name: 'AlbumsUsers',

  components: {
    AlbumsInfiniteScroll
  },

  data: () => ({
    user: {
      id: 1
    }
  })
}
</script>

<style scoped>

</style>
