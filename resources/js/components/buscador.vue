<template>
    <span>
        <v-autocomplete append-icon="mdi-search-web" placeholder="Que estas buscando?" @change="redireccionar" v-model="buscador" :items="items" no-data-text="No hay datos disponibles">

        </v-autocomplete>
    </span>
</template>

<script>
export default {
    props: ['base','buscar'],
    data(){
        return {
            buscador: '',
            link: [],
            items: [],
        }
    },
    methods: {
        redireccionar(){
            let l = this.buscador;
            for (let i = 1; i < this.link.length; i++) {
                l += '|' + this.link[i];
            }

            location.replace(this.base + '/buscar/' + l);
        }
    },
    mounted(){
        if (this.buscar) {
            this.link = this.buscar.split('|');
            this.buscador = this.link[0];
        }

        axios.get(this.base + '/api/productos-nombre').then(r=>{
            this.items = [];
            for (let i = 0; i < r.data.length; i++) {
                this.items.push(r.data[i].nombre)
            }
        }).catch(e=>{
            console.log(e);
        });
    }
}
</script>

<style>

</style>