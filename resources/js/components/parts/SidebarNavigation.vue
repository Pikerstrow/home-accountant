<template>
   <div>
      <aside>
         <div id="sidebar-nav">
            <ul class="sidebar-menu">
               <router-link to="/" tag="li" active-class="active" exact>
                  <a><span class="i-wrap"><i class="fas fa-tachometer-alt"></i></span>
                     <span class="nav-a-text">Звітність</span>
                  </a>
               </router-link>

               <router-link to="/expenses" tag="li" active-class="active" exact>
                  <a><span class="i-wrap"><i class="fas fa-dollar-sign"></i></span>
                     <span class="nav-a-text">Витрати</span>
                  </a>
               </router-link>

               <router-link to="/calendar" tag="li" active-class="active" exact>
                  <a><span class="i-wrap"><i class="far fa-calendar-alt"></i></span>
                     <span class="nav-a-text">Календар</span>
                  </a>
               </router-link>
            </ul>
         </div>
      </aside>
   </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>
   #sidebar-nav {
      width: 200px;
      height: calc(100% - 54px);
      position: fixed;
      left: 0px;
      top: 56px;
      background-color: #51524d;
      margin-left: 0px;
      transition-duration: .2s;
      overflow: hidden;
      opacity: 1;
      z-index: 999;
   }
   ul.sidebar-menu>li>a {
      color: #e8ebcc;
      text-decoration: none;
      display: block;
      padding: 15px 0 15px 10px !important;
      font-size: 15.5px;
      font-family: 'Roboto', sans-serif;
      letter-spacing: .8px;
      outline: none;
      -webkit-transition: 0.4s;
      -moz-transition: 0.4s;
      -o-transition: 0.4s;
      -ms-transition: 0.4s;
      transition: 0.4s;
      border-bottom: 1px solid #e8ebcc;
   }
   ul.sidebar-menu>li>a:hover {
      background-color: #73746f;
   }
   ul.sidebar-menu span.i-wrap {
      display: inline-block;
      width: 18px;
   }
   li.router-link-exact-active a {
      background-color: #73746f;
   }
</style>