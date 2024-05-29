<template>
    <div class="w-5 h-5" :class="{'w-6 h-6': !isExpanded}">
        <svg xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 20 21"
             :height="height"
             :width="width"
             :aria-labelledby="iconName"
             role="presentation"
        >
            <title
                :id="iconName"
                lang="en"
            >{{ iconName }} icon</title>
            <g :fill="iconColor">
                <slot :color="iconColor"/>
            </g>
        </svg>
    </div>
</template>

<script>
export default {
    props: {
        iconName: {
            type: String,
            default: 'box'
        },
        width: {
            type: [Number, String],
            default: 20
        },
        height: {
            type: [Number, String],
            default: 20
        },
        iconColor: {
            type: String,
            default: 'currentColor'
        },
        isExpanded: {
            type: Boolean,
            default: false
        }
    },
}
</script>
<style scoped>

</style>
