<template>
  <div class="w-full flex flex-col justify-center">
    <div class="flex w-full justify-between">
      <jet-label :id="id" v-text="label"></jet-label>
      <jet-input-error :message="errorMessage"></jet-input-error>
    </div>
    <div class="w-full flex justify-center">
      <input :id="id" ref="flatpickr" class="hidden" :value="value"/>
    </div>
  </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";

import flatpickr from "flatpickr";

export default {
    props: ['id', 'value', 'label', 'name', 'errorMessage', 'submitting'],
    components: {
        JetLabel,
        JetInputError,
    },
    data() {
        return {
            pickr: null,
            options: {
                inline: true,
                dateFormat: 'Y-m-d H:i:s',
                enableTime: true,
                time_24hr: true,
            },
            enter: new KeyboardEvent('keydown', {
                key : "Enter"
            })
        }
    },
    mounted() {
        this.date = this.value

        this.pickr = flatpickr(this.$refs.flatpickr, this.options);
        this.pickr.config.onChange.push(this.emitInput);
    },
    methods: {
        emitInput(val) {
            let date = new Date(val[0])
            let month = date.getMonth() + 1
            let hour = date.getHours()
            let day = date.getDate()
            let minute = date.getMinutes()

            if (minute.toString().length === 1) {
                minute = '0' + minute.toString()
            }

            if (day.toString().length === 1) {
                day = '0' + day.toString()
            }

            if (hour.toString().length === 1) {
                hour = '0' + hour.toString()
            }

            if (month.toString().length === 1) {
                month = '0' + month.toString()
            }

            this.$emit('input', date.getFullYear() + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':00')
        }
    },
    watch: {
        submitting(val) {
            if (val === true) {
                console.log('YAY')
                this.pickr._input.dispatchEvent(this.enter)
            }
        }
    }
}
</script>

<style scoped>
@import "../../../css/flatpickr_blue.css";
</style>