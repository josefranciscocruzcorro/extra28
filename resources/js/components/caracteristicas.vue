<template>
    <v-simple-table dense>
        <template v-slot:default>
            <thead>
                <tr>
                    <th class="text-left">Característica</th>
                    <th class="text-left">Descripción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(item,i) in items" :key="i">
                    <td>{{ item.propiedad }}</td>
                    <td>{{ item.valor }}</td>
                </tr>
            </tbody>
        </template>
    </v-simple-table>
</template>

<script>
export default {
    props: ['caracteristicas'],
    data(){
        return {
            items: []
        }
    },
    mounted(){
        let itm = this.caracteristicas.split(";;");

        for (let i = 0; i < itm.length; i++) {
            let x = itm[i].split("----")

            this.items.push({
                propiedad: x[0],
                valor: x[1],
            })
        }
    }
}
</script>

<style>

</style>