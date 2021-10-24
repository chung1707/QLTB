<template>
    <div style="min-width: 100%;">
        <a @click.prevent="addToSellCart(equipment)" class="btn btn-primary btn-sm" style="cursor: pointer;"><span>Thêm vào giỏ</span></a>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    props: {
        equipment: {
            required: true,
            type: Object
        },
    },
    methods: {
        ...mapActions(['addToSellCart']),
    },
}
</script>

<style>

</style>
