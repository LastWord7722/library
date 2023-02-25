<template>
  <div class="v-popup">
    <div class="v-popup__header text-center">
    <p class="text-center fs-2">{{nameTitle}}</p>
    </div>

    <div class="v-popup__content">
      <div class="p-3 col-12">
        <slot>

        </slot>
      </div>
    </div>

    <div class="v-popup__footer">
      <button @click.prevent="closePopup" class="btn btn-danger"> Закрыть</button>
      <button class="btn btn-primary" @click.prevent="rightBtnAction">{{rightBtn}}</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-popup",
  props:{
    nameTitle:{
      type: String,
      default: 'добавить'
    },
    rightBtn: {
      type: String,
      default: 'ok'
    },


  },
  methods:{

    rightBtnAction(){
      this.$emit('rightBtnAction')
    },

    closePopup(){
      this.$emit('closePopup')
    }
  }
}

</script>

<style lang="scss" scoped>
  .v-popup {
    padding: 16px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 65%;
    height: 95%;
    background: #ffffff;
    box-shadow: 0 0 60px 10px rgba(0, 0, 0, 0.9);
    z-index: 10;
    border: #1a202c;


  &__header, &__footer{
    display: flex;
    justify-content: space-between;
    align-items: center;

              }
  &__content{
     display: flex;
     justify-content: flex-start;
     align-items: center;
      width: 100%;
   }
  }
</style>