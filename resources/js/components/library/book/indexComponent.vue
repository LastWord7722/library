<template>


  <create-component></create-component>
  <div class="row text-center">
    <div class="btnFilter col-12 p-1  flex-column" >
    <button @click.prevent="AZbtnAction" class="btnFilter btn btn-secondary "> A->Z</button> <!--A-Z-->
    <button @click.prevent="ZAbtnAction" class="btnFilter btn btn-secondary "> Z->A</button> <!--Z-A-->
    <button @click.prevent="getBook" class="btnFilter btn btn-secondary ">Исходная</button> <!--Z-A-->

      <form class=" btnFilter d-flex col-4" role="search">
        <input class="form-control me-2" type="search" v-model="searchBook" placeholder="Search"  name="searchBook" id="searchBook"  aria-label="Search">

        <button class="btn btn-outline-success" @click.prevent="searchBooks()" type="submit">Search</button>
      </form>
  </div>


    <h1 class="mt-3 main-text">Список книг</h1>

    <!--список книг-->
      <template ref="books" v-for="book in books">
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
import createComponent from "../book/createComponent.vue";
import editComponent from "../book/editComponent.vue";



export default {
  name: "indexBookComponent",


  components: {
    createComponent,
    editComponent,
  },

  data() {
    return {
      books: [],
      searchBook: [],
    }
  },

  mounted() {
    this.getBook()
  },

  methods: {
    searchBooks(){
      axios.get('/public/api/book/searchBook',
          {params: {search: this.searchBook}})
          .then(res => {
            console.log(res.data)
            this.books = res.data
          })
    },

    AZbtnAction(){
      axios.get('/public/api/book/getBook/AZ')
          .then(res => {
            console.log(res.data)
            this.books = res.data
          })
    },

    ZAbtnAction(){
      axios.get('/public/api/book/getBook/ZA')
          .then(res => {
            console.log(res.data)
            this.books = res.data
          })
    },
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

  .btnFilter{
    text-align:left;

    margin-left:1%;
    margin-top:8px;
  }
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