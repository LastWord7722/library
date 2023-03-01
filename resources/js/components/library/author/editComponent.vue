<template>
  <v-popup v-if="isPopupInviseble"
           @leftBtnAction="ClosePopup"
           @rightBtnAction="updateAuthor(this.id)"
           rightBtn='Добавить'
           nameTitle='Обноавить автора:'>
    <!--слот-->
    <slot>
      <!--создание-->
      <div class="flex-column">
        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Имя</span>
          <input type="text" v-model="first_nameEdit" class="form-control">
        </div>

        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Фамилия</span>
          <input type="text" v-model="last_nameEdit" class="form-control">
        </div>
        <div class="input-group  mt-3 w-50">
          <span class="input-group-text">Очество</span>
          <input type="text" v-model="middle_nameEdit" class="form-control">
        </div>
      </div>

      <h3 class="text-center"> Выбранные книги! </h3>
      <template  v-for="book in authors.books">
        <p class="text-center">{{'#'+ book.id+ book.title}}</p>
      </template>

      <!-- книги     -->
      <div class="row col-12">
        <div class="" aria-label="Basic checkbox toggle button group">
          <p class="text-center fw-bolder fs-4">Выберите другие книги!(Обязательное поле)</p>
          <template v-for="book in books">

            <input type="checkbox" class="btn-check" :id="book.id" v-model="newBookId" :value='book.id'>

            <label class="author btn btn-outline-primary" :for="book.id">
              {{ book.title }}
            </label>

          </template>
        </div>

      </div>
    </slot>

  </v-popup>
  <button @click.prevent="EditShowPopup" class="grn-btn btn btn-success col-6">Edit</button>
</template>

<script>
import vPopup from '../v-popup/v-popup.vue'

export default {
  name: "authorEditComponent",

  props:[
    'authors'
  ],

  data() {
    return {
      books: [],
      isPopupInviseble: false,

      //создание
      newBookId: [],
      id: '',
      last_nameEdit: '',
      middle_nameEdit: '',
      first_nameEdit: '',
    }
  },

  components: {
    vPopup,
  },

  methods: {

    getBooks() {
      axios.get('/api/book/')
          .then(res => {
            this.books = res.data.data
          })
    },

    updateAuthor(id) {
      axios.put(`/api/author/update/${id}`,
          {
            last_name: this.last_nameEdit,
            middle_name: this.middle_nameEdit,
            first_name: this.first_nameEdit,
            book_ids: this.newBookId,
          })
          .then(res => {
            console.log(res.data)
            this.$parent.getAuthors()
            this.ClosePopup()
          })},

    ClosePopup() {
      this.isPopupInviseble = false
    },

    EditShowPopup() {
      this.getBooks()
      this.isPopupInviseble = true
      this.id = this.authors.id
      this.last_nameEdit= this.authors.last_name
      this.middle_nameEdit= this.authors.middle_name
      this.first_nameEdit=this.authors.first_name


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