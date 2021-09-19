async function storeLog(data) {
    return await create(route('log.store'), data)
}

async function getLogs(cardId) {
    return await get(route('log.show', cardId))
}

async function destroyLog(id) {
    return await destroy(route('log.destroy', {id, _token:}))
}
