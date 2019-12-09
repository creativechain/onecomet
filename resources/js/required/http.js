/**
 * Created by ander on 11/10/18.
 */

const EventEmitter = require('events');
const Utils = require('./utils');

class HttpClient extends EventEmitter {
    constructor(url) {
        super();
        this.id = Utils.randomNumber(0, Number.MAX_SAFE_INTEGER);
        this.url = url;
        this.params = null;
        this.method = null;
        this.headers = {};
        this.mimeType = 'multipart/form-data';
        this.contentType = false;
        this.xhr = null;
    }

    /**
     *
     * @private
     */
    __exec() {
        let that = this;

        let settings = {
            url: this.url,
            method: this.method,
            headers: this.headers,
            mimeType: this.mimeType,
            contentType: this.contentType,
            crossDomain: true,
            processData: false
        };

        if (this.params) {
            if (this.method === 'GET') {
                settings.processData = true;
                settings.data = this.params;
            } else {
                let form = new FormData();
                let keys = Object.keys(this.params);

                keys.forEach(function (k) {
                    form.append(k, that.params[k]);
                });
                settings.data = form;
            }
        }

        this.xhr = $.ajax(settings)
            .done(function (data, textStatus, jqXHR) {
                that.emit('done', data, textStatus, jqXHR);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                that.emit('fail', jqXHR, textStatus, errorThrown);
            })
            .always(function (data, textStatus, jqXHR) {
                that.emit('always', data, textStatus, jqXHR);
            })
    }

    /**
     *
     * @param {string} event
     * @param {function} callback
     * @returns {HttpClient}
     */
    when(event, callback) {
        this.on(event, callback);
        return this;
    }

    /**
     *
     * @param headers
     * @returns {HttpClient}
     */
    setHeaders(headers) {
        this.headers = headers;
        return this;
    }

    /**
     *
     * @param params
     * @returns {HttpClient}
     */
    post(params) {

        this.params = params;
        this.method = 'POST';
        this.__exec();

        return this;
    }

    /**
     *
     * @param params
     * @returns {HttpClient}
     */
    get(params) {
        this.params = params;
        this.method = 'GET';
        this.__exec();

        return this;
    }

    abort() {
        if (this.xhr) {
            this.xhr.abort();
        }
    }
}

module.exports = HttpClient;