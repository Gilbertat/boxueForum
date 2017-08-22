import {get, post} from '../../helpers/api'
import * as types from '../mutation-types'

const state = {
    url: '',
    topic: [],
    replies: []
}

const actions = {
    topicShow({commit}, id) {
        return new Promise((resolve, reject) => {
            get(`/api/topics/${id}`)
                .then((res) => {
                    commit(types.GET_TOPIC, {topic: res})
                    resolve(res)
                }, (err) => {
                    reject(err)
                })
        })
    },

    reply({ commit }, form) {
        return new Promise((resolve, reject) => {
            post('/api/replies/store', form)
                .then((res) => {
                    resolve(res)
                    commit(types.POST_REPLY, {reply: res.data.reply})
                }, (err) => {
                    reject(err)
                })
        })
    }
}

const mutations = {
    [types.GET_TOPIC](state, {topic}) {
        state.url = topic.data.url
        state.topic = topic.data.topic
        state.replies = topic.data.replies.data
    },

    [types.POST_REPLY](state, {reply}) {
        state.replies.push(reply)
    }
}

export default  {
    state,
    actions,
    mutations
}