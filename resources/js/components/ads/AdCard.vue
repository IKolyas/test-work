<template>
    <div v-if="adItem" class="ad-card">
        <b-card
            :title="adItem.title"
            :img-src="adItem.image"
            :img-alt="adItem.title"
            img-top
            tag="article"
            style="max-width: 20rem;"
            class="mb-2"
        >
            <router-link
                :to="{name: 'AdShow', params: { adId: adItem.id } }"
                tag="b-button"
                variant="primary">
                {{ adItem.price }} RUR
            </router-link>
        </b-card>
    </div>
</template>

<script>
export default {
    name: "AdCard",
    props: ['item'],
    data: () => {
        return {
            ad: null
        }
    },
    computed: {
        adItem: function() {
            return this.ad;
        }
    },
    created() {
        this.ad = this.item;
    }
}
</script>

<style lang="scss" scoped>
.ad-card {
    article {
        min-height: 250px;

        img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    }
}
</style>
