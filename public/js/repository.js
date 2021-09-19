
async function get(url, options = {}) {
    const result = await axios.get(url, {
        headers: {
            "Access-Control-Allow-Origin": "*"
        }
    })
    return result
}

async function post(url, data) {
    const jsonResult = await axios.post(url, JSON.stringify(data), {
        headers: {
            "Access-Control-Allow-Origin": "*"
        }
    })
    return jsonResult
}

async function destroy(url) {
    const response = await axios.delete(url, {
        headers: {
            "Access-Control-Allow-Origin": "*"
        }
    })
    return response
}


async function create(url, data) {
    await post(url, data)
}

async function find(url) {
    await get(url);
}
