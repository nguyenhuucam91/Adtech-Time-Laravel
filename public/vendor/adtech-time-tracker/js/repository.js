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
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify(data)
    });
    const jsonResult = await response.json()
    return jsonResult
}

async function destroy(url) {
    const response = await fetch(url, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const jsonResult = await response.json()
    return jsonResult
}

async function put(url, data) {
    const response = await fetch(url, {
        method: 'PUT',
        body: JSON.stringify(data),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const jsonResult = await response.json()
    return jsonResult
}


async function create(url, data) {
    return await post(url, data)
}

async function find(url) {
    return await get(url);
}

async function update(url, data) {
    return await put(url, data);
}

async function remove(url) {
    return await destroy(url);
}
