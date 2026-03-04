/**
 * Initialize Select2 for Categories with AJAX pagination
 */
function initCategorySelect2(selector, options = {}) {
    const defaults = {
        ajax: {
            url: '/api/categories/search',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term,
                    page: params.page || 1
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        },
        placeholder: options.placeholder || 'Select Category',
        allowClear: options.allowClear !== false,
        minimumInputLength: 0,
        language: {
            inputTooShort: function () {
                return 'Start typing to search...';
            },
            searching: function () {
                return 'Searching...';
            },
            noResults: function () {
                return 'No categories found';
            }
        }
    };

    const $select = $(selector).select2($.extend({}, defaults, options));
    
    // Load initial value if exists
    const initialValue = $(selector).data('initial-value');
    const initialText = $(selector).data('initial-text');
    
    if (initialValue && initialText) {
        const option = new Option(initialText, initialValue, true, true);
        $(selector).append(option).trigger('change');
    }
    
    return $select;
}

/**
 * Initialize Select2 for SubCategories with AJAX pagination
 */
function initSubCategorySelect2(selector, categorySelector, options = {}) {
    const defaults = {
        ajax: {
            url: '/api/subcategories/search',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                const categoryId = $(categorySelector).val();
                return {
                    q: params.term,
                    page: params.page || 1,
                    category_id: categoryId
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: data.results,
                    pagination: {
                        more: data.pagination.more
                    }
                };
            },
            cache: true
        },
        placeholder: options.placeholder || 'Select SubCategory',
        allowClear: options.allowClear !== false,
        minimumInputLength: 0,
        disabled: !$(categorySelector).val(),
        language: {
            inputTooShort: function () {
                return 'Start typing to search...';
            },
            searching: function () {
                return 'Searching...';
            },
            noResults: function () {
                return 'No subcategories found';
            }
        }
    };

    const $subCategorySelect = $(selector).select2($.extend({}, defaults, options));

    // Load initial value if exists
    const initialValue = $(selector).data('initial-value');
    const initialText = $(selector).data('initial-text');
    
    if (initialValue && initialText) {
        const option = new Option(initialText, initialValue, true, true);
        $(selector).append(option).trigger('change');
    }

    // Enable/disable subcategory based on category selection
    $(categorySelector).on('change', function() {
        const categoryId = $(this).val();
        
        if (categoryId) {
            $subCategorySelect.prop('disabled', false);
            // Clear selection when category changes (unless it's initial load)
            if (!$(selector).data('initial-load')) {
                $subCategorySelect.val(null).trigger('change');
            }
            $(selector).data('initial-load', false);
        } else {
            $subCategorySelect.prop('disabled', true);
            $subCategorySelect.val(null).trigger('change');
        }
    });

    return $subCategorySelect;
}

/**
 * Load initial value for Select2 from server by ID
 */
function loadSelect2InitialValue(selector, id, apiUrl) {
    if (!id) return;
    
    $.ajax({
        url: apiUrl,
        type: 'GET',
        dataType: 'json',
        data: { id: id },
        success: function(data) {
            if (data && data.id && data.text) {
                const option = new Option(data.text, data.id, true, true);
                $(selector).append(option).trigger('change');
            }
        }
    });
}



/**
 * Set initial value for Select2 (useful for edit forms when you have both id and text)
 */
function setSelect2Value(selector, id, text) {
    if (id && text) {
        const option = new Option(text, id, true, true);
        $(selector).append(option).trigger('change');
    }
}
