<template>
    <div class="col-sm-4">
        <div class="card" style="margin-bottom: 15px">
            <div class="card-header text-center">
                <h5 class="card-title">{{ starship.name }}</h5>
                <p v-if="starship.price != 0" class="card-text">Price: <b>{{ starship.price }}</b></p>
                <p v-else class="card-text">Price: <b>Unknown</b></p>
            </div>
            <div class="card-body">
                <div v-if="starship.pilots.length > 0">
                    <table class="table">
                        <item-component v-for="pilot in starship.pilots" :key="pilot.id" :pilot="pilot"></item-component>
                    </table>
                </div>
                <insert-component></insert-component>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'starship'
        ],

        data() {
            return {
                pilots: [],
            }
        },

        mounted() {
            console.log('Card component mounted.');
            //this.getPilotsByStarship();
        },

        methods: {

        }
    }
</script>
