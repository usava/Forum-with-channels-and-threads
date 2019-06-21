<template>
    <button class="btn"
            :class="classes"
            v-text="textSubscribe"
            @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props: ['active'],
        data() {
            return {
                textSubscribe: 'Subscribe',
            }
        },
        computed: {
            classes() {
                return this.active ? 'btn-default' : 'btn-dark';
            }
        },
        methods: {
            subscribe() {
                let requestType = this.active ? 'delete' : 'post';
                axios[requestType](location.pathname + '/subscriptions');

                this.active = !this.active;
                this.textSubscribe = this.active ? 'Unsubscribe' : 'Subscribe'

                flash('Subscribed');
            }
        }
    }
</script>

<style scoped>

</style>
