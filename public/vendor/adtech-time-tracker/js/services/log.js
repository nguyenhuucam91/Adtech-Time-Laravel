async function storeLog(data) {
    return await create(route('log.store'), data)
}

async function getLogs(cardId) {
    return await find(route('log.index', cardId))
}

async function destroyLog(id) {
    return await remove(route('log.destroy', id))
}

async function updateLog(id, data) {
    return await update(route('log.update', id), data)
}

function generateItemHtml(item) {
    return `<div class="result-item">
                <div class="work-log-creator">
                    <img src=${item.avatar_url + "/30.png"} class="member-avatar">
                </div>
                <div class="work-log-title">
                    <div class="tracked-time-wrapper">
                        <span class="work-log-username">${item.username} logged ${item.time_spent}</span>
                        <span>
                            <a href="javascript:void(0)" class = "edit" data-id="${item.id}">
                                <img src='/public/images/edit.svg' />
                            </a>
                            <a href="javascript:void(0)" class="delete" data-id="${item.id}">
                                <img src='/public/images/trash.svg' />
                            </a>
                        </span>
                    </div>
                    <div><span class="work-log-description">${item.description}</span></div>
                    <div class="logged-time">
                        ${item.updated_at}
                    </div>
                </div>
            </div>
            `
}

async function refreshLogs(cardId) {
    const logs = await getLogs(cardId)
    const content = logs.data.map((item) => generateItemHtml(item))
    return content
}
