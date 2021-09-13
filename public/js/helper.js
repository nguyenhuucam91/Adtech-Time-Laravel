async function getUserAccessToken(t) {
    const token = await t.get('member', 'private', 'token');
    return token
}

async function getMemberId(t) {

}

async function get(url, options = {}) {
    const res = await fetch(url)
    const result = await res.json()
    return result
}

async function post(url, data) {
    await fetch(url)
}
