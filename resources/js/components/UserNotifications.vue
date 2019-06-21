<template>
    <li class="nav-item dropdown" v-if="notifications">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fas fa-bell"></i>
        </a>

        <ul class="dropdown-menu dropdown-menu-right">
            <li v-for="notification in notifications">
                <a class="dropdown-item"
                   :href="notification.data.link"
                   @click="markAsRead(notification)"
                   v-text="notification.data.message"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        data() {
            return {
                notifications: false
            }
        },

        created() {
            axios.get(this.url())
                .then(response => this.notifications = response.data);
        },

        methods: {
            markAsRead(notification) {
                axios.delete(this.url() + notification.id)
            },
            url() {
                return '/profiles/' + window.App.user.name + '/notifications/' ;
            }
        }
    }
</script>

<style scoped>

</style>
