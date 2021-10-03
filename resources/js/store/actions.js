const axios = require('axios');

export default {
    setThumbnails(context, thumbnails){
        context.commit('setThumbnailNames',thumbnails);
    },
    addEquipment(context, equipment){
        context.commit('addEquipment',equipment);
        context.commit('setThumbnailNames',[]);
    },
    removeEquipment(context, equipment){
        context.commit('removeEquipment',equipment);
    },
    import(context,equipments_import){
        let equipments = equipments_import[0];
        let bill = equipments_import;
        equipments.forEach(equipment => equipment.supplier_id = equipments_import[1]);
        axios.post('/equipment',{'equipments': equipments, 'bill': bill}).then((response) =>{
            if(response.data.status == 201){
                context.commit('setEquipments',[]);
            }
        });
    },
}
