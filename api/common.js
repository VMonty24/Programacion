// Ocultar todos los contenedores
document.getElementById("inicio").addEventListener("click", noneDisplay);
document.getElementById("salir").addEventListener("click", exitAdmin);

function noneDisplay() {
    document.getElementById("productosTableContainer").style.display = "none";
    document.getElementById("usuariosTableContainer").style.display = "none";
    document.getElementById("pedidosTableContainer").style.display = "none";
    document.getElementById("formContainer").style.display = "none";
    document.getElementById("logsContainer").style.display = "none";
}

function exitAdmin() {
    window.location.href = '?controller=producto';
}

// API EXTERNA PARA MONEDAS
async function obtenerTipoCambio(monedaBase) {
    const apiKey = 'fca_live_su6aoNcy1Gz83fmJ5n5r5xPpGNrupodKpHoo12Km'; // API Key de freecurrencyapi.com
    const url = `https://api.freecurrencyapi.com/v1/latest?apikey=${apiKey}&base_currency=${monedaBase}&currencies=EUR`;
    const response = await fetch(url);
    const data = await response.json();
    return data.data.EUR; // Retorna el tipo de cambio hacia EUR
}

function convertirPrecio(precio, tipoCambio) {
    return (precio * tipoCambio).toFixed(2); // Devuelve el precio convertido con 2 decimales
}

document.getElementById("clearLogs").addEventListener("click", function() {
    fetch('?controller=api&action=deleteLogs', { method: 'POST' })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
            } else {
                alert('Error al eliminar los logs.');
            }
        })
        .catch(error => console.error('Error:', error));
});

// Obtener logs
document.getElementById("getLogs").addEventListener("click", function() {
    noneDisplay();
    const logsContainer = document.getElementById("logsContainer");
    logsContainer.innerHTML = ''; // Borrar el contenido existente

    document.getElementById("logsContainer").style.display = "block";
    fetch('?controller=api&action=getLogs')
        .then(response => response.json())
        .then(data => {
            document.getElementById("logsContainer").innerHTML = `<pre>${data.logs}</pre>`;
        })
        .catch(error => console.error('Error:', error));
});
