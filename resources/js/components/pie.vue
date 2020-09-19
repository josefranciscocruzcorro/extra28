<template>
    <v-row align="center">
        <v-col v-if="datos" align="center">
            <v-btn v-for="(d,index) in datos" :key="index" link x-small :href="d.url">
                <v-icon>
                    {{d.icono}}
                </v-icon>
                <span v-if="d.valor">
                    {{d.valor}}
                </span>
            </v-btn>
        </v-col>
        <v-col v-if="otros || terminos || politicas" align="center">
            <v-list-item v-for="(o,index) in otros" :key="index">
                <v-list-item-content align="center">
                    <a :href="o.url">
                        {{o.nombre}}
                    </a>
                </v-list-item-content>
            </v-list-item>
            
            <v-list-item v-if="terminos">
                <v-list-item-content align="center">
                    <a :href="terminos.url">
                        Términos y condiciones
                    </a>
                </v-list-item-content>
            </v-list-item>
            
            <v-list-item v-if="politicas">
                <v-list-item-content align="center">
                    <a :href="politicas.url">
                        Políticas de privacidad
                    </a>
                </v-list-item-content>
            </v-list-item>
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: ['base'],
    data(){
        return  {
            datos: [],
            otros: [],
            terminos: null,
            politicas: null,
        }
    },
    mounted() {
        axios.get(this.base + '/api/globales/pie/tipo').then(r=>{
            this.datos = r.data;
        }).catch(e=>{
            console.log(e);
        });
        
        axios.get(this.base + '/api/globales/pie/tipo/pagina').then(r=>{
            this.otros = r.data;
        }).catch(e=>{
            console.log(e);
        });
        
        axios.get(this.base + '/api/globales/pie/tipo/terminos').then(r=>{
            this.terminos = r.data;
        }).catch(e=>{
            console.log(e);
        });
        
        axios.get(this.base + '/api/globales/pie/tipo/politicas').then(r=>{
            this.politicas = r.data;
        }).catch(e=>{
            console.log(e);
        });
    }
}
</script>

<style>

</style>