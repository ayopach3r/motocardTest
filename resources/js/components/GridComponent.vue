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
            starships: [],
            normal_char: ['a', 'b', 'c', 'd', 'e',],
            special_char: ['\xb6', '\xb5', '\xa2', '\xde', '\xdf',],
        }
    },

    mounted() {
        console.log('Grid component mounted.');
        this.getAllStarships();
    },

    methods: {
        getAllStarships() {
            axios
                .get('/starships')
                .then(response => {
                    let data = response.data;

                    data.forEach(element => {
                        let starship = {
                            id: element.id,
                            name: element.name,
                            price: this.priceConverter15(element.cost_in_credits),
                            pilots: element.pilots
                        }

                        this.starships.push(starship);
                    });
                });
        },

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
        }
    }
}
</script>
