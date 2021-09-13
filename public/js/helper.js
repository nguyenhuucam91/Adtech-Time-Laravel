async function getUserAccessToken(t) {
    const token = await t.get('member', 'private', 'token');
    return token
}

function getApiKey() {
    return '5826f9dda372a8614519a86a76683a9f'
}

async function getMemberId(t) {
    const apiKey = getApiKey();
    const userToken = await getUserAccessToken(t);
    const userId = await get(`https://api.trello.com/1/members/me?key=${apiKey}&token=${userToken}`).then(res => res.id)
    return userId;
}

async function get(url, options = {}) {
    const res = await fetch(url)
    const result = await res.json()
    return result
}

async function post(url, data) {
    await fetch(url)
}
