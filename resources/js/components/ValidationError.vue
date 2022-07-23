<template>
    <small class="text-danger">{{ message }}</small>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            default: ''
        }
    }
}
</script>
