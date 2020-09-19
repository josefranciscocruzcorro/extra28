<template>
    <span></span>
</template>

<script>
export default {
    props: ['base'],
    mounted() {
        axios.get(this.base+'/generacion_api').then(r=>{
            this.$store.state.mi_token = r.data.token;
        }).catch(e=>{
            this.$store.state.mi_token = 'api no valida'
        });
    }
}
</script>

<style>

</style>