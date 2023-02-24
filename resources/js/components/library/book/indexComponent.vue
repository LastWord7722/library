<template>
  <div class="row  text-center">
    <h1 class="mt-3 main-text">Список книг</h1>
  <template v-for="books in books" >

      <div class="card-book card col-3" >
        <img src="" class="card-img-top" alt="пока нету">
        <div class="card-body">
          <h5 class="card-title ">{{books.title}}</h5>
          <p class="card-text">{{books.info}}</p>
          <p class="card-text">Авторы:</p>
          <a href="#" class="btn btn-primary">Подробнее</a>
          <a href="#" class="destroy btn btn-danger">Удалить</a>
        </div>
      </div>

    </template>
  </div>
</template>


<script>
export default {
  name: "indexBookComponent",

  data(){
    return{
      books : ''
    }
  },

  mounted(){
    this.getBook()
  },

  methods:{
    getBook(){
      axios.get('/public/api/book/')
      .then(res => {
        this.books = res.data
      })
    }
  }
}
</script>

<style scoped>
  .btn:hover{
    box-shadow: inset 0 0 0 5px ;
  }

  .card-book{
    margin-left: 5%;
    margin-right: auto;
    margin-top: 2%;
    width: 40%;
  }
  .destroy{
    margin-left: 5%;
  }
  .main-text:hover{
    color:purple;
  }
</style>