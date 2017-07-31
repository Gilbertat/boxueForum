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
    set(api_token, user_id) {
        localStorage.setItem('api_token', api_token)
        localStorage.setItem('user_id', user_id)
        localStorage.setItem('user_name', user_name)
        localStorage.setItem('user_avatar', user_avatar)
        this.initialize()
    },
    remove() {
        localStorage.removeItem('api_token')
        localStorage.removeItem('user_id')
        localStorage.removeItem('user_name')
        localStorage.removeItem('user_avatar')

        this.initialize()
    }
}
