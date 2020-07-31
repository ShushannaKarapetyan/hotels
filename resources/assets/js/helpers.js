function randomString(length = 10) {
    const chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    let result = '';
    // eslint-disable-next-line no-plusplus
    for (let i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];

    return result;
};

function numberFormat(number, decimals, decPoint, thousandsSep) {
    const num = (`${number}`).replace(/[^0-9+\-Ee.]/g, '');
    const n = !Number.isFinite(+num) ? 0 : +num;
    const precision = !Number.isFinite(+decimals) ? 0 : Math.abs(decimals);
    const separator = (typeof thousandsSep === 'undefined') ? ',' : thousandsSep;
    const dec = (typeof decPoint === 'undefined') ? '.' : decPoint;
    let formattedNumber = '';
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    if (precision) {
        const k = 10 ** precision;
        formattedNumber = `${(Math.round(n * k) / k).toFixed(precision)}`;
    } else {
        formattedNumber = `${Math.round(n)}`;
    }

    formattedNumber = formattedNumber.split('.');
    if (formattedNumber[0].length > 3) {
        formattedNumber[0] = formattedNumber[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, separator);
    }
    if ((formattedNumber[1] || '')
        .length < precision) {
        formattedNumber[1] = formattedNumber[1] || '';
        formattedNumber[1] += new Array((precision - formattedNumber[1].length) + 1).join('0');
    }

    return formattedNumber.join(dec);
}

function translate(keyword, attributes = null) {
    const paths = keyword.split('.');
    let current = Laravel.translations;
    let i;

    for (i = 0; i < paths.length; ++i) {
        if (current[paths[i]] === undefined) {
            return keyword;
        } else {
            current = current[paths[i]];
        }
    }

    if ((typeof current === 'string') && (typeof attributes === 'object')) {
        _.forEach(attributes, (attribute, key) => {
            current = current.replace(`:${key}`, attribute);
        });
    }

    return current;
}

function stringReplace(str, search, replacement) {
    return str.split(search).join(replacement)
}

function roundToNearest5k(number) {
    const val = Math.round(number / 5000) * 5000;

    return val > 5000 ? val : 5000;
}

export {
    randomString,
    numberFormat,
    translate,
    stringReplace,
    roundToNearest5k,
}
