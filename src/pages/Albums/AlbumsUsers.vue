<template>
    <q-page v-if="user.id">
        <h2 class="q-mt-none q-mb-md">{{ user.name }} Albums</h2>

        <albums-infinite-scroll api-url="/api/albums" />
    </q-page>
</template>

<script>
import { api } from 'boot/axios'
import AlbumsInfiniteScroll from 'components/AlbumsInfiniteScroll.vue'

export default {
  name: 'AlbumsUsers',

  components: {
    AlbumsInfiniteScroll
  },

  async beforeRouteEnter (to, from, next) {
    const { data } = await api.get(`/api/users/${to.params.id}`)

    next(vm => vm.setData(data.data))
  },

  data: () => ({
    user: {}
  }),

  methods: {
    setData (user) {
      this.user = user
    }
  }
}
</script>

<style scoped>

</style>
