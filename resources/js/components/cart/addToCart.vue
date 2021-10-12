<template>
    <div style="min-width: 100%;">
        <a @click.prevent="addToCart(equipment)" class="btn btn-primary btn-sm" style="cursor: pointer;"><span>Xuất kho</span></a>
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
    data(){
        return {
            item: this.equipment,
        }
    },
    methods: {
        ...mapActions(['addToCart']),
        add(){
           console.log(this.item);
        }
    },
}
</script>

<style>

</style>
