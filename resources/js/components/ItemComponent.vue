<template>
    <tr>
        <td>{{ pilot.name }}</td>
        <td><a class="btn btn-danger" href="#" role="button">X</a></td>
    </tr>
</template>

<script>
export default {
    props: [
        'pilot'
    ],

    data() {
        return {
        }
    },

    mounted() {
        console.log('Item component mounted.')
    }
}
</script>
