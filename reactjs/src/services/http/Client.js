import axios from 'axios';
import {getAuthTokenHeaderName, getTokenValue, isAuthenticated} from "../security/Identifier";

const API_URL = 'http://localhost/api/';

const POST_METHOD = 'post';
const GET_METHOD = 'get';

let config = {
    baseURL: API_URL,
    headers: {
        responseType: 'json',
    },
};

let addAuthorizationHeader = () => {
    if (isAuthenticated()) {
        config.headers[getAuthTokenHeaderName()] = getTokenValue();
    }
};

let configure = (method, url, values = {}) => {
    switch (method) {
        case POST_METHOD:
            config.data = values;
            break;
        case GET_METHOD:
            config.params = values;
            break;
        default:
            throw new Error(`Unsupported method "${method}".`);
    }

    config.method = method;
    config.url = url;

    addAuthorizationHeader();
};

export function post(url, values = {}) {
    configure(POST_METHOD, url, values);
    return axios.request(config);
}

export function get(url, values = {}) {
    configure(GET_METHOD, url, values);
    return axios.request(config);
}