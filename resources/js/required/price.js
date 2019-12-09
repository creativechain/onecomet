
//{"currency":"CREA","precision":3,"counter_currency":"EUR","counter_precision":"8","price":2783144,"updated_at":"2019-11-08 08:10:15"}
class Price {
    constructor(data) {
        this.currency = data.currency;
        this.precision = data.precision;
        this.counter_currency = data.counter_currency;
        this.counter_precision = data.counter_precision;
        this.price = data.price;
        this.updated_at = data.updated_at;
    }

    tokenToFiat(amount) {
        return amount * (this.price / Math.pow(10, this.counter_precision));
    }

    fiatToToken(amount) {
        return (amount * (1 / (this.price / Math.pow(10, this.counter_precision)))).toFixed(this.precision);
    }
}

module.exports = Price;