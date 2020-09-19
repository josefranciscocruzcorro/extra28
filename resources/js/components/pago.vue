<template>
    <div class="row mx-1">

        <div class="col-12">
            Al realizar esta accion usted esta declara estar deacuerdo con nuestros 
            <a :href="terminos" target="_blank" rel="noopener noreferrer">
                Terminos y condiciones
            </a>,
            y con nuestras
            <a :href="terminos" target="_blank" rel="noopener noreferrer">
                Politicas de privacidad
            </a>.
            <br>
            Cuando el pago haya sido aprobado y verificado nos contactaremos con usted al email proporcionado durante su registro.
            <br>
            <strong>
                IMPORTANTE: Mientras se procece el pago, no recargue la pagina, ni cierre su navegador, 
                para poder ejecutar la accion. Hacerlo esta bajo su responsabilidad.
            </strong>
        </div>

        <input type="hidden" name='currency' value="USD">
        <input type="hidden" name="subtotal" :value="subtotal">


        <b-form-group class="col-12" description="Coloque la direccion a la que debe llegar su pedido. O en su defecto coloque el casillero postal y nombre del servicio de entrega que quiere usar.">
            Direccion a enviar el pedido ejm: "Ecuador, Quito, Av Maldonado 234e y Calle michelena" o "Servientrega casillero postal 123 Quito Agencia Guamani"
            <input type="text" class="form-control" name="destino" placeholder="si desea retirar en persona su pedido no llene este campo">
        </b-form-group>

        <b-form-group class="col-12">
            Valor a total a pagar
            <span>
                (No incluye envio)
            </span>
            <strong>
                ${{total}}
            </strong>
            <input type="hidden" class="form-control" name="total" :value="total">
        </b-form-group>
        

        <b-form-group class="col-12">
            Valor a total a pagar
            <span>
                (Incluye envio)
            </span>
            <strong>
                ${{(parseFloat(total) + parseFloat(envio)).toFixed(2)}}
            </strong>
            <input type="hidden" class="form-control" name="envio" :value="(parseFloat(total) + parseFloat(envio)).toFixed(2)">
        </b-form-group>

        <b-form-group class="col-12" label="Tipo de pago" description="Elija el tipo de pago que va a realizar.">
            <b-form-select v-model="tipo" name="tipo" :options="tipos"></b-form-select>
        </b-form-group>

        <b-form-group class="col-12" v-if="tipo == 'efectivo'">
            <input type="hidden" name="name" :value="name">
            <input type="hidden" name="lastname" :value="lastname">
            <input type="hidden" name="identification" :value="identification">
            <input type="hidden" name="documentType" :value="documenttype">
            <input type="hidden" name="email" :value="email">
            

            <b-btn block type="submit">
                Generar orden de pago
            </b-btn>
        </b-form-group>

        <b-form-group class="col-12" v-if="tipo == 'tarjeta'" label="Titular" description="Nombre del titular">
            <input type="text" class="form-control" autocomplete="off" name="name" required>
        </b-form-group>

        <b-form-group class="col-12" v-if="tipo == 'tarjeta'" label="Numero" description="Ingrese el numero de tarjeta">
            <input type="text" class="form-control" autocomplete="off" name="number" required>
        </b-form-group>

        
        <b-form-group class="col-4" v-if="tipo == 'tarjeta'" label="Mes">
            <b-form-select v-model="expiryMonth" name="expiryMonth" :options="meses" required></b-form-select>
        </b-form-group>
        <b-form-group class="col-4" v-if="tipo == 'tarjeta'" label="Año">
            <b-form-select v-model="expiryYear" name="expiryYear" :options="anios" required></b-form-select>
        </b-form-group>
        <b-form-group class="col-4" v-if="tipo == 'tarjeta'" label="CVV">
            <input type="text" class="form-control" name="cvv" required>
        </b-form-group>

        <b-form-group class="col-12" v-if="tipo == 'tarjeta'">
            <b-btn block type="submit">
                Pagar
            </b-btn>
        </b-form-group>
    </div>
</template>

<script>
export default {
    props: ['terminos','privacidad','name','lastname','identification','documenttype','email','total','envio','subtotal'],
    data(){
        return {
            tipo: '',
            tipos: [
                {value: 'efectivo',text:'Efectivo'},
                {value: 'tarjeta',text:'Tarjeta de credito o debito'}
            ],

            expiryMonth: '01',
            expiryYear: '01',

            meses: ['01','02','03','04','05','06','07','08','09','10','11','12'],
            anios: ['11','12','13','14','15','16','17','18','19','20',
                    '21','22','23','24','25','26','27','28','29','30',
                    '31','32','33','34','35','36','37','38','39','40',
                    '41','42','43','44','45','46','47','48','49','50',
                    '51','52','53','54','55','56','57','58','59','60',
                    '61','62','63','64','65','66','67','68','69','70',
                    '71','72','73','74','75','76','77','78','79','80',
                    '81','82','83','84','85','86','87','88','89','90',
                    '91','92','93','94','95','96','97','98','99',],
        }
    },
}
</script>

<style>

</style>