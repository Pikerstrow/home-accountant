<template>
    <div>
        <head-navigation></head-navigation>
        <sidebar-navigation></sidebar-navigation>
        <!-- Main Content -->
        <section id="main-content">
            <div class="content">
                <router-view></router-view>
            </div>
        </section>
        <!-- End of Main Content section -->
        <admin-footer></admin-footer>
    </div>
</template>

<script>
    import HeadNavigation from "./parts/HeadNavigation.vue";
    import SidebarNavigation from "./parts/SidebarNavigation.vue";
    import AdminFooter from "./parts/AdminFooter.vue";

    export default {
        components: {
            "head-navigation": HeadNavigation,
            "sidebar-navigation": SidebarNavigation,
            "admin-footer": AdminFooter
        },
        mounted(){
            this.$store.dispatch('getUserName');
        }
    }
</script>
