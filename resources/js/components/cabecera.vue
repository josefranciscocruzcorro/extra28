<template>
  <v-container>
      <v-row>
        <v-col v-for="(d,index) in datos" :key="index">
            <a v-if="d.url" :href="d.url">
                <v-icon v-if="d.icono">
                    {{d.icono}}
                </v-icon>
                {{d.valor}}
            </a>
            <span v-else>
                <v-icon v-if="d.icono">
                    {{d.icono}}
                </v-icon>
                {{d.valor}}
            </span>
        </v-col>
      </v-row>
  </v-container>
</template>

<script>
export default {
    props: ['base'],
    data(){
        return  {
            datos: []
        }
    },
    mounted() {
        axios.get(this.base + '/api/globales/cabecera/tipo').then(r=>{
            this.datos = r.data;
        }).catch(e=>{
            console.log(e);
        });
    }
}
</script>

<style>

</style>