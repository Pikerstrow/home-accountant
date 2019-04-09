<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Витрати {{ (this.$route.query.year && this.$route.query.month && this.$route.query.date) ? concreteDate :
               currentDate}}
            </h2>
            <hr>
            <div class="row d-flex justify-content-center">
               <div @click="toggleModal" class="col-12 col-sm-10 col-md-8 col-lg-6 text-left add-expense">
                  <span>+</span>
               </div>
            </div>
            <div class="row d-flex justify-content-center">
               <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                  <div class="table-responsive">
                     <table class="table table-bordered table-hover table-expenses">
                        <thead>
                        <tr>
                           <th>№</th>
                           <th>Стаття</th>
                           <th>Елемент</th>
                           <th>Сума, грн</th>
                           <th>Дії</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(expense, index) in currentDayExpenses" :key="index">
                           <td>{{ index + 1 }}</td>
                           <td>{{ expense.cost_direction.title }}</td>
                           <td>{{ expense.cost_item.title }}</td>
                           <td>{{ expense.sum }}</td>
                           <td>
                              <!--<router-link :to="'/tasks/edit/' + task.id" tag="a" class="task-edit" title="Редагувати" active-class="active" exact>-->
                              <i title="Редагувати" class="edit-i fas fa-pencil-alt"></i>
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
               <select @input="enableCostItemsSelect" v-model="cost_direction" class="form-control"
                       id="cost_direction">
                  <option selected disabled value="">Виберіть статтю витрат</option>
                  <option v-for="(direction, index) in expensesDirections"
                          :key="index"
                          :value="direction.id"
                  >{{ direction.title }}
                  </option>
               </select>
            </div>
            <div class="form-group">
               <label for="category">Елемент</label>
               <select ref="costItem" v-model="cost_item" class="form-control" id="cost_item" disabled>
                  <option selected disabled value="">Виберіть елемент витрат</option>
                  <option v-for="(item, index) in costItemsFiltered"
                          :key="index"
                          :value="item.id"
                  >{{ item.title }}
                  </option>
               </select>
            </div>
            <div class="form-group">
               <label for="sum">Сума, грн</label>
               <input v-model="sum" type="text" class="form-control" id="sum">
               <small><b>Увага!</b> Дробні числа необхідно вводити через крапку.</small>
            </div>
            <hr class="button-separator">
            <div class="form-group d-flex justify-content-between mt-4">
               <button @click="addExpense" class="col-4 btn btn-success">Додати</button>
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
                cost_direction: '',
                cost_item: '',
                sum: '',
                options: {
                    locale: 'UK-ua',
                    dateFormat: 'dd/mm/YYYY',
                    useCurrentDate: true
                },
                costItemsFiltered: {}
            }
        },
        watch: {
            cost_direction(val) {
                let costItems = {};
                this.expensesDirections.filter((elem) => {
                    if (elem.id == val) {
                        costItems.items = elem.cost_items;
                    }
                });
                // Перевірка на дефолтне значення імені елементів витрат
                for (let i = 0; i < costItems.items.length; i++) {
                    if (costItems.items[i].title == '-') {
                        costItems.items.splice(i, 1);
                    }
                }
                this.costItemsFiltered = costItems.items;
            }
        },
        computed: {
            currentDayExpenses() {
                return this.$store.getters.currentDaysExpenses;
            },
            expensesDirections() {
                return this.$store.getters.costDirections;
            },
            currentDate() {
                let today = new Date();
                let options = {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit',
                    timezone: 'UTC+2'
                };
                return today.toLocaleString("UK-ua", options);
            },
            concreteDate() {
                let year = this.$route.query.year ? this.$route.query.year : '';
                let month = this.$route.query.month ? this.$route.query.month : '';
                let date = this.$route.query.date ? this.$route.query.date : '';

                let concreteDate = new Date(year, month, date);

                let options = {
                    year: 'numeric',
                    month: 'long',
                    day: '2-digit',
                    timezone: 'UTC+2'
                };
                return concreteDate.toLocaleString("UK-ua", options);
            }
        },
        methods: {
            addExpense() {
                console.log(this.date + " | " + this.cost_direction + " | " + this.cost_item + " | " + this.sum)
            },
            enableCostItemsSelect() {
                if (this.$refs.costItem.hasAttribute('disabled')) {
                    this.$refs.costItem.removeAttribute('disabled');
                }
            },
            toggleModal() {
                let modal = this.$refs.modalwrapper;
                if (modal.style.display == 'none' || !modal.style.display) {
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