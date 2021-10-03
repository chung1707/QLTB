export default {
    thumbnails(state){
        return state.thumbnails;
    },
    equipments(state){
        return state.equipments;
    },
    totalPrice(state){
        let sum = null;
        for (var i = 0; i < state.equipments.length; i++) {
            sum +=
                state.equipments[i].price *
                state.equipments[i].quantity;
        }
        return sum;
    }
}
