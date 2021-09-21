async function setLogVisibility(t, cardId, value) {
    return await t.set('card', 'shared', 'visible-' + cardId, value)
}

async function getLogVisibility(t, cardId) {
    //default to true
    return await t.get('card', 'shared', 'visible-' + cardId, true)
}
