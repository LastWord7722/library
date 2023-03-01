<template>
  <create-component></create-component>
      <div class="btnFilter col-12 p-1 d-flex flex-row" >
        <button @click.prevent="AZbtnAction" class="btnFilter btn btn-secondary "> A->Z</button> <!--A-Z-->
        <button @click.prevent="ZAbtnAction" class="btnFilter btn btn-secondary "> Z->A</button> <!--Z-A-->
        <button @click.prevent="getBook" class="btnFilter btn btn-secondary ">Исходная</button> <!--Z-A-->
        <div class="input-search col-4 mt-1 d-flex flex-row">
          <input class="form-control me-2" type="search" v-model="searchBook" placeholder="Search" name="searchBook" id="searchBook"  aria-label="Search">
          <button class="btn btn-outline-success" @click.prevent="searchBooks()" type="submit">Search</button>
        </div>
      </div>
  <div class="row text-center">
    <h1 class="mt-3 main-text">Список книг</h1>

    <div >
      <Bootstrap4Pagination class="pagination-custom" :data="pagination" @pagination-change-page="getBook"></Bootstrap4Pagination>
    </div>
    <!--список книг-->
      <template ref="books" v-for="book in books">
        <div class="card-book card col-8">
          <img :src="'/public/storage/'+book.image" class="card-img-top" alt="пока нету">
          <div class="card-body">
            <h5 class="card-title fw-bolder fs-2">#{{book.id +' '+ book.title }}</h5>
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
<!--    paginate-->
    <div class="pagination-custom">
     <Bootstrap4Pagination  :data="pagination" @pagination-change-page="getBook"></Bootstrap4Pagination>
    </div>
  </div>
</template>

<script>
import createComponent from "../book/createComponent.vue";
import editComponent from "../book/editComponent.vue";
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

export default {
  name: "indexBookComponent",

  components: {
    createComponent,
    editComponent,
    Bootstrap4Pagination
  },

  data() {
    return {
      books: [],
      searchBook: [],
      pagination: {},
    }
  },

  mounted() {
    this.getBook()
  },

  methods: {
    getBook(page=1) {
      axios.get(`/api/book?page=`+page)
          .then(res => {
            this.books = res.data.data
            this.pagination = res.data
          })
    },


    searchBooks(){
      axios.get('/api/book/searchBook',
          {params: {search: this.searchBook}})
          .then(res => {
            this.books = res.data
          })
    },

    AZbtnAction(){
      axios.get('/api/book/getBook/AZ')
          .then(res => {
            this.books = res.data.data
          })
    },

    ZAbtnAction(){
      axios.get('/api/book/getBook/ZA')
          .then(res => {
            this.books = res.data.data
          })
    },

    deleteBook(id, title) {
      let destroy = confirm('Вы уверены что хотите удалить кингу ' + title + '\n Под номером #' + id)
      if (destroy) {
        axios.delete(`/api/book/delete/${id}`)
            .then(res => {
              this.getBook()
            })
      }
    },
  }
}
</script>

<style  scoped>
  .pagination-custo{
    margin-right: auto;
    margin-left: auto;
  }
  .input-search{
    min-height: 40px;
    margin-left:50%;
  }

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