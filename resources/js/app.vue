<template>
    <div class="page container">
        <jumbotron></jumbotron>
        <cardsContainer></cardsContainer>
    </div>
</template>

<script>
    import jumbotron from './components/jumbotron'
    import cardsContainer from './components/cardsContainer'

    export default {
        components: { jumbotron, cardsContainer }
    }
</script>

<style lang="scss" scoped>
    html {
    scroll-behavior: smooth;
    }
</style>
