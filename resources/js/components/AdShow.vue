<template>
    <div class="container my-3">
            <b-carousel
                v-if="adData.adImages.length"
                id="carousel-no-animation"
                style="text-shadow: 0px 0px 2px #000"
                no-animation
                indicators
                img-width="100%"
                img-height="450px"
                img-object-fit="cover"
            >
                <b-carousel-slide
                    v-for="(image, index) in adData.adImages"
                    :img-src="image.url"
                    :key="index"
                ></b-carousel-slide>
            </b-carousel>
            <b-card v-if="adData"
                    :title="adData.title"
            >
                <b-card-text>
                    {{ adData.description }}
                </b-card-text>
                <b-card-text>
                    {{ adData.contacts }}
                </b-card-text>
                <template #footer>
                    <small class="text-muted">{{ adData.created_at }}</small>
                </template>
            </b-card>
        <b-overlay :show="loader" no-wrap></b-overlay>
    </div>
</template>

<script>
export default {
    name: "AdShow",
    props: ['adId'],
    data: () => {
        return {
            ad: null,
            loader: true,
        }
    },
    computed: {
        adData: function () {
            return this.ad
        }
    },
    methods: {
        getAd() {
            axios.get(`/api/ads/${this.adId}`, {
                params: {
                    fields: ['description', 'created_at', 'adImages', 'contacts']
                }
            }).then((resp) => {
                if (resp.data.status === 'success') {
                    this.ad = resp.data.ad[0];
                }
            })
        }
    },
    mounted() {
        this.getAd();
    },
    created() {
        this.loader = false
    }
}
</script>

<style lang="css" scoped>

</style>
