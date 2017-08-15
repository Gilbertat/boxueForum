import auth from '../auth'

const state = {
    api_token: null,
    user_id: 0,
    user_name: null,
    user_avatar: null
}

const mutations = {
    setUserData (state, data) {
        state.api_token = data.api_token;
        state.user_id = data.user_id;
        state.user_name = data.user_name;
        state.user_avatar = data.user_avatar;

    },

    removeUserData (state) {
        state.api_token = null;
        state.user_avatar = null;
        state.user_id = 0;
        state.user_name = null;
    }
}

export default  {
    state,
    mutations
}