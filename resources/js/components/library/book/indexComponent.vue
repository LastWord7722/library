<template>
  <div class="row  text-center">
    <h1 class="mt-3 main-text">Список книг</h1>
    <!--пропс-->
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
            <input type="file" name="image">
          </div>
        </div>
        <div class="flex-column">
          <div class="input-group  mt-3 w-100">
            <span class="input-group-text">Название книги</span>
            <input type="text" class="form-control">
          </div>
        </div>

        <div class="form-floating">
          <textarea class="form-control informs" placeholder="Leave a comment here"></textarea>
          <label >Кратакая информация</label>
        </div>
        <div class="row col-12">
          <div class="" aria-label="Basic checkbox toggle button group">
           <p class="text-center fw-bolder fs-4">Выберите автора!</p>
            <template v-for="authorBook in author">
              <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off">
              <label class="author btn btn-outline-primary" for="btncheck1">{{ authorBook.last_name + ' ' + authorBook.first_name + '  ' }}</label>
            </template>
          </div>

        </div>
      </slot>

    </v-popup>

      <button @click.prevent="ShowPopup" class="btn btn-success col-12">Добавить книгу</button>
<!--список книг-->
      <template v-for="books in books">

        <div class="card-book card col-8">
          <img src="" class="card-img-top" alt="пока нету">
          <div class="card-body">
            <h5 class="card-title fw-bolder fs-2">{{ books.title }}</h5>
            <p class="card-text">{{ books.info }}</p>
            <p class="card-text fs-5">Авторы:</p>
            <div class="text-center fw-bolder mb-2 card-text">
              <template v-for="author in books.author">
                {{ author.last_name + ' ' + author.first_name + ',  ' }}
              </template>
            </div>
            <div>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <button @click.prevent="deleteBook(books.id, books.title)" class="destroy btn btn-danger">Удалить</button>
            </div>
          </div>
        </div>

      </template>
  </div>
</template>


<script>
import vPopup from '../v-popup/v-popup.vue'

export default {

  name: "indexBookComponent",
  components: {
    vPopup
  },


  data() {
    return {
      books: [],
      author: [],
      isPopupInviseble: false,
      isAuthor:[],


    }
  },

  mounted() {

    this.getBook()
  },

  methods: {
    getBook() {
      axios.get('/public/api/book/')
          .then(res => {
            this.books = res.data.data

          })
    },

    getAuthor() {
      axios.get('/public/api/author/')
          .then(res => {
            this.author = res.data.data
          })
    },

    createBook() {
      console.log('123')
    },

    deleteBook(id, title) {
      let destroy = confirm('Вы уверены что хотите удалить кингу ' + title + '\n Под номером #' + id)
      if (destroy) {
        axios.delete(`/public/api/book/delete/${id}`)
            .then(res => {
              this.getBook()
            })
      }
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

<style  scoped>
  .btn:hover {
    box-shadow: inset 0 0 0 5px;
  }

  .card-book {
    margin-left: 5%;
    margin-right: auto;
    margin-top: 2%;
    width: 40%;
  }

  .destroy {
    margin-left: 5%;
  }

  .main-text:hover {
    color: purple;
  }

  .informs{
    height: 150px;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  .author{
    flex-wrap: wrap;
  }

</style>