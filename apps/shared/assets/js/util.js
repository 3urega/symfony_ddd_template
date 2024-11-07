/**
 * @param {string} html - Element to be transformed. It can contain children.
 */
export function htmlToElem(html) {
    let temp = document.createElement('template');
    html = html.trim(); // Never return a space text node as a result.
    temp.innerHTML = html;
    return temp.content.firstChild;
}

/**
 * @param {string} html - Elements to be transformed. It can contain children.
 */
export function htmlToElems(html) {
    let temp = document.createElement('template');
    temp.innerHTML = html;
    return temp.content.childNodes;
}

/**
 * @param {string} path - Call url.
 *
 * @return {Object}
 */
export function get(path) {
    return fetch(path, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include',
    }).then(res => res.json());
}

/**
 * @param {string} path - Call url.
 * @param {Object} data - Request data.
 *
 * @return {Object}
 */
export function post(path, data) {
    return fetch(path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include',
        body: JSON.stringify(data)
    }).then(res => res.json());
}

export function postFormData(path, data) {
    return fetch(path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        credentials: 'include',
        body: data
    }).then(res => res.json())
}

export function postPdfDownload(path, data, filename) {
    return fetch(path, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/pdf'
        },
        credentials: 'include',
        body: JSON.stringify(data),
        xhrFields: {
            responseType: 'blob'
        },
    }).then(response => response.blob())
    .then((response) => {
        const blob = new Blob([response], {type: 'application/octet-stream'})
        const a = document.createElement("a");
        const url = URL.createObjectURL(blob);
        a.href = url;
        a.download = filename;
        a.click();
        URL.revokeObjectURL(url);
    });
}


/**
 * @param {Element} element
 * @param {string} selector - Selector of element's sibling
 */
export function getSiblingWithClass(element, selector) {
    return element.parentNode.querySelector(selector);
}

/**
 * @param {Function} callback - Action done
 * @param {int} limit - Milliseconds
 */
export function throttle(callback, limit) {
    var waiting = false;                      // Initially, we're not waiting
    return function () {                      // We return a throttled function
        if (!waiting) {                       // If we're not waiting
            callback.apply(this, arguments);  // Execute users function
            waiting = true;                   // Prevent future invocations
            setTimeout(function () {   // After a period of time
                waiting = false;              // And allow future invocations
            }, limit);
        }
    }
}


/**
 * @param {Function} func - Action done after limit
 * @param {int} wait - Milliseconds
 * @param {boolean} immediate - Force action to take place instantaneously
 */
export function debounce(func, wait, immediate = false) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

/**
 * Removes all options of a select.
 * @param {Element} element - Select element
 */
export function emptySelect(element) {
    while(element.firstChild)
        element.removeChild(element.firstChild);
}

export function showFileNumberOnChange() {
    document.addEventListener('change', e => {
        if (e.target.classList.contains('custom-file-input')) {
            const fileInput = e.target;
            let text;
            if (fileInput.files.length === 0) {
                text = `Escoger imágenes`;
            } else if (fileInput.files.length === 1) {
                text = `${fileInput.files.length} archivo seleccionado`;
            } else {
                text = `${fileInput.files.length} archivos seleccionados`;
            }

            fileInput.nextElementSibling.textContent = text;
        }
    });
}
