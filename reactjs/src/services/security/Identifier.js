
const authTokenKeyStorage = 'X-AUTH-TOKEN';
const authTokenHeaderName = 'X-AUTH-TOKEN';

export function isAuthenticated() {
    let tokenValue = getTokenValue();
    return tokenValue !== null;
}

export function authenticate(tokenValue) {
    if (typeof tokenValue !== 'string') {
        throw new Error('Invalid token value.');
    }
    localStorage.setItem(authTokenKeyStorage, tokenValue);
}

export function getTokenValue() {
    return localStorage.getItem(authTokenKeyStorage);
}

export function getAuthTokenHeaderName() {
    return authTokenHeaderName;
}

export function logout() {
    localStorage.removeItem(authTokenKeyStorage)
}