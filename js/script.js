
document.querySelector('form').addEventListener('submit', requestProcessingCity);

async function requestProcessingCity(e) {
    let city = document.querySelector('select').value;
    let response = await fetch('../php/autocomplete.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({
            'city': city
        })
    });
    if (response.ok) {
        let offset = await response.text();
        alert(offset);
    } else {
        alert('Ошибка получения данных');
    }
    
}
