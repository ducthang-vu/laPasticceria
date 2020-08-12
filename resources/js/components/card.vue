<template>
    <div v-on:click="handleOnClick()" class="cakeType-card col-md-6">
        <img :src="image" :alt="name">
        <div class="layover text-center">
            <div>
                <h3 class="layover__cakeName">{{ name }}</h3>
                <p class="layover__price">{{ currentPrice }}</p>
            </div>
        </div>
        <discountRibbon v-if="isDiscounted" ></discountRibbon>
    </div>
</template>

<script>
    import discountRibbon from './discountRibbon'

    const baseUrl = window.location.protocol + "//" + window.location.host
    const apiUrl = baseUrl + '/api/cake_type'

export default {
        props: {
            props: {
                type: Object
            }
        },
        data() {
            const { name, currentPrice, quantity, standardPrice, image } = this.props
            return {
                name: this.capitalize(name),
                currentPrice: this.getPriceString(quantity, currentPrice),
                image: baseUrl + '/storage/' + image,
                isDiscounted: quantity && currentPrice != standardPrice
            }
        },
        methods: {
            capitalize(soneString) {
                return soneString.charAt(0).toUpperCase() + soneString.slice(1)
            },
            getPriceString(quantity, price) {
                return quantity ? price + ' €' : 'Scorte esaurite'
            },
            handleOnClick() {
                return this.$emit('fromCard', {'cakeType': this.getDataforRecipe()})
            },
            getDataforRecipe() {
                return {
                    name: this.name,
                    currentPrice: this.currentPrice,
                    image: this.image,
                    ingredients: this.props.ingredients,
                    quantity: this.props.quantity
                }
            }
        },
        components: { discountRibbon }
    };
</script>

<style scoped lang="scss">
    .cakeType-card {
        position: relative;
        height: calc(100vh - 55px);
        padding: 5px;
        cursor: pointer;
        overflow: hidden;

        img {
            width: 100%;
            height: 100%;
            object-fit: fill;
        }

        .layover {
            display: none;
        }

        &:hover {
            img {
                opacity: 0.2;
                transition: opacity 0.8s;
            };

            &:hover > .layover {
                position: absolute;
                left: 0%;
                top: 0;
                width: 100%;
                height: 100%;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;

                & > * {
                    flex-basis: 100%;
                }

                .layover__cakeName {
                    font-size: 300%;
                }

                .layover__price {
                    font-size: 200%;
                }
            }
        }
    }

    @media (min-width: 768px) {
        .cakeType-card {
            &:hover {
                &:hover > .layover {
                    .layover__cakeName {
                        font-size: 350%;
                    }

                    .layover__price {
                        font-size: 250%;
                    }
                }
            }
        }
    }
</style>
