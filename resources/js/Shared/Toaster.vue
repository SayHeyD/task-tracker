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
    mounted() {
        if (this.flash.success) {
            this.fireSuccessToast(this.flash.success)
        }

        if (this.errors) {
            for (let propName in this.errors) {
                if (this.errors.hasOwnProperty(propName)) {
                    this.fireErrorToast(this.errors, propName)
                }
            }
        }
    },
    methods: {
        fireSuccessToast(message) {
            this.$toast.success(message, {
                timeout: this.successDelay
            })
            this.$page.props.flash.success = null
        },
        fireErrorToast(errors, propName) {
            this.$toast.error(errors[propName], {
                timeout: this.errorDelay
            })
            this.$page.props.errors[propName] = null
        }
    },
    watch: {
        'flash.success': function(val) {
            if (val) {
                this.fireSuccessToast(val)
            }
        },
        errors: {
            deep: true,
            handler: function(val) {

                for (let propName in val) {
                    if (val.hasOwnProperty(propName)) {
                        this.fireErrorToast(val, propName)
                    }
                }
            },
        }
    }
}
</script>