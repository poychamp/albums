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
// import { api } from 'boot/axios'

export default {
  name: 'UsersIndex',

  data: () => ({
    users: []
  }),

  methods: {
    onLoad (index, done) {
      this.users = [
        { name: 'User 1' },
        { name: 'User 2' },
        { name: 'User 3' }
      ]
      done(true)
    }
  }
}
</script>

<style scoped>

</style>
