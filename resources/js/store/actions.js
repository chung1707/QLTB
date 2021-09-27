const axios = require('axios');

export default {
    setThumbnails(context, thumbnails){
        context.commit('setThumbnailNames',thumbnails);
    },
    addEquipment(context, equipment){

    }
}
