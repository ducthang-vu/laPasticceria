<template>
    <div class="jumbotron" :style="{ 'background-image': 'url(' + image + ')' }">
        <h1 class="display-4">Lasciati deliziare!</h1>
        <p class="lead"></p>
        <h2 class="sub-title">Laura e Maria ti danno il benvenuto alla loro pasticceria.</h2>
        <p class="lead mt-3">
            <a class="btn btn-primary btn-lg" :href="currentUrl" role="button">Esplora</a>
        </p>
    </div>
</template>

<script>
    const baseUrl = window.location.protocol + "//" + window.location.host

    export default {
        data() {
            return {
                image: baseUrl + '/storage/imagesSeeding/jumbotron.jpg',
                currentUrl: baseUrl + '/#cardsContainer'
            }
        }
    }
</script>

<style scoped lang="scss">
    .jumbotron {
        height: calc(100vh - 65px);
        background-size: cover;

        .sub-title{
            display: inline-block;
            max-width: 50%;
        }
    }
</style>
