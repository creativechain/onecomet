<template>
    <div class="dropdown">
        <button class="form-control dropdown-toggle button-select-payment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div >
                <img src="/img/select/card/visa.png" alt="Coin crea"> {{ pm }}
            </div>
<!--            <div v-if="selectedPm === 'card'" >
                <img src="/img/select/card/visa.png" alt="Coin crea"> {{ pm }}
            </div>-->
           <!-- <div v-else-if="selectedPm === 'gpay'" >
                <img src="/img/select/card/g-pay.png" alt="Coin cgy"> {{ pm['gpay'] }}
            </div>
            <div v-else-if="selectedPm === 'apay'" >
                <img src="/img/select/card/apple-pay.png" alt="Coin cbd"> {{ pm['apay'] }}
            </div>-->
        </button>
        <!--<div class="dropdown-menu dropdown-card" aria-labelledby="dropdownMenuButton">
            <div v-if="this.pmk.includes('card')" @click="selectPm('card', pm['card'], $event)" class="dropdown-item pointer">
                <img src="/img/select/card/visa.png" alt="Coin crea"> {{ pm['card'] }}
            </div>
            <div v-if="this.pmk.includes('gpay')" @click="selectPm('gpay', this.pm['gpay'], $event)" class="dropdown-item pointer">
                <img src="/img/select/card/g-pay.png" alt="Coin cgy"> {{ pm['gpay'] }}
            </div>
            <div v-if="this.pmk.includes('apay')" @click="selectPm('apay', this.pm['apay'], $event)" class="dropdown-item pointer">
                <img src="/img/select/card/apple-pay.png" alt="Coin cbd"> {{ pm['apay'] }}
            </div>
        </div>-->
        <input type="hidden" v-bind:value="selectedPm" name="payment_method">

    </div>
</template>

<script>
    export default {
        name: "PMSelector",
        props: ['pm'],
        data: function() {
            return {
                pmk: [] /*Object.keys(this.pm)*/,
                selectedPm:  "" /*Object.keys(this.pm)[0]*/,
            }
        },
        updated: function() {
            this.selectPm(this.selectedPm, this.pm[this.selectedPm])
        },
        methods: {
            selectPm: function (pmi, trans, event) {
                this.selectedPm = pmi;
                //this.$emit('pmchange', pmi, this.pm[pmi]);
            }
        }
    }
</script>