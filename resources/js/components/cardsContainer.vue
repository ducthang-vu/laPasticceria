<template>
    <div class="cardsContainer" id="cardsContainer">
        <h2 class="title d-flex mb-4"><span>Le nostre proposte</span></h2>
        <div class="cardswrapper row" v-if="cakeTypes">
            <div class="cakeType-card col-md-6" v-for="cakeType in cakeTypes"
                v-bind:key="cakeType.id"
                v-on:click='fromCard(cakeType.name)'
            >
                <img :src="storageUrl + cakeType.image" :alt="cakeType.name">
                <div class="layover text-center">
                    <div>
                        <h3 class="layover__cakeName">{{ capitalize(cakeType.name) }}</h3>
                        <p class="layover__price">{{ cakeType.currentPrice }} €</p>
                    </div>
                </div>
                <discountRibbon v-if="isDiscounted(cakeType.name)" ></discountRibbon>
            </div>
        </div>
    </div>
</template>

<script>
    import discountRibbon from './discountRibbon'

    const baseUrl = window.location.protocol + "//" + window.location.host
    const apiUrl = baseUrl + '/api/cake_type'

export default {
        data() {
            return {
                storageUrl: baseUrl + '/storage/',
                cakeTypes: null,
                discountedList: null
            }
        },
        methods: {
            capitalize(soneString) {
                return soneString.charAt(0).toUpperCase() + soneString.slice(1)
            },
            fromCard(name) {
                const data =  this.cakeTypes.filter($item => $item.name == name)[0]
                return this.$emit('fromCard', {'cakeType': data})
            },
            getDiscountedList() {
                return this.cakeTypes
                        .filter($item => $item.standardPrice != $item.currentPrice)
                        .map($item => $item.name)
            },
            isDiscounted(name) {
                return this.discountedList.includes(name)
            }
        },
        mounted() {
            axios.get(apiUrl)
                .then((response) => {
                    this.cakeTypes = response.data.data
                    this.discountedList = this.getDiscountedList()
                })
                .catch(function (e) {
                    console.log(e);
                });
        },
        components: { discountRibbon }
    };
</script>

<style scoped lang="scss">
    .cardsContainer {
        padding-top: 50px;

        .title {
            justify-content: center;
            align-items: center;
            height: 100px;
            font-size: bold;
            font-size: 200%;
        }
        .cardswrapper {
            justify-content: center;

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
        }
    }

    @media (min-width: 768px) {
        .cardsContainer {
            .title {
                font-size: 200%;
            }
            .cardswrapper {
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
        }
    }
</style>
