export default {
    setThumbnailNames(state, thumbnails){
        state.thumbnails = thumbnails;
    },
    resetThumbnailNames(state){
        state.thumbnails = [];
    },
    addEquipment(state, equipment){
        state.equipments.push(equipment);
    },
    removeEquipment(state,equipment){
        let index = state.equipments.indexOf(equipment);
        state.equipments.splice(index, 1);
    },
    setEquipments(state, equipments){
        state.equipments = equipments;
    }

}
