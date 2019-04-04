<template>
   <div class="card">
      <div class="card-header" id="headingOne">
         <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" :data-target="'#ind' + index" aria-expanded="true" aria-controls="collapseOne">
               {{ item.title }}
            </button>
         </h5>
      </div>

      <div :id="'ind' + index" class="collapse" :class="{'show': index == 0}" aria-labelledby="headingOne" data-parent="#accordion">
         <div class="card-body">
            <ul>
               <li>1</li>
               <li>2</li>
               <li>3</li>
               <li>4</li>
            </ul>
         </div>
      </div>
   </div>
</template>

<script>
    export default {
        name: "AccordionCard",
        props: ['item', 'index'],
        data(){
            return {

            }
        },
        methods: {
            addElement(){

            }
        }
    }
</script>

<style scoped>

</style>