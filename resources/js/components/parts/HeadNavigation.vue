<template>
   <div>
      <!-- Header Nav -->
      <header class="header">
         <nav class="top-nav">
            <div class="nav-links-container">
               <div class="admin_panel_title">
                  <router-link to="/" tag="a" active-class="active" exact>
                     <span>Accountant</span>
                  </router-link>
               </div>
            </div>

            <div class="nav-profile-container">
               <router-link to="/expenses" tag="a" active-class="active" exact>
                  <i class="fas fa-dollar-sign"></i> <span class="nav-a-text"> Витрати</span>
               </router-link>

               <router-link to="/calendar" tag="a" active-class="active" exact>
                  <i class="far fa-calendar-alt"></i> <span class="nav-a-text"> Календар</span>
               </router-link>

               <div class="logout-container">
                  <a @click="logout()" class="logout" onclick="event.preventDefault()"><i class="fas fa-power-off"></i></a>
                  <form id="logout-form" action="/logout" method="POST" style="display: none;">
                     <input type="hidden" name="_token" id="csrf-token" :value="csrf_token">
                  </form>
               </div>
            </div>
         </nav>
      </header>
      <!-- End of header -->
   </div>
</template>

<script>
    export default {
        computed: {
            username(){
                return this.$store.getters.username
            },
            csrf_token(){
                return document.querySelector("meta[name='csrf-token']").getAttribute("content")
            }
        },
        methods: {
            logout(){
               let form = document.getElementById("logout-form");
               form.submit();
            }
        }
    }
</script>

<style scoped>
   .nav-profile-container span, .admin_panel_title span {
      margin-left: 5px;
   }
   .top-nav, .nav-links-container, .nav-profile-container, .logout-container{
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-content: center;
   }
   .header {
      min-height: 50px;
      width: 100%;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 99;
      background-color: #3b3b39;
      color: #e8ebcc;
      padding: 10px 20px;
   }
   .nav-links-container a, .nav-profile-container a {
      color: #e8ebcc;
      padding: 5px 20px;
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      height: 45px;
   }
   .nav-links-container a.active, .nav-profile-container a.active, .nav-links-container a.active span{
      color: yellow;
   }
   .nav-links-container a:hover, .nav-profile-container a:hover {
      text-decoration: none;
   }
   .admin_panel_title, .nav-links-container a, .nav-profile-container a {
      font-family: 'Rancho', cursive;
      letter-spacing: 1px;
      font-size: 23px;
   }
   .admin_panel_title a{
      padding-left: 0px;
      height: 45px;
   }
   a.logout {
      padding-right: 0;
      cursor: pointer;
   }
   .nav-a-text {
      font-size: 17px;
   }
   .admin_panel_title span {
      color: #e8ebcc;
      padding-bottom: 3px;
   }

   i {
      font-size: 19px;
   }
</style>