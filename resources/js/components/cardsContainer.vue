<template>
    <div class="cardsContainer" id="cardsContainer">
        <h2 class="title d-flex mb-4"><span>Le nostre proposte</span></h2>
        <div class="cardsContainer__content">
            <div v-show="cakeTypes && !recipeComponent.isActive" class="cardswrapper row">
                <card
                    v-for="cakeType in cakeTypes" v-bind:key="cakeType.id"
                    v-bind:props="cakeType"
                    @fromCard='toggleRecipe($event)'
                >
                </card>
            </div>
            <recipe
                v-if="recipeComponent.isActive"
                v-bind:props="recipeComponent.cakeType"
                @fromRecipe='toggleRecipe()'
            >
            </recipe>
        </div>
    </div>
</template>

<script>
    import card from './card'
    import recipe from './recipe'

    const baseUrl = window.location.protocol + "//" + window.location.host
    const apiUrl = baseUrl + '/api/cakeType'

export default {
        data() {
            return {
                cakeTypes: null,
                recipeComponent: {
                    isActive: false,
                    cakeType: null
                },
            }
        },
        methods: {
            fetchData() {
                axios.get(apiUrl)
                    .then(response => {
                        this.cakeTypes = response.data.data
                    })
                    .catch(function (e) {
                        console.log(e);
                    });
            },
            toggleRecipe(event=null) {
                this.recipeComponent.cakeType = event ? event.cakeType : null
                this.recipeComponent.isActive = event != null
                document.getElementById("cardsContainer").scrollIntoView();
                window.scrollBy(0, -55);
            }
        },
        mounted() {
            this.fetchData()
        },
        components: { card, recipe }
    };
</script>

<style scoped lang="scss">
    .cardsContainer {
        position: relative;
        padding-top: 50px;
        min-height: calc(100vh);

        .title {
            justify-content: center;
            align-items: center;
            height: 100px;
            font-size: bold;
            font-size: 200%;
        }
        .cardswrapper {
            justify-content: center;
        }
    }

    @media (min-width: 768px) {
        .cardsContainer {
            .title {
                font-size: 200%;
            }
        }
    }
</style>
