<template>
    <div class="recipe d-flex">
        <div class="recipe__img-wrapper">
            <img :src="storageUrl + cakeType.image" :alt="cakeType.name">
        </div>
        <section class="recipe__description p-5 d-flex text-center">
            <div>
                <h1>{{ capitalize(cakeType.name) }}</h1>
                <h3> {{ cakeType.currentPrice }} €</h3>
                <h2 class="mt-4">Ingredienti:</h2>
                <ul class="text-left d-inline-block">
                    <li v-for="ingredient in cakeType.ingredients"
                        v-bind:key="ingredient.id"
                    >
                        {{ ingredient }}
                    </li>
                </ul>
                <a href="" v-on:click="closeRecipe()">Torna indietro</a>
            </div>
        </section>
    </div>
</template>

<script>
    const baseUrl = window.location.protocol + "//" + window.location.host

    export default {
        props: {
            props: {
                type: Object
            }
        },
        data() {
            return {
                storageUrl: baseUrl + '/storage/',
                cakeType: this.props
            }
        },
        methods: {
            capitalize(soneString) {
                return soneString.charAt(0).toUpperCase() + soneString.slice(1)
            },
            closeRecipe() {
                return this.$emit('fromRecipe')
            }
        }
    }
</script>

<style scoped lang="scss">
    .recipe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: calc(100vh - 55px);
        background: cadetblue;

        & > * {
            flex-basis: 100%
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
                    font-size: 250%;
                }
                ul {
                    font-size: 150%;
                }
            }
        }
    }
</style>
