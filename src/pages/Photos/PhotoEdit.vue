<template>
    <q-page>
        <h1 class="q-mt-none q-mb-md">Edit {{ photo.title }}</h1>

        <div class="row">
            <div class="col-md-8">
                <q-banner v-if="isShowSuccessBanner" class="bg-green text-white q-mb-lg">
                    You have successfully updated the image!
                </q-banner>

                <q-banner v-if="errors.length" class="bg-red text-white q-mb-lg">
                    <div v-for="(error, i) in errors"
                       :key="i">
                        {{ error}}
                    </div>
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
    isShowSuccessBanner: false,
    photo: {},
    errors: []
  }),

  methods: {
    setData (photo) {
      this.photo = photo
    },

    onFormSubmit () {
      this.isShowSuccessBanner = false
      this.errors = []

      api.put(`/api/photos/${this.photo.id}`, this.photo)
        .then(r => {
          this.isShowSuccessBanner = true
        }).catch(e => {
          for (const field in e.response.data.errors) {
            this.errors.push(e.response.data.errors[field][0])
          }
        })
    }
  }
}
</script>

<style scoped>

</style>
