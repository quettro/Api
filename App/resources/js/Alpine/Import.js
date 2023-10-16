export default (all) => ({
    /**
     *
     */
    _all: all,

    /**
     *
     */
    _created: 0,

    /**
     *
     */
    _updated: 0,

    /**
     *
     */
    _importButtonIsBlocked: false,

    /**
     *
     */
    importButton: {
        /**
         *
         * @returns {boolean|*}
         */
        ':disabled': function () {
            return this._importButtonIsBlocked;
        },

        /**
         *
         * @returns {Promise<void>}
         */
        '@click.stop.prevent': async function () {
            this._importButtonIsBlocked = true;

            try {
                let _response = (await window.axios.post('/import')).data;

                if (_response) {
                    this._all = _response['all'];
                    this._created = _response['created'];
                    this._updated = _response['updated'];
                }

                this._importButtonIsBlocked = false;
            }
            catch (exception) {
                this._importButtonIsBlocked = false;

                if (exception?.response?.data?.message)
                    return alert(`[ ${exception.code} ] ${exception.response.data.message}`);

                return alert(`[ ${exception.code ?? exception.name} ] ${exception.message}`);
            }
        },
    },
});
