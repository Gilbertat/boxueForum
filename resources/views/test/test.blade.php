<script type="text/javascript">
    import { get } from '../../assets/js/helpers/api'
    get('/test/show')
        .then((res) => {
            console.log(res)
        })
</script>