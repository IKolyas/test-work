<template>
    <div class="container my-3">
        <b-form @submit="onSubmit" class="ad-form" @reset="onReset" v-if="show">
            <b-form-group
                id="form-title"
                label="Наименование"
                label-for="title"
                :description="errorFields.title ? errorFields.title[0]  : ''"
            >
                <b-form-input
                    id="title"
                    v-model="form.title"
                    type="text"
                    max="200"
                    placeholder="Enter title"
                    @input.native="errorFieldReset"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="form-description"
                label="Описание"
                label-for="description"
                :description="errorFields.description ? errorFields.description[0]  : ''"
            >
                <b-form-textarea
                    id="description"
                    v-model="form.description"
                    rows="5"
                    max-rows="100"
                    @input.native="errorFieldReset"
                    placeholder="Enter description"
                ></b-form-textarea>
            </b-form-group>

            <b-form-group
                id="form-contacts"
                label="Контакты"
                label-for="contacts"
                :description="errorFields.contacts ? errorFields.contacts[0]  : ''"
            >
                <b-form-input
                    id="contacts"
                    v-model="form.contacts"
                    type="text"
                    max="300"
                    @input.native="errorFieldReset"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="form-price"
                label="Цена"
                label-for="price"
                :description="errorFields.price ? errorFields.price[0]  : ''"
            >
                <b-form-input
                    id="price"
                    v-model="form.price"
                    type="number"
                    @input.native="errorFieldReset"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="form-image-1"
                label="Изображение 1"
                label-for="image-1"
                :description="errorFields['images.0.url'] ? errorFields['images.0.url'][0]  : ''"
            >
                <b-form-input
                    id="images.0.url"
                    v-model="form.images[0]"
                    type="text"
                    @input.native="errorFieldReset"
                    required
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="form-image-2"
                label="Изображение 2"
                label-for="image-2"
                :description="errorFields['images.1.url'] ? errorFields['images.1.url'][0] : ''"
            >
                <b-form-input
                    id="images.1.url"
                    v-model="form.images[1]"
                    @input.native="errorFieldReset"
                    type="text"
                ></b-form-input>
            </b-form-group>

            <b-form-group
                id="form-image-3"
                label="Изображение 3"
                label-for="image-3"
                :description="errorFields['images.2.url'] ? errorFields['images.2.url'][0]  : ''"
            >
                <b-form-input
                    id="images.2.url"
                    v-model="form.images[2]"
                    @input.native="errorFieldReset"
                    type="text"
                ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="primary">Опубликовать</b-button>
            <b-button type="reset" variant="danger">Сбросить</b-button>
        </b-form>
    </div>
</template>

<script>

export default {
    name: "AdCreate",
    data() {
        return {
            form: {
                title: '',
                description: '',
                contacts: '',
                price: 0,
                images: [],
            },
            errors: [],
            show: true
        }
    },
    computed: {
        errorFields: function () {
            return this.errors;
        }
    },
    methods: {
        onSubmit(event) {
            event.preventDefault()
            let FormData = this.postDataForm()
            axios.post('/api/ads', {...FormData})
                .then(resp => {
                    if (resp.data.status === 'success') {
                        this.$router.push({name: 'AdShow', params: {adId: resp.data.ad}})
                    }
                })
                .catch((error) => {
                    let dataError = error.response.data;
                    if (dataError && dataError.status === 'error') {
                        this.errors = {...dataError.errors}
                    }
                })
        },

        errorFieldReset(e)
        {
            if (this.errors[e.target.id]) {
                this.errors[e.target.id] = '';
            }
        },

        postDataForm()
        {
            const data = {...this.form};

            const images = [];

            this.form.images.forEach((url, key) => {
                if (url.length) {
                    images.push({url, priority: ++key})
                }
            })

            data.images = images

            return data;
        },

        onReset(event) {
            event.preventDefault()
            this.form.title = ''
            this.form.description = ''
            this.form.contacts = ''
            this.form.price = ''
            this.form.images = []
            this.errors = []
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .text-muted {
        color: red !important;
    }
</style>
