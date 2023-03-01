<template>
  <v-popup v-if="isPopupInviseble"
           @leftBtnAction="ClosePopup"
           @rightBtnAction="createAuthor"
           rightBtn='Добавить'
           nameTitle='Добавить автора:'>
    <!--слот-->
    <slot>
      <!--создание-->
      <div class="flex-column">
        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Имя (Обязательное поле)</span>
          <input type="text" v-model="first_name" class="form-control">
        </div>

        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Фамилия(Обязательное поле)</span>
          <input type="text" v-model="last_name" class="form-control">
        </div>
        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Очество </span>
          <input type="text" v-model="middle_name" class="form-control">
        </div>
      </div>
      <!-- книги     -->
      <div class="row col-12">
        <div class="" aria-label="Basic checkbox toggle button group">
          <p class="text-center fw-bolder fs-4">Выберите книги!</p>
          <template v-for="book in books">
            <input type="checkbox" class="btn-check" :id="book.id" v-model="checkbBookId" :value='book.id'>
            <label class="author btn btn-outline-primary" :for="book.id">
              {{ book.title }}
            </label>
          </template>
        </div>
      </div>
    </slot>
  </v-popup>
  <button @click.prevent="ShowPopup" class="grn-btn btn btn-success col-12">Добавить автора</button>
</template>

<script>
import vPopup from '../v-popup/v-popup.vue'

export default {
  name: "authorCreateComponent",

  data() {
    return {
      books: [],
      isPopupInviseble: false,

      //создание
      checkbBookId: [],
      last_name: '',
      middle_name: '',
      first_name: '',
    }
  },

  components: {
    vPopup,
  },

  methods: {

    getBook() {
      axios.get('/api/book/')
          .then(res => {
            this.books = res.data.data
          })
    },

    createAuthor() {
      axios.post('/api/author/store', {
            last_name: this.last_name,
            middle_name: this.middle_name,
            first_name: this.first_name,
            book_ids: this.checkbBookId,
          })
          .then(res => {
            console.log(res)
            alert('Автор добавлен')
            this.$parent.getAuthors
            this.ClosePopup()
          })
    },

    ClosePopup() {
      this.isPopupInviseble = false
    },

    ShowPopup() {
      this.isPopupInviseble = true
      this.getBook()
    },
  }
}
</script>

<style scoped>
.informs {
  height: 150px;
  margin-top: 10px;
  margin-bottom: 10px;
}

.author {
  flex-wrap: wrap;
}
</style>