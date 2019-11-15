<template>
    <div class="dropdown">
        <button v-html="selectionHtml" class="form-control dropdown-toggle button-select-payment" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--
            <img src="{{URL::asset('img/select/card/visa.png')}}" alt="coin crea"> <span>Tarjeta crédito / débito</span>
-->
        </button>
        <div class="dropdown-menu dropdown-card" aria-labelledby="dropdownMenuButton">
            <div v-if="pm.includes('card')" @click="selectPm('card', $event)" class="dropdown-item pointer">
                <img src="/img/select/card/visa.png" alt="Coin crea"> Tarjeta crédito / débito
            </div>
            <div v-if="pm.includes('gpay')" @click="selectPm('gpay', $event)" class="dropdown-item pointer">
                <img src="/img/select/card/g-pay.png" alt="Coin cgy"> Google Pay
            </div>
            <div v-if="pm.includes('apay')" @click="selectPm('apay', $event)" class="dropdown-item pointer">
                <img src="/img/select/card/apple-pay.png" alt="Coin cbd"> Apple Pay
            </div>
        </div>
        <input type="hidden" v-bind:value="selectedPm" name="payment_method">

    </div>
</template>

<script>
    export default {
        name: "PMSelector",
        props: ['pm'],
        data: function() {
            return {
                selectedPm: 'card',
                selectionHtml: ' <img src="/img/select/card/visa.png" alt="Coin crea"> Tarjeta crédito / débito'
            }
        },
        methods: {
            selectPm: function (pm, event) {
                console.log(pm, event.target);
                this.selectedPm = pm;
                this.selectionHtml = event.target.innerHTML;
                this.$emit('pmchange', pm);
            }
        }
    }
</script>