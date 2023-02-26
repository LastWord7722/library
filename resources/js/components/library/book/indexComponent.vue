<template>
  <div class="row  text-center">
    <h1 class="mt-3 main-text">Список книг</h1>
    <!--пропс-->
   <create-component></create-component>
    <!--список книг-->
      <template v-for="book in books">

        <div class="card-book card col-8">
          <img :src="'/public/storage/'+book.image" class="card-img-top" alt="пока нету">
          <div class="card-body">
            <h5 class="card-title fw-bolder fs-2">{{ book.title }}</h5>
            <p class="card-text">{{ book.info }}</p>
            <p class="card-text fs-5">Авторы:</p>
            <div class="text-center fw-bolder mb-2 card-text">
              <template v-for="author in book.authors">
                {{ author.last_name + ' ' + author.first_name + ',  ' }}
              </template>
            </div>
            <div>
              <edit-component :book="book" :ref="`edit_${book.id}`"></edit-component>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <button @click.prevent="deleteBook(book.id, book.title)" class="destroy btn btn-danger">Удалить</button>
            </div>
          </div>
        </div>

      </template>
  </div>
</template>


<script>

import createComponent from "../author/createComponent.vue";
import editComponent from "../author/editComponent.vue";

export default {

  name: "indexBookComponent",
  components: {
    createComponent,
    editComponent,
  },

  data() {
    return {
      books: [],
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

    deleteBook(id, title) {
      let destroy = confirm('Вы уверены что хотите удалить кингу ' + title + '\n Под номером #' + id)
      if (destroy) {
        axios.delete(`/public/api/book/delete/${id}`)
            .then(res => {
              this.getBook()
            })
      }
    },

  }
}
</script>

<style  scoped>
  .btn:hover {
    box-shadow: inset 0 0 0 5px;
  ;
  }

  .card-book {
    margin-left: 5%;
    margin-right: auto;
    margin-top: 2%;
    width: 40%;
    min-height: 150px;
    max-width: 400px;

  }

  .destroy {
    margin-left: 5%;
  }

  .main-text:hover {
    color: purple;
  }



</style>