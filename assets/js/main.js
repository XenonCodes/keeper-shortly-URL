'use strict'

document.getElementById('shortenForm').addEventListener('submit', (event) => {
    event.preventDefault();
    shortenUrl();
})

function shortenUrl() {
    const URL = document.getElementById('url').value;

    fetch('shorten.php', {
        method: 'POST',
        body: JSON.stringify({ url: URL }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка при запросе к серверу');
            }
            return response.json()
        })
        .then(data => {
            console.log(data);
            document.getElementById('shortenedUrl').innerHTML = `<a href="http://localhost:8000/${data.shortURL}">http://mysite/${data.shortURL}</a>`
        })
        .catch(error => console.log(error));
}