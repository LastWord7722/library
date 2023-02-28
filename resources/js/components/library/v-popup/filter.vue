<template>
  <div>
    <button @click.prevent="AZbtnAction" class="btn btn-success"> ОТ A до Z</button> <!--A-Z-->
    <button @click.prevent="ZAbtnAction"> ОТ Z до A</button> <!--Z-A-->
  </div>
</template>

<script>
export default {
  name: "filter",

  methods:{
    AZbtnAction(){
      this.$emit('AZbtnAction')
    },
    ZAbtnAction(){
      this.$emit('ZAbtnAction')
    },
  }
}
</script>

<style scoped>

</style>