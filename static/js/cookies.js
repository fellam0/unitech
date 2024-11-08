document.addEventListener('DOMContentLoaded', function() {
    // Vérifier si le consentement aux cookies a été donné
    if (!getCookie('cookieConsent')) {
        document.getElementById('cookieConsent').style.display = 'block';
    }

    // Accepter les cookies
    document.getElementById('acceptCookies').addEventListener('click', function() {
        setCookie('cookieConsent', 'accepted', 365);
        document.getElementById('cookieConsent').style.display = 'none';
    });

    // Refuser les cookies
    document.getElementById('rejectCookies').addEventListener('click', function() {
        setCookie('cookieConsent', 'rejected', 365);
        document.getElementById('cookieConsent').style.display = 'none';
    });
});

// Fonction pour définir un cookie
function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Fonction pour récupérer un cookie
function getCookie(name) {
    const cname = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookiesArray = decodedCookie.split(';');
    for (let i = 0; i < cookiesArray.length; i++) {
        let cookie = cookiesArray[i].trim();
        if (cookie.indexOf(cname) == 0) {
            return cookie.substring(cname.length, cookie.length);
        }
    }
    return "";
}
