<template>
    <q-page>
        <h1 class="q-mt-none q-mb-md">{{ album.title }}</h1>

        <q-infinite-scroll @load="onLoad"
                           class="row"
                           :offset="250">
            <div v-for="(photo, index) in photos"
                 :key="index"
                 class="text-center col-md-3 q-mb-sm">
                <q-img :src="photo.thumbnail_url"
                       spinner-color="white"
                       class="q-mb-sm"
                       style="max-width: 150px"
                />

                <div class="text-center">
                    <router-link :to="{ name: 'photos.show', params: { id: photo.id } }">
                        <q-btn color="primary" class="q-mr-xs" label="View" />
                    </router-link>

                    <q-btn color="secondary" class="q-mr-xs" label="Edit" />

                    <q-btn color="deep-orange"
                           label="Remove"
                           @click="onClickRemove(photo.id, index)" />
                </div>
            </div>

            <template v-slot:loading>
                <div class="row justify-center q-my-md">
                    <q-spinner-dots color="primary" size="40px" />
                </div>
            </template>
        </q-infinite-scroll>

        <q-dialog v-model="isShowRemovePhotoDialog" persistent>
            <q-card>
                <q-card-section class="row items-center">
                    <span class="q-ml-sm">Are you sure you want to remove this photo?</span>
                </q-card-section>

                <q-card-actions align="right">
                    <q-btn flat label="Cancel" color="primary" v-close-popup />
                    <q-btn flat
                           label="Yes"
                           color="primary"
                           @click="onClickYesRemovePhotoBtn"
                           v-close-popup />
                </q-card-actions>
            </q-card>
        </q-dialog>
    </q-page>
</template>

<script>
import { api } from 'boot/axios'

export default {
  name: 'AlbumSingle',

  async beforeRouteEnter (to, from, next) {
    const { data } = await api.get(`/api/albums/${to.params.id}`)

    next(vm => vm.setData(data.data))
  },

  data () {
    return {
      album: {},
      photos: [],
      isShowRemovePhotoDialog: false,
      removePhoto: {
        id: null,
        index: null
      }
    }
  },

  methods: {
    setData (album) {
      this.album = album
    },

    onLoad (index, done) {
      api.get(`/api/albums/${this.$route.params.id}/photos`, {
        params: { page: index }
      }).then(({ data }) => {
        this.photos = this.photos.concat(data.data)

        done(data.meta.current_page >= data.meta.last_page)
      })
    },

    onClickRemove (photoId, index) {
      this.isShowRemovePhotoDialog = true
      this.removePhoto.id = photoId
      this.removePhoto.index = index
    },

    onClickYesRemovePhotoBtn () {
      this.photos.splice(this.removePhoto.index, 1)
    }
  }
}
</script>

<style scoped>

</style>
