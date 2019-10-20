<template>
    <div class="text-center">
        <font-awesome-icon class="text-red" id="loading-baseball" icon="baseball-ball" size="4x" />
        <p class="mt-3">mound visit in progress ...</p>
    </div>
</template>

<script>
export default {
}
</script>

<style>

#loading-baseball {
    animation-name: spin;
    animation-duration: 5000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}

</style>