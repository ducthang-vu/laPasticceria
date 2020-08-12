<template>
    <div class="recipe d-flex">
        <div class="recipe__img-wrapper">
            <img :src="image" :alt="name">
        </div>
        <section class="recipe__description p-5 d-flex text-center" :style="bgColor">
            <div class="recipe__description__inner">
                <h1>{{ capitalize(name) }}</h1>
                <h3> {{ currentPrice }} €</h3>
                <h2 class="mt-4">Ingredienti:</h2>
                <ul class="text-left d-inline-block">
                    <li v-for="ingredient in ingredients"
                        v-bind:key="ingredient.id"
                    >
                        {{ ingredient }}
                    </li>
                </ul>
            </div>
        </section>
        <a v-on:click.prevent="handleOnclick()" href="#" class="anchor anchor-close">
            <i class="fas fa-times"></i>
        </a>
    </div>
</template>

<script>
    import discountRibbon from './discountRibbon'

    const baseUrl = window.location.protocol + "//" + window.location.host
    const colors = ['#74BDC7', '#AAD7DA', '#F099C6', '#92A7DA', '#F5EFB0']

    export default {
        props: {
            props: {
                type: Object
            }
        },
        data() {
            const { name, currentPrice, image, ingredients, standardPrice } = this.props
            return {
                name: this.capitalize(name),
                currentPrice: currentPrice,
                image: baseUrl + '/storage/' + image,
                ingredients: ingredients,
                isDiscounted: currentPrice == standardPrice,
                bgColor: {background: colors[Math.random() * 5 | 0]}
            }
        },
        methods: {
            capitalize(soneString) {
                return soneString.charAt(0).toUpperCase() + soneString.slice(1)
            },
            handleOnclick() {
                return this.$emit('fromRecipe')
            }
        },
        components: { discountRibbon }
    }
</script>

<style scoped lang="scss">
    .recipe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: calc(100vh - 60px);
        z-index: 1;

        & > * {
            flex-basis: 100%
        }

        .anchor,
        &:visited,
        &:hover {
            text-decoration: none;
        }
        .anchor-close {
            position: absolute;
            right: 25px;
            bottom: 25px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: coral;
            color: white;
            font-size: 150%;
        }

        .recipe__img-wrapper {
            display: none;
            img {
                width: 100%;
                height: 100%;
                object-fit: fill;
            }
        }


        .recipe__description {
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;

            & > * {
                flex-basis: 100%;
            }

            .recipe__description__inner {
                position: relative;
            }

            h1 {
                font-size: 200%;
            }
            ul {
                font-size: 100%;
            }
        }
    }

    @media (min-width: 768px) {
        .recipe {
            & > * {
                flex-basis: 50%
            }

            .recipe__img-wrapper {
                display: block;
            }

            .recipe__description {
                h1 {
                    font-size: 230%;
                }
                ul {
                    font-size: 120%;
                }
            }
        }
    }
</style>
