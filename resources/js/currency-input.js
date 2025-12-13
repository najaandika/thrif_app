window.currencyInput = function (initialValue, modelName) {
    return {
        displayValue: initialValue ? new Intl.NumberFormat('id-ID').format(initialValue) : '',

        update(e) {
            // Remove non-digit characters
            let value = e.target.value.replace(/\D/g, '');

            // Updates Livewire model
            this.$wire.set(modelName, value);

            // Format display value with dots
            this.displayValue = value ? new Intl.NumberFormat('id-ID').format(value) : '';
        }
    };
}
