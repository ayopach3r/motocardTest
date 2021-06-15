<template>
    <div class="col-sm-4">
        <div class="card card_margin">
            <div class="card-header text-center">
                <h5 class="card-title">{{ starship.name }}</h5>
                <p v-if="starship.cost_in_credits != 0" class="card-text">Price: <b>{{ priceConverter15(starship.cost_in_credits) }}</b></p>
                <p v-else class="card-text">Price: <b>Unknown</b></p>
            </div>
            <div class="card-body">
                <div v-if="starship.pilots.length > 0">
                    <div v-for="pilot in starship.pilots" :key="pilot.id" :pilot="pilot" class="row">
                        <div class="col-sm-9">
                            <p>{{ pilot.name }}</p>
                        </div>
                        <div class="col-sm-3">
                            <button v-on:click="removePilot(pilot.id)" class="btn btn-outline-danger" type="button">Delete</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-9">
                        <select v-model="new_pilot" class="form-select">
                            <option v-bind:value="0">Select a new pilot</option>
                            <option v-for="pilot in pilots" v-bind:value="pilot.id">
                                {{ pilot.name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <button v-if="new_pilot != 0" v-on:click="addPilot(new_pilot)" class="btn btn-success" type="button">Insert</button>
                    </div>
                </div>
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
                new_pilot: 0,
                normal_char: ['a', 'b', 'c', 'd', 'e',],
                special_char: ['\xb6', '\xb5', '\xa2', '\xde', '\xdf',],
            }
        },

        computed: {
            pilots() {
                return this.$store.getters.pilots;
            }
        },

        mounted() {
            console.log('Card component mounted.');
            this.pilotsFilter(this.starship.pilots, pilots);
        },

        methods: {
            priceConverter15(price) {
                if (price == 0) {
                    return price;
                }

                let price_base15 = price.toString(15);
                let item_pos = 0;

                this.normal_char.forEach(element => {
                    price_base15 = price_base15.replaceAll(element, this.special_char[item_pos]);
                    item_pos++;
                });

                return price_base15;
            },

            removePilot(pilot_id) {
                this.$store.dispatch('removePilot', {
                    starship_id: this.starship.id,
                    pilot_id: pilot_id
                })
            },

            addPilot(new_pilot) {
                this.$store.dispatch('addPilot', {
                    starship_id: this.starship.id,
                    pilot_id: new_pilot
                })
            },
        }
    }
</script>

<style scoped>
    .card_margin {
        margin-bottom: 15px;
    }
</style>
