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

// ======================functions call======================

$(document).ready(() => {

});
