<template>

    <b-carousel
      :interval="4000"
      controls
      indicators
      background="#ababab"
      img-width="1024"
      img-height="480"
      style="text-shadow: 1px 1px 2px #333;"
    >
        <!-- Text slides with image -->
        <b-carousel-slide
            v-for="(i,index) in items"
            :key="index"
            :img-src="base + '/images/banner/' + i.valor"
        >
            <b-embed
                v-if="i.url"
                type="iframe"
                aspect="16by9"
                :src="i.url"
                allowfullscreen
            ></b-embed>
        </b-carousel-slide>
    </b-carousel>
</template>

<script>
export default {
    props: ['base'],
    data(){
        return  {
            items: []
        }
    },
    mounted() {
        axios.get(this.base + '/api/globales/banner/tipo').then(r=>{
            this.items = r.data;
        }).catch(e=>{
            console.log(e);
        });
    }
}
</script>

<style>

</style>