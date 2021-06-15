<template>
    <div class="container">
        <div class="row">
            <card-component v-for="starship in starships" :key="starship.id" :starship="starship"></card-component>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
        }
    },

    computed: {
        starships() {
            return this.$store.getters.starships;
        }
    },

    mounted() {
        console.log('Grid component mounted.');
        this.$store.dispatch('getStarships');
        this.$store.dispatch('getPilots');
    },

    methods: {
    }
}
</script>
