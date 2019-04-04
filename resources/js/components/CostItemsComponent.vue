<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Статті витрат
            </h2>
            <hr>
            <div class="row d-flex justify-content-center">
               <div class="col-12 col-md-8 col-xl-6">
                  <div class="row">
                     <div title="Додати статтю витрат" @click="toggleModal" class="col-12 text-left add-cost-item">
                        <span>+</span>
                     </div>
                  </div>
                  <!--<ul class="list-group cost-items-ul">-->
                  <!--<li v-for="(item, index) in costItems" :key="index"-->
                  <!--class="list-group-item d-flex justify-content-between align-items-center">-->
                  <!--{{ item.title }}-->
                  <!--<div class="actions">-->
                  <!--<i class="edit-i fas fa-pencil-alt"></i>-->
                  <!--<a title="Видалити"><i class="delete-i fas fa-times"></i></a>-->
                  <!--</div>-->
                  <!--</li>-->
                  <!--</ul>-->

                  <div id="accordion">
                     <accordion-card v-for="(item, index) in costItems" :key="index" :item="item" :index="index"></accordion-card>
                     <!--<div class="card">-->
                     <!--<div class="card-header" id="headingOne">-->
                     <!--<h5 class="mb-0">-->
                     <!--<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">-->
                     <!--Collapsible Group Item #1-->
                     <!--</button>-->
                     <!--</h5>-->
                     <!--</div>-->

                     <!--<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">-->
                     <!--<div class="card-body">-->
                     <!--Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.-->
                     <!--</div>-->
                     <!--</div>-->
                     <!--</div>                     -->

                  </div>


               </div>
            </div>
         </div>
      </div>


      <!-- modal -->
      <div ref="modalwrapper" id="modal-wrapper" class="modal justify-content-center align-items-center">
         <div class="animate col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3 add-cost-item-form-container">
            <h2 class="admin-welcome-h2 text-center">
               Додати статтю витрат
            </h2>
            <hr>
            <div class="form-group mb-3 mt-3">
               <input v-model="title" @focus="errors.title ? errors.title = '' : ''" type="text" id="title" name="title"
                      :class="{'is-invalid': errors.title}" class="form-control"
                      placeholder="Назва статті витрат">
               <div v-if="errors.title" class="invalid-feedback">{{ errors.title }}</div>
               <small><b>Увага!</b> Приймаються лише значення введені кирилицею.</small>
            </div>
            <hr class="button-separator">
            <div class="form-group d-flex justify-content-between mt-4">
               <button ref="addCostItemButton" @click="addCostItem" class="col-4 btn btn-success add-cost-item-but">
                  Додати
               </button>
               <button @click="toggleModal" class="col-4 btn btn-danger">Відмінити</button>
            </div>
            <!-- preloader -->
            <div ref="preloader" class="preloader-container justify-content-center align-items-center">
               <img src="../../images/preloader.gif">
            </div>
         </div>
      </div>

   </div>
</template>

<script>
    import AccordionCard from './parts/AccordionCard';

    export default {
        data() {
            return {
                title: '',
                errors: {}
            }
        },
        computed: {
            costItems() {
                return this.$store.getters.costItems;
            }
        },
        methods: {
            toggleModal() {
                let modal = this.$refs.modalwrapper;
                if (modal.style.display == 'none' || !modal.style.display) {
                    modal.style.display = 'flex'
                } else {
                    modal.style.display = 'none';
                }
            },
            addCostItem() {
                this.$refs.addCostItemButton.setAttribute('disabled', true);
                this.$refs.preloader.style.display = 'flex';

                axios.post(
                    '/add-cost-item',
                    {'title': this.title}
                ).then(response => {

                    setTimeout(() => {
                        this.$store.commit('addCostItem', response.data.costItem);
                        this.resetData();

                        this.$refs.addCostItemButton.removeAttribute('disabled');
                        this.$refs.preloader.style.display = 'none';
                    }, 500);

                    /*notification with toastr*/
                    //toastr.success(response.data.message);

                }).catch(error => {

                    setTimeout(() => {
                        if (error.response.data.errors.title) {
                            this.$set(this.errors, 'title', error.response.data.errors.title[0]);
                        }
                        this.$refs.addCostItemButton.removeAttribute('disabled');
                        this.$refs.preloader.style.display = 'none';
                    }, 500);
                });
            },
            resetData() {
                this.title = '';
                this.errors = {}
            }
        },
        components: {
            'accordion-card': AccordionCard
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

   .preloader-container {
      display: none;
      position: absolute;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(255, 255, 255, 0.6)
   }

   .add-cost-item-form-container {
      background-color: white;
      padding: 25px 20px;
      position: relative;
   }

   .add-cost-item-form-container .input-group-text {
      background-color: #2c804e;
      color: white;
      padding: 0.20rem 0.75rem;
      cursor: pointer;
      border: 1px solid #ced4da;
      line-height: 1.6;
   }

   hr.button-separator {
      background-color: whitesmoke;
   }

   .add-cost-item span {
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

   .add-cost-item span:hover {
      background-color: #246339;
      color: #ebe14f;
   }

   .add-cost-item-but:disabled {
      cursor: not-allowed;
   }

   .cost-items-ul {
      font-size: 18px;
      font-family: 'Poiret One', cursive;
      font-weight: bold;
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