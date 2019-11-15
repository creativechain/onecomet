const EventEmitter = require('events');
const HttpClient = require('./http');
const Price = require('./price');

class Application extends EventEmitter{
    constructor() {
        super();
        this._interval = null;
    }

    fetchPrice(currency, counterCurrency, callback) {
        let that = this;
        if (this._interval) {
            clearInterval(this._interval);
        }

        this._interval = setInterval(function () {

            let caller = new HttpClient(`/api/price/${currency}/${counterCurrency}`);
            if (callback) {
                caller.when('done', callback);
                caller.when('fail', callback);
            } else {
                caller.when('done', (response) => {
                    try {
                        response = JSON.parse(response);
                        let price = new Price(response);
                        that.emit("price.update", currency, counterCurrency, price);
                    } catch (e) {
                        console.error(e);
                    }

                })
            }
            caller.get();

        }, 5 * 1000);


    }
}

module.exports = {
    Application
};