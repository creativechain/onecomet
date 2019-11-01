const EventEmitter = require('event-emitter');
const HttpClient = require('./http');

class Application extends EventEmitter {
    constructor() {
        super();
    }

    fetchPrice(currency, counterCurrency, callback) {
        let caller = new HttpClient(`/api/${currency}/${counterCurrency}`);
        if (callback) {
            caller.when('done' + caller.id, callback);
            caller.when('fail' + caller.id, callback);
        } else {
            caller.when('done' + caller.id, (response) => {
                console.log(response);
                response = JSON.parse(response);
                this.emit(`price.update`, currency, counterCurrency, response);
            })
        }
        caller.get();

    }
}

module.exports = Application;