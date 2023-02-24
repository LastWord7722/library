<template>
  <div class="row  text-center">
    <h1 class="mt-3 main-text">Список книг</h1>
  <template v-for="books in books" >

      <div class="card-book card col-3" >
        <img src="" class="card-img-top" alt="пока нету">
        <div class="card-body">
          <h5 class="card-title fw-bolder fs-2">{{books.title}}</h5>
          <p class="card-text">{{books.info}}</p>
          <p class="card-text fs-5">Авторы:</p>
          <div class="text-center fw-bolder mb-2 card-text">
            <template v-for="authors in books.authors" >
                  {{authors.last_name +' '+ authors.first_name +',  '}}
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
        this.books = res.data.data

      })
    },

    deleteBook(id, title){
      let destroy = confirm('Вы уверены что хотите удалить кингу '+title+ '\n Под номером #'+ id )
      if(destroy){
        axios.delete(`/public/api/book/delete/${id}`)
        .then(res => {
          this.getBook()
        })
        }
    },
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