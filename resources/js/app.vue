<template>
    <div class="page container">
        <jumbotron v-show="!recipe.isActive"></jumbotron>
        <cardsContainer v-show="!recipe.isActive" @fromCard='showRepice($event)'></cardsContainer>
        <recipe
            v-if="recipe.isActive"
            v-bind:props="recipe.cakeType"
            @fromRecipe='CloseRepice()'
        >
        </recipe>
    </div>
</template>

<script>
    import jumbotron from './components/jumbotron'
    import cardsContainer from './components/cardsContainer'
    import recipe from './components/recipe'

    export default {
        data() {
            return {
                recipe: {
                    isActive: false,
                    cakeType: null
                }
            }
        },
        methods: {
            showRepice(event) {
                this.recipe.cakeType = event['cakeType']
                return this.recipe.isActive = true
            },
            CloseRepice() {
                this.recipe.cakeType = null
                return this.recipe.isActive = false
            }
        },
        components: { jumbotron, cardsContainer, recipe }
    }
</script>

<style lang="scss" scoped>
    .page {
        position: relative;
    }
</style>
