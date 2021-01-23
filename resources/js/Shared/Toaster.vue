<template>

</template>

<script>
export default {
    props: {
        flash: Object,
        errors: Object,
        successDelay: {
            Type: Number,
            Default: 5000,
        },
        errorDelay: {
            Type: Number,
            Default: 5000,
        }
    },
    watch: {
        'flash.success': function(val) {
            if (val) {
                this.$toast.success(val, {
                    timeout: this.successDelay
                })
                this.$page.props.flash.success = null
            }
        },
        errors: {
            deep: true,
            handler: function(val) {

                for (let propName in val) {
                    if (val.hasOwnProperty(propName)) {
                        this.$toast.error(val[propName], {
                            timeout: this.errorDelay
                        })
                    }
                }
            },
        }
    }
}
</script>