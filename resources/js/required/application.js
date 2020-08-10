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

        let callFunc = function () {

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

        };

        this._interval = setInterval(callFunc, 5 * 1000);

        callFunc();

    }
}

module.exports = {
    Application
};
