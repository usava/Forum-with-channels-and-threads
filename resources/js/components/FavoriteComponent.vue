<template>
    <button class="btn btn-default" :class="classes" @click="toggle">
        <i class="fas fa-heart" aria-hidden="true"></i>
        <span v-text="count"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                count: this.reply.favoritesCount,
                active: this.reply.isFavorited
            }
        },

        computed: {
            classes() {
                return ['btn', this.active ? 'btn-primary' : 'btn-default']
            },
            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle () {
                this.active ? this.unfavorite() : this.favorite();
            },

            favorite() {
                axios.post( this.endpoint );
                this.active = true;
                this.count++;
            },
            unfavorite() {
                axios.delete( this.endpoint );
                this.active = false;
                this.count--;
            }

        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
