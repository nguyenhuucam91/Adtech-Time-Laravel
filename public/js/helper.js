async function getUserAccessToken(t) {
    const token = await t.get('member', 'private', 'token');
    return token
}

function getApiKey() {
    return '5826f9dda372a8614519a86a76683a9f'
}

async function getMember(t) {
    const apiKey = getApiKey();
    const userToken = await getUserAccessToken(t);
    const url = `https://api.trello.com/1/members/me?key=${apiKey}&token=${userToken}`;
    const user = await get(url);
    return user;
}

async function get(url, options = {}) {
    const res = await fetch(url, {
        headers: {
            'Content-Type': 'application/json',
        }
    })
    const result = await res.json()
    return result
}

async function post(url, data, callback = null) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const jsonResult = await response.json()
    if (callback == null) {
        return jsonResult;
    }
    return callback(jsonResult);
}
