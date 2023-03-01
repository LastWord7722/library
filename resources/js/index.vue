<template>

  <nav class="navbar navbar-dark bg-dark">
    <div class="d-flex flex-row m-lg-1  ">
      
        <div class="m-lg-1">
          <router-link :to="{name:'library.author.index'}" class="text-navbar"> Author </router-link>
        </div>

        <div class="m-lg-1">
          <router-link :to="{name:'library.book.index'}" class="text-navbar"> Book </router-link>
        </div>
      </div>
  </nav>

  <router-view></router-view>
</template>

<script>

export default {
  name: "index"
}
</script>

<style scoped>
  .text-navbar{
    color: white;
    text-decoration: none;
    font-size:17px;
  }
  .text-navbar:hover{
    color:green;
  }

</style>