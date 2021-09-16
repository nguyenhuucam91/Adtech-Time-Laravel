var GRAY_ICON = 'https://cdn.hyperdev.com/us-east-1%3A3d31b21c-01a0-4da2-8827-4bc6e88b7618%2Ficon-gray.svg';
window.TrelloPowerUp.initialize({
    'card-buttons': function (t, opts) {
        return [{
            // usually you will provide a callback function to be run on button click
            // we recommend that you use a popup on click generally
            icon: GRAY_ICON, // don't use a colored icon here
            text: 'Log work',
            callback: async (t) => {
                const card = await t.card('id');
                const board = await t.board('id');
                const cardId = card.id;
                const boardId = board.id;

                return t.modal({
                    url: route('log.show', cardId),
                    title: 'Log work',
                    fullscreen: false,
                    args: {
                        cardId,
                        boardId
                    }
                })

            },
            condition: 'edit'
        }];
    },
    'card-back-section': function (t, options) {
        return {
            title: 'My Card Back Section',
            icon: GRAY_ICON, // Must be a gray icon, colored icons not allowed.
            content: {
                type: 'iframe',
                url: t.signUrl('https://www.openssl.org'),
                height: 230, // Max height is 1500.
            }
        }
    },
    'authorization-status': function (t, options) {
        // Return a promise that resolves to an object with a boolean property 'authorized' of true or false
        // The boolean value determines whether your Power-Up considers the user to be authorized or not.

        // When the value is false, Trello will show the user an "Authorize Account" options when
        // they click on the Power-Up's gear icon in the settings. The 'show-authorization' capability
        // below determines what should happen when the user clicks "Authorize Account"

        // For instance, if your Power-Up requires a token to be set for the member you could do the following:
        return t.get('member', 'private', 'token')
            .then(function (token) {
                if (token) {
                    return {
                        authorized: true
                    };
                }
                return {
                    authorized: false
                };
            });
        // You can also return the object synchronously if you know the answer synchronously.
    },
    'show-authorization': function (t, options) {
        // Returns what to do when a user clicks the 'Authorize Account' link from the Power-Up gear icon
        // which shows when 'authorization-status' returns { authorized: false }.

        // If we want to ask the user to authorize our Power-Up to make full use of the Trello API
        // you'll need to add your API from trello.com/app-key below:
        let trelloAPIKey = getApiKey()
        // This key will be used to generate a token that you can pass along with the API key to Trello's
        // RESTful API. Using the key/token pair, you can make requests on behalf of the authorized user.

        // In this case we'll open a popup to kick off the authorization flow.
        if (trelloAPIKey) {
            return t.popup({
                title: 'Authorization',
                args: {
                    apiKey: trelloAPIKey,
                    returnUrl: encodeURIComponent(route('authorize.success')),
                }, // Pass in API key to the iframe
                url: route('authorize.index'), // Check out public/authorize.html to see how to ask a user to auth
                height: 140,
            });
        } else {
            console.log("🙈 Looks like you need to add your API key to the project!");
        }
    }
});
