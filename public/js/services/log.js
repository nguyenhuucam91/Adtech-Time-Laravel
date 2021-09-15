async function storeLog(data) {
    return await create(route('log.store'), data)
}

async function getLog() {
    return await get(route('log.show'))
}
