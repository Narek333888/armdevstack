/**
 * Confirmation of delete actions
 * @returns {boolean}
 */
const confirmDelete = (text) => {
    return confirm(text);
}

/**
 * Pusher dynamic setup
 * @param channelName
 * @param eventName
 * @param eventHandler
 * @param pusherAppKey
 * @param dynamicText
 * @param logToConsole
 * @param cluster
 */
const setupPusher = (channelName, eventName, eventHandler, pusherAppKey, dynamicText = '', logToConsole = false, cluster = 'mt1') => {
    Pusher.logToConsole = logToConsole;

    let pusher = new Pusher(pusherAppKey, {
        cluster: cluster
    });

    let channel = pusher.subscribe(channelName);

    channel.bind(eventName, function(data) {
        eventHandler(data, dynamicText);
    });
}

/**
 * Reset form values
 * @param formSelector
 */
const resetForm = (formSelector) => {
    $(formSelector).trigger('reset');
    $(formSelector).validate().resetForm();
}

/**
 * Cancel functionality
 * @param btnSelector
 * @param formSelector
 */
const cancel = (btnSelector, formSelector) => {
    $(btnSelector).on('click', () => {
        resetForm(formSelector);
    });
}

/**
 * Tiny mce dynamic integration
 * @param fieldSelector
 * @param plugins
 * @param a11yAdvancedOptions
 * @param options
 */
const initTinyMce = (fieldSelector, plugins = [], options = {}, a11yAdvancedOptions = false) => {
    let pluginsResult = [];

    if (plugins.length > 0) {
        pluginsResult = plugins;
    } else {
        pluginsResult = [
            'advlist',
            'lists',
            'image',
            'media',
            'table',
            'code',
            'searchreplace',
            'lists',
            'accordion',
            'visualblocks',
            'anchor',
            'link',
            'charmap',
            'pagebreak',
            'visualchars',
            'emoticons',
            'insertdatetime',
            'autolink',
            'autosave',
            'quickbars',
            'wordcount',
        ];
    }

    if (typeof tinymce !== 'undefined') {
        const defaultOptions = {
            selector: fieldSelector,
            plugins: pluginsResult.join(' '),
            a11y_advanced_options: a11yAdvancedOptions,
        };

        const finalOptions = { ...defaultOptions, ...options };

        tinymce.init(finalOptions);
    }
};

/**
 * Delete multiple items
 * @param route
 * @param clickableItemSelector
 * @param checkBoxSelector
 * @param messages
 */
const deleteMultiple = (route, clickableItemSelector, checkBoxSelector, messages) => {
    $(clickableItemSelector).on('click', function () {
        let selectedItems = [];

        $(checkBoxSelector + ':checked').each(function () {
            selectedItems.push($(this).val());
        });

        if (selectedItems.length > 0) {
            if (confirm(messages.confirm)) {
                axios.delete(route, {
                    data: {
                        ids: selectedItems,
                    }
                }).then(function (response) {
                    if(response.data.status === 'success') {
                        toastr.info(messages.success);

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                }).catch(function (error) {
                    toastr.error(messages.error);
                });
            }
        }  else {
            toastr.error(messages.pleaseSelectAtLeastOne);
        }
    });
}

/**
 * Move to trash multiple items
 * @param route
 * @param clickableItemSelector
 * @param checkBoxSelector
 * @param messages
 */
const softDeleteMultiple = (route, clickableItemSelector, checkBoxSelector, messages) => {
    $(clickableItemSelector).on('click', function () {
        let selectedItems = [];

        $(checkBoxSelector + ':checked').each(function () {
            selectedItems.push($(this).val());
        });

        if (selectedItems.length > 0) {
            if (confirm(messages.confirm)) {
                axios.delete(route, {
                    data: {
                        ids: selectedItems,
                    }
                }).then(function (response) {
                    if(response.data.status === 'success') {
                        toastr.info(messages.success);

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                }).catch(function (error) {
                    toastr.error(messages.error);
                });
            }
        }  else {
            toastr.error(messages.pleaseSelectAtLeastOne);
        }
    });
}

/**
 * Delete all items
 * @param route
 * @param clickableItemSelector
 * @param messages
 */
const deleteAll = (route, clickableItemSelector, messages) => {
    $(clickableItemSelector).on('click', function () {
        if (confirm(messages.confirm)) {
            axios.delete(route, {})
                .then(function (response) {
                if(response.data.status === 'success') {
                    toastr.info(messages.success);

                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            }).catch(function (error) {
                toastr.error(messages.error);
            });
        }
    });
}

/**
 * Move to trash all items
 * @param route
 * @param clickableItemSelector
 * @param messages
 */
const softDeleteAll = (route, clickableItemSelector, messages) => {
    $(clickableItemSelector).on('click', function () {
        if (confirm(messages.confirm)) {
            axios.delete(route, {})
                .then(function (response) {
                    if(response.data.status === 'success') {
                        toastr.info(messages.success);

                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    }
                }).catch(function (error) {
                toastr.error(messages.error);
            });
        }
    });
}

/**
 * Select all items
 * @param selectAllCheckboxSelector
 * @param checkboxesSelector
 */
const selectAll = (selectAllCheckboxSelector, checkboxesSelector) => {
    $(selectAllCheckboxSelector).on('change', function() {
        const isChecked = $(this).prop('checked');

        $(checkboxesSelector).each(function() {
            $(this).prop('checked', isChecked);
        });
    });
}

/**
 * Initialise select2
 * @param elementSelector
 * @param options
 */
const initSelect2 = (elementSelector, options = {}) => {
    $(elementSelector).select2(options);
}

/**
 * Init active tabs
 * @param tabSelector
 * @param contentSelector
 */
const initActiveTabs = (tabSelector, contentSelector) => {
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll(tabSelector);
        const tabContents = document.querySelectorAll(contentSelector);

        tabs.forEach(function (tab, index) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) {
                    t.classList.remove('active');
                });

                tab.classList.add('active');

                if (index >= 0 && index < tabContents.length) {
                    tabContents.forEach(function (content) {
                        content.classList.remove('show', 'active');
                    });

                    tabContents[index].classList.add('show', 'active');
                }
            });
        });

        const errors = document.querySelectorAll('.is-invalid');

        if (errors.length > 0) {
            const errorTab = errors[0].closest(contentSelector);

            if (errorTab) {
                const tabIndex = Array.from(tabContents).indexOf(errorTab);

                if (tabIndex >= 0 && tabIndex < tabContents.length) {
                    tabs.forEach(function (tab) {
                        tab.classList.remove('active');
                    });

                    tabContents.forEach(function (content) {
                        content.classList.remove('show', 'active');
                    });

                    tabs[tabIndex].classList.add('active');
                    tabContents[tabIndex].classList.add('show', 'active');
                }
            }
        }
    });
}

// Weather forecast widget
/**
 * Update weather data values
 * @param data
 * @param mappings
 */
const updateWeatherData = (data, mappings) => {
    for (let key in mappings) {
        if (mappings.hasOwnProperty(key) && data[key] !== undefined) {
            let element = $(mappings[key].selector);

            if (mappings[key].type === 'text') {
                element.text(data[key]);
            }

            if (mappings[key].type === 'attribute') {
                element.attr(mappings[key].attribute, data[key]);
            }
        }
    }
}

/**
 * Set default query string param
 * @param key
 * @param value
 */
const setDefaultQueryParam = (key, value) => {
    let url = new URL(window.location.href);

    if (!url.searchParams.has(key)) {
        url.searchParams.set(key, value);
        history.replaceState(null, '', url.toString());
    }
}

/**
 * Update query string param
 * @param key
 * @param value
 */
const updateQueryStringParam = (key, value) => {
    let url = new URL(window.location.href);

    if (value) {
        url.searchParams.set(key, value);
    } else {
        url.searchParams.delete(key);
    }

    history.replaceState(null, '', url.toString());
}

/**
 * Add query param
 * @param key
 */
const getQueryParam = (key) => {
    let url = new URL(window.location.href);

    return url.searchParams.get(key);
}

/**
 * Add query string param
 * @param key
 * @param value
 */
const addQueryParam = (key, value) => {
    let url = new URL(window.location.href);

    if (value) {
        url.searchParams.append(key, value);
    }

    history.replaceState(null, '', url.toString());
}

/**
 * Attach event to element
 * @param eventType
 * @param selector
 * @param callback
 */
const attachEvent = (eventType, selector, callback) => {
    $(document).on(eventType, selector, function(event) {
        callback($(this), event);
    });
}

/**
 * Clear weather cache
 * @param url
 */
const clearWeatherCache = (url) => {
    axios.get(url).then(() => {
        console.log('Cache Cleared');
    }).catch((error) => {
        console.log(error);
    });
}

/**
 * Handle radio change.
 * @param radioName
 * @param callback
 */
const handleRadioChange = (radioName, callback) => {
    $('input[name="' + radioName + '"]').on('change', function() {
        if ($(this).is(':checked')) {
            callback($(this).val());
        }
    });
}

/**
 * Fetch weather api data
 * @param url
 * @param method
 * @param formSelector
 * @param cityNameSelector
 * @param unitOfMeasurementRadioNameSelector
 * @param responseMappings
 */
const fetchWeatherApiData = (url, method, formSelector, cityNameSelector, unitOfMeasurementRadioNameSelector, responseMappings) => {
    setDefaultQueryParam('unitOfMeasurement', 'celsius');

    $(formSelector).on('submit', function(event) {
        event.preventDefault();

        let city = $(`input[name="${cityNameSelector}"]`).val();
        let unitOfMeasurement = $(`input[name="${unitOfMeasurementRadioNameSelector}"]:checked`).val();

        axios.get(url, {
            params: {
                city: city,
                unitOfMeasurement: unitOfMeasurement,
            }
        }).then(function(response) {
            updateWeatherData(response.data, responseMappings);
        }).catch(function(error) {
            console.error('Error:', error);
        });
    });
}

/**
 * Handle Payment Form
 * @param options
 */
const handlePaymentForm = (options) => {
    const { stripeKey, formSelector, paymentMethodSelector, nameInputSelector, methods } = options;

    const stripe = stripeKey ? Stripe(stripeKey) : null;
    let cardElement = null;

    if (stripe) {
        const elements = stripe.elements();
        cardElement = elements.create('card');
        cardElement.mount(methods.stripe.fields.cardElementSelector);
    }

    $(formSelector).on('submit', async function (event) {
        const selectedMethod = $(paymentMethodSelector + ':checked').val();

        if (methods[selectedMethod] && methods[selectedMethod].handleSubmit) {
            event.preventDefault();

            const billingDetails = {
                name: $(nameInputSelector).val(),
            };

            const result = await methods[selectedMethod].handleSubmit({
                stripe,
                cardElement,
                billingDetails,
                formSelector
            });

            if (result.error) {
                console.error(result.error);
            } else if (result.success) {
                $(formSelector).off('submit').submit();
            }
        }
    });

    $(paymentMethodSelector).on('change', function () {
        const selectedMethod = $(this).val();
        updateQueryStringParam('paymentMethod', selectedMethod);

        Object.keys(methods).forEach((method) => {
            if (method === selectedMethod) {
                $(methods[method].fields.selector).removeClass('d-none');
            } else {
                $(methods[method].fields.selector).addClass('d-none');
            }
        });
    });
};

// ======================functions call======================

$(document).ready(() => {

});
