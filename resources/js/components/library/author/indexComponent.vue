<template>
  <div>
    author index
  </div>
</template>

<script>
export default {
  name: "indexAuthorComponent",
  mounted() {
    this.getAuthor()
  },

  data() {
    return {
      author: '',
    }
  },

  methods: {
    getAuthor() {
      axios.get('/public/api/author/')
          .then(res => {
            this.author = res.data.data

          })
    },
  },
}
</script>

<style scoped>

</style>