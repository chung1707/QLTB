<template>
    <div>
        <div v-if="!this.isBlock">
            <span><i style="color:green;" class="fab fa-creative-commons-by"></i></span>
            <button
                type="submid"
                class="btn btn-light btn-icon-split btn-sm"
                @click="block()"
            >
                Khóa tài khoản
            </button>
        </div>
        <div v-else>
            <span><i style="color:red;" class="fas fa-ban"></i></span>
            <button
                type="submid"
                class="btn btn-light btn-icon-split btn-sm"
                @click="unblock()"
            >
                Mở khóa
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            isBlock: null,
        }
    },
    props: {
        user: {
            type: Object,
            required: true
        }
    },
    methods: {
        block() {
            axios.post("/users/block/"+this.user.id);
            this.isBlock = true;
        },
        unblock() {
            axios.post("/users/unblock/"+this.user.id);
            this.isBlock =false;
        }
    },
    mounted() {
        this.isBlock = this.user.blocked;
    }
};
</script>

<style></style>
