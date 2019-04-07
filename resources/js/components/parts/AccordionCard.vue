<template>
   <div class="card">
      <div class="card-header" id="headingOne">
         <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" :data-target="'#ind' + index" aria-expanded="true"
                    aria-controls="collapseOne">
               {{ direction.title }}
            </button>
         </h5>
      </div>

      <div :id="'ind' + index" class="collapse" :class="{'show': index == 0}" aria-labelledby="headingOne"
           data-parent="#accordion">
         <div class="card-body">

            <div v-if="direction.has_cost_items">
               <div v-if="directionCostItems.length > 0" class="row">
                  <div class="col-12 col-md-8 col-lg-6">
                     <h6 class="text-left">Елементи витрат</h6>
                     <ul class="list-group">
                        <li class="add-cost-item-li list-group-item d-flex justify-content-between align-items-center">

                           <div v-if="isInputActive" class="input-group">
                              <input ref="addCostItemInput" type="text" v-model="title" class="form-control">
                              <div class="input-group-append">
                                 <button ref="addCostItemBtn" @click="addCostItem" class="input-group-text">+</button>
                              </div>
                           </div>
                           <span v-else @click="isInputActive = true">+ додати елемент</span>
                        </li>
                        <li v-for="(costItem, ind) in directionCostItems"
                            class="list-group-item d-flex justify-content-between align-items-center">
                           {{ costItem.title }}
                           <div>
                              <i class="edit-i fas fa-pencil-alt"></i>
                              <a title="Видалити"><i class="delete-i fas fa-times"></i></a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
               <div v-else class="row d-flex align-items-center">
                  <div class="col-12 col-md-8 col-lg-6 no-cost-directions text-left">
                     <div v-if="isInputActive" class="input-group">
                        <input ref="addCostItemInput" type="text" v-model="title" class="form-control">
                        <div class="input-group-append">
                           <button ref="addCostItemBtn" @click="addCostItem" class="input-group-text">+</button>
                        </div>
                     </div>
                     <span v-else><i class="fas fa-info-circle fa-lg"></i> Елементи витрат не додані.
                     <span @click="isInputActive = true" class="add-cost-item-span">Додати?</span>
                  </span>
                  </div>
               </div>
            </div>

            <div v-else>
               <div class="row no-cost-items-container">
                  <div class="col-12">
                     <p>Для цієї статті елементи не передбачені! <span @click="changeCostItemsAbility" class="add-cost-item-span">Передбачити?</span></p>
                  </div>
               </div>
            </div>

         </div>
      </div>

   </div>
</template>

<script>
    export default {
        name: "AccordionCard",
        props: ['direction', 'index'],
        data() {
            return {
                title: '',
                errors: {},
                isInputActive: false
            }
        },
        computed: {
            directionCostItems() {
                let directionCostItems = this.direction.cost_items;
                if (directionCostItems && directionCostItems.length > 0) {
                    return directionCostItems;
                }
                return [];
            }
        },
        methods: {
            addCostItem() {
                this.$refs.addCostItemBtn.setAttribute('disabled', true);
                this.$refs.addCostItemInput.setAttribute('disabled', true);

                axios.post(
                    '/add-cost-item',
                    {'title': this.title, 'cost_direction_id': this.direction.id}
                ).then(response => {
                    setTimeout(() => {
                        this.directionCostItems.push(response.data.costItem);
                        this.resetData();
                        this.$refs.addCostItemBtn.removeAttribute('disabled');
                        this.$refs.addCostItemInput.removeAttribute('disabled');
                        this.isInputActive = false;
                    }, 500);

                    /*notification with toastr*/

                }).catch(error => {

                    setTimeout(() => {
                        if (error.response.data.errors.title) {
                            this.$set(this.errors, 'title', error.response.data.errors.title[0]);
                        }
                        this.$refs.addCostItemBtn.removeAttribute('disabled');
                        this.$refs.addCostItemInput.removeAttribute('disabled');
                    }, 500);
                });
            },
            resetData() {
                this.title = '';
                this.errors = {}
            },
            changeCostItemsAbility(){
                axios.post('/update-has-cost-items-property',
                    {'has_cost_items': true, 'id': this.direction.id }
                ).then(
                    response => {
                        if(response.data.updated && response.data.updated == true){
                           this.direction.has_cost_items = 1;
                        }
                    }
                ).catch(error => {
                    console.log(error)
                });
            }
        }
    }
</script>

<style scoped>
   .add-cost-item-span {
      color: royalblue;
      cursor: pointer;
   }

   .input-group-text:disabled {
      cursor: not-allowed;
   }

   .add-cost-item-li {
      cursor: pointer;
   }

   .card {
      border-radius: unset !important;
   }

   .card-header {
      padding: 0.1rem 0.5rem;
   }

   .card-header h5 {
      font-family: 'Poiret One', cursive;
      font-weight: bold;
   }

   .card-header .btn-link, .card-header .btn {
      text-decoration: none;
      color: black;
      cursor: pointer;
      font-size: 18px;
      font-weight: bold;
      width: 100%;
      text-align: left;
   }

   .card-body {
      position: relative;
   }

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

   .add-cost-item {
      position: absolute;
      bottom: 10px;
      right: 10px;
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

   .no-cost-items-container p {
      margin-bottom: 0;
   }
</style>