export default {
    state: {
        api_token: null,
        user_id: null,
        user_name: null,
        user_avatar: null
    },
    initialize() {
        this.state.api_token = localStorage.getItem('api_token')
        this.state.user_id = parseInt(localStorage.getItem('user_id'))
        this.state.user_name = localStorage.getItem('user_name')
        this.state.user_avatar = localStorage.getItem('user_avatar')

    },
    set(data) {
        localStorage.setItem('api_token', data.api_token)
        localStorage.setItem('user_id', data.user_id)
        localStorage.setItem('user_name', data.user_name)
        localStorage.setItem('user_avatar', data.user_avatar)
        this.initialize()
    },
    get: function (data) {
        return localStorage.getItem(data)
    },

    remove() {
        localStorage.removeItem('api_token')
        localStorage.removeItem('user_id')
        localStorage.removeItem('user_name')
        localStorage.removeItem('user_avatar')

        this.initialize()
    }
}
