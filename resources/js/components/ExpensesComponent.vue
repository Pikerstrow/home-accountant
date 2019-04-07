<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Витрати
            </h2>
            <hr>
            <div class="row">
               <div @click="toggleModal" class="col-12 text-left add-expense">
                  <span>+</span>
               </div>
            </div>
            <div class="row">
               <div class="col-12">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover table-expenses">
                        <thead>
                        <tr>
                           <th>№</th>
                           <th>Дата</th>
                           <th>Категорія</th>
                           <th>Сума, грн</th>
                           <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                           <td>1</td>
                           <td>02/04/2019</td>
                           <td>Медецина</td>
                           <td>63,80</td>
                           <td>
                              <!--<router-link :to="'/tasks/edit/' + task.id" tag="a" class="task-edit" title="Редагувати" active-class="active" exact>-->
                              <i title="Редагувати" class="edit-i fas fa-pencil-alt"></i>
                              <!--</router-link>-->

                              <a title="Видалити"><i class="delete-i fas fa-times"></i></a>
                           </td>
                        </tr>
                        <tr>
                           <td>2</td>
                           <td>02/04/2019</td>
                           <td>Продукти</td>
                           <td>251,62</td>
                           <td>
                              <!--<router-link :to="'/tasks/edit/' + task.id" tag="a" class="task-edit" title="Редагувати" active-class="active" exact>-->
                              <i class="edit-i fas fa-pencil-alt"></i>
                              <!--</router-link>-->
                              <a title="Видалити"><i class="delete-i fas fa-times"></i></a>
                           </td>
                        </tr>
                        <tr>
                           <td>3</td>
                           <td>02/04/2019</td>
                           <td>Автомобіль</td>
                           <td>200,00</td>
                           <td>

                              <!--<router-link :to="'/tasks/edit/' + task.id" tag="a" class="task-edit" title="Редагувати" active-class="active" exact>-->
                              <i class="edit-i fas fa-pencil-alt"></i>
                              <!--</router-link>-->

                              <a title="Видалити"><i class="delete-i fas fa-times"></i></a>
                           </td>
                        </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- modal -->
      <div ref="modalwrapper" id="modal-wrapper" class="modal justify-content-center align-items-center">
         <div class="animate col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5 add-expense-form-container">
            <h2 class="admin-welcome-h2 text-center">
               Додати витрати
            </h2>
            <hr>
            <div class="form-group">
               <label for="date">Дата</label>
               <date-piker id="date" v-model="date" :options="options"></date-piker>
            </div>
            <div class="form-group">
               <label for="category">Стаття</label>
               <select class="form-control" id="cost_item">
                  <option>Автомобіль</option>
                  <option>Ліки</option>
                  <option>Продукти</option>
                  <option>Комунальні</option>
                  <option>Інше</option>
               </select>
            </div>
            <div class="form-group">
               <label for="sum">Сума, грн</label>
               <input type="text" class="form-control" id="sum">
               <small><b>Увага!</b> Дробні числа необхідно вводити через крапку.</small>
            </div>
            <hr class="button-separator">
            <div class="form-group d-flex justify-content-between mt-4">
               <button class="col-4 btn btn-success">Додати</button>
               <button @click="toggleModal" class="col-4 btn btn-danger">Відмінити</button>
            </div>
         </div>


      </div>
   </div>
</template>

<script>
    import DatePiker from 'simple-date-piker-vue';

    export default {
        name: "ExpensesComponent",
        data() {
            return {
                date: '',
                cost_item: '',
                sum: '',
                options: {
                    locale: 'UK-ua',
                    dateFormat: 'dd/mm/YYYY',
                    useCurrentDate: true
                },
            }
        },
        methods: {
            toggleModal(){
                let modal = this.$refs.modalwrapper;
                if (modal.style.display == 'none' || ! modal.style.display) {
                    modal.style.display = 'flex'
                } else {
                    modal.style.display = 'none';
                }
            }
        },
        components: {
            'date-piker': DatePiker
        }
    }
</script>

<style scoped>
   #modal-wrapper {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.6)
   }

   .add-expense-form-container {
      background-color: white;
      padding: 25px 20px;
   }

   hr.button-separator {
      background-color: whitesmoke;
   }

   .add-expense span {
      background-color: #2c804e;
      color: #e8ebcc;
      cursor: pointer;
      font-size: 50px;
      margin-top: 15px;
      margin-bottom: 20px;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      -webkit-box-shadow: 1px 1px 31px -8px rgba(0, 0, 0, 1);
      -moz-box-shadow: 1px 1px 31px -8px rgba(0, 0, 0, 1);
      box-shadow: 1px 1px 31px -8px rgba(0, 0, 0, 1);
      transition-duration: .3s;
   }

   .add-expense span:hover {
      background-color: #246339;
      color: #ebe14f;
   }

   .table-expenses thead th, .table-expenses thead td {
      border-bottom: unset !important;
   }

   .table-expenses th, .table-expenses td {
      padding: 0.3rem;
   }

   .table-expenses thead {
      background-color: #dee2e659;
   }

   .edit-i {
      cursor: pointer;
      color: royalblue;
      margin: 4px;
   }

   .delete-i {
      cursor: pointer;
      color: darkred;
      margin: 4px;
   }

   .animate {
      animation: zoom .7s
   }

   @keyframes zoom {
      from {
         transform: scale(0)
      }
      to {
         transform: scale(1)
      }
   }
</style>