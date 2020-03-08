<template>
    <div class="dropdown">
        <button v-html="selectionHtml" class="form-control dropdown-toggle button-select-payment" type="button" id="dropDownMenuToken" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<!--
            <img src="{{URL::asset('img/select/card/visa.png')}}" alt="coin crea"> <span>Tarjeta crédito / débito</span>
-->
        </button>
        <div class="dropdown-menu dropdown-card" aria-labelledby="dropDownMenuToken">
            <div v-if="at.includes('crea')" @click="selectToken('crea', $event)" class="dropdown-item pointer">
                <img src="/img/select/coins/crea.png" alt="Coin crea"> CREA
            </div>
            <div v-if="at.includes('cgy')" @click="selectToken('cgy', $event)" class="dropdown-item pointer">
                <img src="/img/select/coins/cgy.png" alt="Coin cgy"> CREA Energy
            </div>
            <div v-if="at.includes('cbd')" @click="selectToken('cbd', $event)" class="dropdown-item pointer">
                <img src="/img/select/coins/cbd.png" alt="Coin cbd"> CBD
            </div>
        </div>
        <input type="hidden" v-bind:value="selectedToken" name="token">

    </div>
</template>

<script>
    export default {
        name: "TokenSelector",
        props: ['at'],
        data: function() {
            return {
                selectedToken: 'crea',
                selectionHtml: ' <img src="/img/select/coins/cgy.png" alt="Coin crea"> CREA Energy'
            }
        },
        methods: {
            selectToken: function (at, event) {
                console.log(at, event.target);
                this.selectedToken = at;
                this.selectionHtml = event.target.innerHTML;
                this.$emit('tokenchange', at);

            }
        }
    }
</script>
