async function getUserAccessToken(t) {
    const token = await t.get('member', 'private', 'token');
    return token
}

async function getMember(t, apiKey) {
    const userToken = await getUserAccessToken(t);
    const url = `https://api.trello.com/1/members/me?key=${apiKey}&token=${userToken}`;
    const user = await get(url);
    return user;
}
