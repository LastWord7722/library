<template>
  <router-link :to="{name:'library.author.index'}"> author</router-link>
  <router-link :to="{name:'library.book.index'}"> book</router-link>
  <router-view></router-view>
</template>

<script>
export default {
  name: "index"
}
</script>

<style scoped>

</style>