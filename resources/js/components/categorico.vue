<template>
    <v-menu offset-y>
        <template v-slot:activator="{ on }">
            <v-btn v-on="on">
                <v-icon>
                    mdi-dots-vertical
                </v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-list>
                <v-list-item>
                    <v-list-item-title>
                        <a :href="base + '/buscar'" class="red--text">VER TODO</a>
                    </v-list-item-title>
                </v-list-item>
                <v-divider></v-divider>
            </v-list>
            <v-list v-for="(c,index) in categorias" :key="index">
                <v-list-item>
                    <v-list-item-title>
                        <a :href="base + '/buscar/|' + c.nombre" class="red--text">{{c.nombre}}</a>
                    </v-list-item-title>
                </v-list-item>
                <v-divider v-if="categorias.length > 0"></v-divider>
                
                <span v-for="(s,i) in subcategorias" :key="i">
                    <v-list-item v-if="s.categoria == c.nombre">
                        <a :href="base + '/buscar/|' + c.nombre + '|' + s.nombre">{{s.nombre}}</a>
                    </v-list-item>
                </span>
            </v-list>
        </v-card>
    </v-menu>
</template>

<script>
export default {
    props: ['base'],
    data(){
        return {
            categorias: [],
            subcategorias: []
        }
    },
    mounted(){
        axios.get(this.base + '/api/get-categorias').then(r=>{
            this.categorias = r.data.categorias;
            this.subcategorias = r.data.subcategorias;
        }).catch(e=>{
            console.log(e);
        });
    }
}
</script>

<style>

</style>