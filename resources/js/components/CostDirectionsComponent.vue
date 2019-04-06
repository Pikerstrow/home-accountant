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
                     <div title="Додати статтю витрат" @click="toggleModal" class="col-12 text-left add-cost-direction">
                        <span>+</span>
                     </div>
                  </div>
                  <div id="accordion">
                     <accordion-card v-for="(direction, index) in costDirections" :key="index" :direction="direction" :index="index"></accordion-card>
                  </div>
               </div>
            </div>
         </div>
      </div>


      <!-- modal -->
      <div ref="modalwrapper" id="modal-wrapper" class="modal justify-content-center align-items-center">
         <div class="animate col-12 col-sm-8 col-md-6 col-lg-4 col-xl-3 add-cost-direction-form-container">
            <h2 class="admin-welcome-h2 text-center">
               Додати статтю витрат
            </h2>
            <hr>
            <div class="form-group mb-3 mt-3">
               <input v-model="title" @focus="errors.title ? errors.title = '' : ''" type="text" id="title" name="title"
                      :class="{'is-invalid': errors.title}" class="form-control"
                      placeholder="Назва напрямку витрат">
               <div v-if="errors.title" class="invalid-feedback">{{ errors.title }}</div>
               <small><b>Увага!</b> Приймаються лише значення введені кирилицею.</small>
            </div>
            <hr class="button-separator">
            <div class="form-group d-flex justify-content-between mt-4">
               <button ref="addCostDirectionButton" @click="addCostDirection" class="col-4 btn btn-success add-cost-item-but">
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
            costDirections() {
                return this.$store.getters.costDirections;
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
            addCostDirection() {
                this.$refs.addCostDirectionButton.setAttribute('disabled', true);
                this.$refs.preloader.style.display = 'flex';

                axios.post(
                    '/add-cost-direction',
                    {'title': this.title}
                ).then(response => {

                    setTimeout(() => {
                        this.$store.commit('addCostDirection', response.data.costDirection);
                        this.resetData();

                        this.$refs.addCostDirectionButton.removeAttribute('disabled');
                        this.$refs.preloader.style.display = 'none';
                        this.toggleModal();
                    }, 500);

                    /*notification with toastr*/

                }).catch(error => {

                    setTimeout(() => {
                        if (error.response.data.errors.title) {
                            this.$set(this.errors, 'title', error.response.data.errors.title[0]);
                        }
                        this.$refs.addCostDirectionButton.removeAttribute('disabled');
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

   .add-cost-direction-form-container {
      background-color: white;
      padding: 25px 20px;
      position: relative;
   }

   .add-cost-direction-form-container .input-group-text {
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

   .add-cost-direction span {
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

   .add-cost-direction span:hover {
      background-color: #246339;
      color: #ebe14f;
   }

   .add-cost-direction-but:disabled {
      cursor: not-allowed;
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