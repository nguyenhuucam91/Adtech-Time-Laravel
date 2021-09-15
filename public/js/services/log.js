async function storeLog(data) {
    return await create(route('log.store'), data)
}

async function getLogs() {
    return await get(route('log.show'))
}
