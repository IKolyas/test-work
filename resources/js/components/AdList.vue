<template>
    <b-container class="bv-example-row my-3">
            <div class="my-2">
                <b-button @click="changeSort('created_at')">Дата публикации
                    <b-icon v-if="sort.created_at" icon="bar-chart-fill"></b-icon>
                    <b-icon v-else icon="bar-chart-fill" flip-h></b-icon>
                </b-button>
                <b-button @click="changeSort('price')">Цена
                    <b-icon v-if="sort.price" icon="bar-chart-fill"></b-icon>
                    <b-icon v-else icon="bar-chart-fill" flip-h></b-icon>
                </b-button>
            </div>

            <b-row v-if="ads.length" class="justify-content-around">
                <ad-card v-for="(ad, index) in ads" :key="ad.id" :item="ad"></ad-card>
                <b-overlay :show="loader" no-wrap></b-overlay>
            </b-row>
            <b-button v-show="showMoreButton" class="my-4" @click="showMore()">Показать ещё</b-button>
    </b-container>
</template>

<script>
import AdCard from "./ads/AdCard";

export default {
    name: "AdList",
    components: {AdCard},
    data: () => {
        return {
            adList: [],
            loader: true,
            sort: {
                created_at: 1,
                price: 1
            },
            page: 1,
            lastPage: null
        }
    },
    computed: {
        ads: function () {
            return this.adList || [];
        },

        showMoreButton: function () {
            return this.page < this.lastPage;
        }
    },
    methods: {
        showMore: function () {
            ++this.page
            this.getAds()
        },

        changeSort: function (field) {
            this.page = 1;
            this.sort[field] = this.sort[field] ? 0 : 1;
            this.getAds(true);
        },

        getAds: async function (sort = false) {
            this.loader = true;
            axios.get('/api/ads', {
                params: {
                    page: this.page,
                    sort: this.sort,
                }
            })
                .then(resp => {
                    if (resp.data.status === 'success') {

                        if (sort) {
                            this.adList = [];
                            this.adList = [...resp.data.ads]
                        } else {
                            this.adList = [...this.adList, ...resp.data.ads];
                        }
                        this.page = resp.data.current_page;
                        this.lastPage = resp.data.last_page;
                    }
                }).finally(() => this.loader = false)

            await this.$nextTick();
        }
    },
    mounted() {
        this.getAds();
    }
}
</script>

<style scoped>

</style>
