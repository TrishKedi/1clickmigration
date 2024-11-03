const fetchPricing = function (promoCode) {
    const userId = jQuery.MD5(jQuery('#user_email').val());
    let apiURL = configData.apiEndpoint + '?id=' + userId;
    if (promoCode) apiURL += '&promo=' + promoCode.toLowerCase();
    
    return new Promise((resolve, reject) => {
        jQuery.ajax({
            url: apiURL,
            success: function (data) {
                configData.defaultPrice = data.price;
                resolve(data);
            },
            error: function (error) {
                reject(error);
            }
        });
    });
};
