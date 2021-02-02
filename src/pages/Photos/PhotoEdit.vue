<template>
    <q-page>
        <h1 class="q-mt-none q-mb-md">Edit {{ photo.title }}</h1>

        <div class="row">
            <div class="col-md-8">
                <q-banner class="bg-green text-white q-mb-lg">
                    You have successfully updated the image!
                </q-banner>

                <q-banner class="bg-red text-white q-mb-lg">
                    Title is required.<br>
                    URL is required.
                </q-banner>

                <q-form
                        class="q-gutter-md"
                        @submit="onFormSubmit"
                >
                    <q-input
                            filled
                            v-model="photo.title"
                            label="Title"
                    />

                    <q-input
                            filled
                            v-model="photo.url"
                            label="URL"
                    />

                    <q-input
                            filled
                            v-model="photo.thumbnail_url"
                            label="Thumbnail URL"
                    />

                    <div>
                        <q-btn label="Submit" type="submit" color="primary"/>
                    </div>
                </q-form>
            </div>
        </div>

    </q-page>
</template>

<script>
import { api } from 'boot/axios'

export default {
  async beforeRouteEnter (to, from, next) {
    const { data } = await api.get(`/api/photos/${to.params.id}`)

    next(vm => vm.setData(data.data))
  },

  name: 'PhotoEdit',

  data: () => ({
    photo: {}
  }),

  methods: {
    setData (photo) {
      this.photo = photo
    },

    onFormSubmit () {
      console.log('something')
    }
  }
}
</script>

<style scoped>

</style>
