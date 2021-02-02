<template>
    <q-page class="text-center">
        <h1 class="q-mb-sm">{{ photo.title }}</h1>

        <q-img :src="photo.url" style="max-width: 600px;" />
    </q-page>
</template>

<script>
export default {
  name: 'PhotoShow.vue',

  data: () => ({
    photo: {
      title: 'Some Title',
      url: 'https://via.placeholder.com/600/771796'
    }
  })
}
</script>

<style scoped>

</style>
