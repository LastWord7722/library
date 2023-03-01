<template>
  <div>
    <create-component></create-component>
    <div class="btnFilter col-12 p-1 d-flex flex-row" >
      <button @click.prevent="AZbtnAction" class="btnFilter btn btn-secondary "> A->Z</button> <!--A-Z-->
      <button @click.prevent="ZAbtnAction" class="btnFilter btn btn-secondary "> Z->A</button> <!--Z-A-->
      <button @click.prevent="getAuthors()" class="btnFilter btn btn-secondary ">Исходная</button> <!--Z-A-->

      <div class="serach input-search col-4 mt-1 d-flex flex-row">
        <input class="form-control me-2" type="search" v-model="searchBook" placeholder="Search" name="searchBook" id="searchBook"  aria-label="Search">
        <button class="btn btn-outline-success" @click.prevent="searchAuthor()" type="submit">Search</button>
      </div>
    </div>
    <table class="table">
      <thead >
      <tr>
        <th scope="col">#</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Книги</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="author in authors">
      <tr>
        <th scope="row">{{ author.id }}</th>
        <td>{{ author.first_name }}</td>
        <td>{{ author.last_name }}</td>
        <td>
        <template class="row" v-for="book in author.books">
          {{'#'+book.id + ';  '+ book.title}}
        </template>
        </td>
        <td>
          <edit-component :authors="author" :ref="`edit_${author.id}`"></edit-component>
        </td>
        <td>
          <button class="btn btn-danger" @click.prevent="deleteaAuthor(author.id, author.first_name)"> Удалить </button>
        </td>
      </tr>
      </template>
      </tbody>
    </table>
  </div>
  <Bootstrap4Pagination  :data="pagination" @pagination-change-page="getAuthors"></Bootstrap4Pagination>
</template>

<script>
import createComponent from "../author/createComponent.vue";
import editComponent from "../author/editComponent.vue";
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

export default {
  name: "AuthorIndexComponent",

  components:{
    editComponent,
    createComponent,
    Bootstrap4Pagination
  },

  data() {
    return {
      searchBook:'',
      authors: [],
      pagination:{}

    }
  },

  mounted() {
    this.getAuthors()
  },

  methods:{
    getAuthors(page = 1) {
      axios.get('/public/api/author/?page='+page)
          .then(res => {
            this.authors = res.data.data
            this.pagination = res.data
          })
    },
    deleteaAuthor(id, first_name) {
      let destroy = confirm('Вы уверены что хотите удалить кингу ' + first_name + '\n Под номером #' + id)
      if (destroy) {
        axios.delete(`/public/api/author/delete/${id}`)
            .then(res => {
              this.getAuthors()
            })
      }
    },

    searchAuthor(){
      axios.get('/public/api/author/searchAuthor',
          {params: {search: this.searchBook}})
          .then(res => {
            this.authors = res.data
          })
    },

    AZbtnAction(){
      axios.get('/public/api/author/getAuthor/AZ')
          .then(res => {
            console.log(res.data.data)
            this.authors = res.data.data
          })
    },

    ZAbtnAction(){
      axios.get('/public/api/author/getAuthor/ZA')
          .then(res => {
            this.authors = res.data.data
          })
    },
  }
}

</script>

<style scoped>
.btnFilter{
  text-align:left;

  margin-left:1%;
  margin-top:8px;
}

.serach{
  margin-left: 50%;
}
</style>