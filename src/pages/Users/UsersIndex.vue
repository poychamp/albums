<template>
    <q-page>
        <q-infinite-scroll @load="onLoad"
                           class="row"
                           :offset="250">
            <div v-for="(user, index) in users"
                 :key="index"
                 class="text-center col-md-4">
                <a href="#">
                    <h2 class="text-h5 text-center" to="/">{{ user.name }}</h2>
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
  name: 'UsersIndex',

  data: () => ({
    users: []
  }),

  methods: {
    onLoad (index, done) {
      api.get('/api/users', {
        params: { page: index }
      }).then(({ data }) => {
        this.users = this.users.concat(data.data)

        done(data.meta.current_page >= data.meta.last_page)
      })
    }
  }
}
</script>

<style scoped>

</style>
