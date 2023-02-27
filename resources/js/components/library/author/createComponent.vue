<template>
  <v-popup v-if="isPopupInviseble"
           @closePopup="ClosePopup"
           @rightBtnAction="createBook"
           rightBtn = 'Добавить'
           nameTitle = 'Добавить книгу:'>
    <!--слот-->
    <slot>
      <div>
        <label class=" text-center fw-bolder fs-4"> Выберите Обложку</label>
        <div class="card-body img-fluid">
          <input v-on:change="inputFileChange" type="file" id="file" ref="file" >
        </div>
      </div>
      <div class="flex-column">
        <div class="input-group  mt-3 w-100">
          <span class="input-group-text"  >Название книги</span>
          <input type="text" v-model="title" class="form-control">
        </div>
      </div>

      <div class="form-floating">
        <textarea class="form-control informs"  v-model="info" placeholder="Leave a comment here"></textarea>
        <label >Кратакая информация</label>
      </div>
      <!--         вывод автора-->
      <div class="row col-12">
        <div class="" aria-label="Basic checkbox toggle button group">
          <p class="text-center fw-bolder fs-4">Выберите автора!</p>
          <template v-for="authorBook in author">

            <input type="checkbox" class="btn-check" :id="authorBook.id" v-model="checkAuthorId" :value='authorBook.id'>

            <label class="author btn btn-outline-primary" :for="authorBook.id">
              {{ authorBook.last_name + ' ' + authorBook.first_name + '  ' }}
            </label>

          </template>
        </div>

      </div>
    </slot>

  </v-popup>
  <button @click.prevent="ShowPopup" class="grn-btn btn btn-success col-12">Добавить книгу</button>
</template>

<script>
import vPopup from '../v-popup/v-popup.vue'
export default {
  name: "createComponent",

  data() {
    return {
      author: [],
      isPopupInviseble: false,
      //создание
      checkAuthorId: [],
      title: '',
      info: '',
      file: '',
    }

  },
  components:{
    vPopup,
  },
  methods: {

    getAuthor() {
      axios.get('/public/api/author/')
          .then(res => {
            this.author = res.data.data
          })
    },

    inputFileChange(){
      this.file = this.$refs.file.files[0];
    },

    createBook() {
      axios.post('/public/api/book/store', {title: this.title, info: this.info,author_ids: this.checkAuthorId, image: this.file },)
          .then(res => {
            alert('Книга успешно загружена')
            this.$parent.getBook()
            this.ClosePopup()
          })
    },

    ClosePopup() {
      this.isPopupInviseble = false
    },

    ShowPopup() {
      this.isPopupInviseble = true
      this.getAuthor()
    },
  }
}
</script>

<style scoped>
.informs{
  height: 150px;
  margin-top: 10px;
  margin-bottom: 10px;
}

.author{
  flex-wrap: wrap;
}
</style>