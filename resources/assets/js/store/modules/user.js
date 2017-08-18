import auth from '../auth'
import {post} from '../../helpers/api'
import * as types from '../mutation-types'

const state = {
    user: [],
    loginStatus: null
}

const getters = {
    loginStatus: state => state.loginStatus
}

const actions = {
    login({commit}, form) {
        commit(types.CHECKOUT_REQUEST)
        return new Promise((resolve, reject) => {
            post('api/login', form)
                .then((res) => {
                    if (res.status === 200) {
                        commit(types.LOGIN, {user_info: res.data})
                        commit(types.LOGIN_SUCCESS)
                        resolve(res)
                    }
                }, (err) => {
                   if (err.response.status === 422) {
                       reject(err)
                   }
                })
        })
    }
}

const mutations = {
    [types.CHECKOUT_REQUEST](state) {
        auth.remove()
        state.user = []
        state.loginStatus = null
    },

    [types.LOGIN](state, {user_info}) {
        state.user = user_info
        auth.set(user_info)
    },

    [types.LOGIN_SUCCESS](state) {
        state.loginStatus = 'success'
    }
}

export default {
    state,
    actions,
    mutations,
    getters
}