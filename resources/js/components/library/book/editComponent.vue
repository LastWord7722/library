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
          <label class=" text-center fw-bolder fs-4"> Текущая  Обложка: </label>
          <img :src="'/public/storage/'+ book.image" class="card-img-top card-edit" alt="пока нету">
          <div class="card-body img-fluid">
            <input v-on:change="newInputFileChange" class="addFile btn btn-success" type="file" ref="file" >
            <button @click.prevent="uplodFile(this.id)" class="uplodeFile btn btn-success"> Добавить обложку </button>
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
            Выбранные автора сейчас:
            <template v-for="oldAuthor in AuthorIdOld">
              {{ oldAuthor.last_name + ' ' + oldAuthor.first_name + '  ' }}
            </template>
            <p class="text-center fw-bolder fs-4">Выберите автора!(Обязательное поле)</p>
            <template v-for="authorBook in authors">

              <input type="checkbox" class="btn-check" :id="authorBook.id" v-model="NewIdAuther" :value='authorBook.id'>

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
      NewIdAuther :[],
      authors : [],
      isPopupInvisebleEdit: false,
      id:'',
      titleEdit: '',
      infoEdit:'',
      file:'',

      AuthorIdOld: []
    }
  },

  methods: {
    getAuthor() {
      axios.get('/public/api/author/')
          .then(res => {
            this.authors = res.data.data
          })
    },

    newInputFileChange(){
      this.file = this.$refs.file.files[0];
    },

    uplodFile(id){
      let formData = new FormData();
      formData.append('image',this.file)

      axios.post(`/public/api/book/uplodeFile/${id}`,
          formData,
          {headers:{'Content-Type':'multipart/from-data'}})
      .then(res=>{
        this.$parent.getBook()
      })
    },

    updateBook(id) {
      axios.put(`/public/api/book/update/${id}`,
          {title: this.titleEdit, info: this.infoEdit, author_ids: this.NewIdAuther })
          .then(res => {
            this.$parent.getBook()
            this.ClosePopupEdit()
          })
    },

    ShowPopupEdit() {
      this.getAuthor()
      this.isPopupInvisebleEdit = true

      this.id = this.book.id
      this.titleEdit = this.book.title
      this.infoEdit = this.book.info
      this.AuthorIdOld = this.book.authors

    },

    ClosePopupEdit() {
      this.isPopupInvisebleEdit = false
      this.id = null
      this.title = null
      this.info = null

      this.AuthorIdOld = []
    },
  }
}
</script>

<style scoped>
.addFile{
  max-width: 350px;
  margin-right: 10px;
}
.card-edit{
  min-height: 100px;
  max-width: 190px;
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