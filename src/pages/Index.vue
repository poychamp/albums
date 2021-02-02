<template>
  <q-page>
      <q-infinite-scroll @load="onLoad"
                         class="row"
                         :offset="250">
        <div v-for="(item, index) in items" :key="index" class="text-center col-md-4">
          <a href="#">
            <h2 class="text-h5">Album Name</h2>
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
export default {
  name: 'PageIndex',

  data () {
    return {
      items: [{}, {}, {}, {}]
    }
  },

  methods: {
    onLoad (index, done) {
      setTimeout(() => {
        // this.items.push({}, {}, {})
        done(true)
      }, 2000)
    }
  }
}
</script>
