import axios from 'axios';
import qs from 'qs';

axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['Accept'] = 'application/json';
axios.defaults.baseURL = `${window.Laravel.baseUrl}`;

export default function ajax(method, url, data, config = {}) {
    let response;

    method = method.toLowerCase();
    switch (method) {
        case 'get':
            response = axios.create({
                paramsSerializer: (params) => {
                    return qs.stringify(params, { arrayFormat: 'repeat' });
                },
            }).get(url, { params: data, ...config });
            break;
        case 'post':
            response = axios.post(url, data, config);
            break;
        case 'put':
            response = axios.put(url, data, config);
            break;
        case 'delete':
            response = axios.delete(url, { params: data, ...config });
            break;
        default:
            return null;
    }

    return response;
}
