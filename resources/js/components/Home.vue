<template>
    <div class="container">
        <h1 class="text-3xl"> {{ showTitle }}</h1>
    </div>
</template>

<script>
    export default {
        computed: {
            showTitle () {
                return this.$store.getters.showTitle
            }
        }
    }
</script>