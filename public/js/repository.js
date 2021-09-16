async function get(url, options = {}) {
    const res = await fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    const result = await res.json()
    return result
}

async function post(url, data) {
    const response = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });
    const jsonResult = await response.json()
    return jsonResult
}


async function create(url, data) {
    await post(url, data)
}

async function find(url) {
    await get(url);
}
