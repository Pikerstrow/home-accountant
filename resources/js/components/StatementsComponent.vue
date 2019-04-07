<template>
   <div>
      <div class="row">
         <div class="col-12">
            <h2 class="admin-welcome-h2 text-center">
               Звіт
            </h2>
            <hr>
            <div class="row d-flex justify-content-center">
               <div class="col-6 mt-5 text-center">
                  <!--<switcher></switcher>-->
               </div>
            </div>
         </div>
      </div>

   </div>
</template>

<script>
   import Switcher from './parts/Switcher';

    export default {
        name: "StatementsComponent",
        components: {
            'switcher': Switcher
        }
    }
</script>

<style scoped>

</style>