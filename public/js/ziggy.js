const Ziggy = {"url":"http:\/\/localhost","port":null,"defaults":{},"routes":{"createlog.showCreateLogView":{"uri":"create-log","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
