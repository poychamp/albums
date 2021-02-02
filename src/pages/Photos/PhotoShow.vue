<template>
    <q-page class="text-center">
        <h1 class="q-mb-sm">{{ photo.title }}</h1>

        <q-img :src="photo.url" style="max-width: 600px;" />
    </q-page>
</template>

<script>
import { api } from 'boot/axios'

export default {
  name: 'PhotoShow.vue',

  async beforeRouteEnter (to, from, next) {
    const { data } = await api.get(`/api/photos/${to.params.id}`)

    next(vm => vm.setData(data.data))
  },

  data: () => ({
    photo: {}
  }),

  methods: {
    setData (photo) {
      this.photo = photo
    }
  }
}
</script>

<style scoped>

</style>
