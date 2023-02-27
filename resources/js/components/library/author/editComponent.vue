<template>
  <div>
      <button @click.prevent="ShowPopupEdit" class="mb-1 btn btn-success">Редактировать</button>

    <v-popup v-if="isPopupInvisebleEdit"
             @rightBtnAction="updateBook(this.id)"
             @leftBtnAction="ClosePopupEdit"
             rightBtn = 'Обновить'
             nameTitle = 'Изменить книгу:'>
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
            <span class="input-group-text">Название книги</span>
            <input type="text"  v-model="titleEdit" class="form-control">
          </div>
        </div>

        <div class="form-floating">
          <textarea class="form-control informs" v-model="infoEdit" placeholder="Leave a comment here"></textarea>
          <label >Кратакая информация</label>
        </div>
        <!--вывод автора-->
        <div class="row col-12">
          <div class="" aria-label="Basic checkbox toggle button group">
            <p class="text-center fw-bolder fs-4">Выберите автора!</p>
            <template v-for="authorBook in authors">

              <input type="checkbox" class="btn-check" :id="authorBook.id" v-model="AuthorId" :value='authorBook.id'>

              <label class="author btn btn-outline-primary" :for="authorBook.id">
                {{ authorBook.last_name + ' ' + authorBook.first_name + '  ' }}
              </label>

            </template>
          </div>

        </div>
      </slot>

    </v-popup>
  </div>
</template>

<script>
import vPopup from '../v-popup/v-popup.vue'
export default {
  name: "editComponent",

  props:[
    'book'
  ],
  components:{
    vPopup
  },

  data() {
    return {  
      authors : [],
      isPopupInvisebleEdit: false,
      id:'',
      titleEdit: '',
      infoEdit:'',
      file:'',
      AuthorId: []
    }
  },

  mounted() {

  },

  methods: {

    getAuthor() {
      axios.get('/public/api/author/')
          .then(res => {
            this.authors = res.data.data
          })
    },

    inputFileChange(){
      this.file = this.$refs.file.files[0];
    },

    updateBook(id) {
      console.log( this.titleEdit + ' ' + this.infoEdit)
      axios.put(`/public/api/book/update/${id}`, {title: this.titleEdit, info: this.infoEdit })
          .then(res => {
            console.log(res)
            /*this.ClosePopupEdit()*/
          })
    },

    ShowPopupEdit() {
      this.getAuthor()
      this.isPopupInvisebleEdit = true
      this.id = this.book.id
      this.titleEdit = this.book.title
      this.infoEdit = this.book.info
      this.file = this.book.image
      this.AuthorId = this.book.authors

    },

    ClosePopupEdit() {
      this.isPopupInvisebleEdit = false
    /*  this.id = null
      this.title = null
      this.info = null
      this.file = null
      this.AuthorId = []*/

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