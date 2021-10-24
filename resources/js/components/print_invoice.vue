<template>
    <div>
        <a class="btn btn-primary" @click.prevent="print()">In hóa đơn</a>
    </div>
</template>

<script>
export default {
    methods: {
        print(){
            window.print();
        }
    }
};
</script>

<style></style>
