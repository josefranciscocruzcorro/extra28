<template>
    <span>
        <strong>
            Caracteristicas:
        </strong>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>
                        Caracteristica
                    </th>
                    <th>
                        Valor
                    </th>
                    <th>

                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <v-text-field label="nueva propiedad" v-model="caracteristica.propiedad"></v-text-field>
                        </td>
                        <td>
                            <v-text-field label="nueva descripcion" v-model="caracteristica.descripcion"></v-text-field>
                        </td>
                        <td>
                            <v-btn color="green" @click="anadir">
                                <v-icon>
                                    mdi-plus-circle
                                </v-icon>
                            </v-btn>
                        </td>
                    </tr>

                    
                    <tr v-for="(c,i) in caracteristicas" :key="i">
                        <td>
                            <v-text-field label="editar propiedad" v-model="c.propiedad" @change="unirValor" @keyup="unirValor"></v-text-field>
                        </td>
                        <td>
                            <v-text-field label="editar descripcion" v-model="c.descripcion" @change="unirValor" @keyup="unirValor"></v-text-field>
                        </td>
                        <td>
                            <v-btn color="red" @click="eliminar(i)">
                                <v-icon>
                                    mdi-trash-can
                                </v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <input type="hidden" :name="nombre" :value="valor">
    </span>
</template>

<script>
export default {
    props: ['name','value'],
    data(){
        return {
            nombre: '',

            caracteristicas: [],
            valor: '',
            
            caracteristica: {
                propiedad: '',
                descripcion: ''
            }
        }
    },
    methods: {
        anadir(){
            this.caracteristicas.push({
                propiedad: this.caracteristica.propiedad,
                descripcion: this.caracteristica.descripcion
            });

            this.caracteristica = {
                propiedad: '',
                descripcion: ''
            };

            this.unirValor();
        },
        unirValor(){
            this.valor = '';
            
            if(this.caracteristicas.length >= 1){
                this.valor = this.caracteristicas[0].propiedad + '----' + this.caracteristicas[0].descripcion
            }
            
            for (let i = 1; i < this.caracteristicas.length; i++) {
                this.valor += ';;' + this.caracteristicas[i].propiedad + '----' + this.caracteristicas[i].descripcion
            }
        },
        eliminar(index){
            this.caracteristicas.splice(index,1);

            this.unirValor();
        }
    },
    mounted(){
        if (this.value) {
            this.valor = this.value;

            let c1 = this.value.split(';;')
            

            for (let i = 0; i < c1.length; i++) {
                let c2 = c1[i].split('----');

                this.caracteristicas.push({
                    propiedad: c2[0],
                    descripcion: c2[1]
                });
            }
        }
        if (this.name) {
            this.nombre = this.name; 
        }
    }
}
</script>

<style>

</style>