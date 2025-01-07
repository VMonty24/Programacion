// Añadir eventos a los botones de inicio y salir
document.getElementById("inicio").addEventListener("click", noneDisplay);
document.getElementById("salir").addEventListener("click", exitAdmin);

// Función para ocultar todos los contenedores
function noneDisplay() {
    document.getElementById("productosTableContainer").style.display = "none";
    document.getElementById("usuariosTableContainer").style.display = "none";
    document.getElementById("pedidosTableContainer").style.display = "none";
    document.getElementById("formContainer").style.display = "none";
    document.getElementById("logsContainer").style.display = "none";
}

// Función para salir del panel de administración
function exitAdmin() {
    window.location.href = '?controller=producto';
}

// Función para obtener el tipo de cambio desde una API externa
async function obtenerTipoCambio(monedaBase) {
    const apiKey = 'fca_live_su6aoNcy1Gz83fmJ5n5r5xPpGNrupodKpHoo12Km'; // API Key de freecurrencyapi.com
    const url = `https://api.freecurrencyapi.com/v1/latest?apikey=${apiKey}&base_currency=${monedaBase}&currencies=EUR`;
    const response = await fetch(url);
    const data = await response.json();
    return data.data.EUR; // Retorna el tipo de cambio hacia EUR
}

// Función para convertir el precio a otra moneda
function convertirPrecio(precio, tipoCambio) {
    return (precio * tipoCambio).toFixed(2); // Devuelve el precio convertido con 2 decimales
}

// Añadir evento para limpiar los logs
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

// Añadir evento para obtener los logs
document.getElementById("getLogs").addEventListener("click", function() {
    noneDisplay(); // Ocultar todos los contenedores
    const logsContainer = document.getElementById("logsContainer");
    logsContainer.innerHTML = ''; // Borrar el contenido existente

    document.getElementById("logsContainer").style.display = "block"; // Mostrar el contenedor de logs
    fetch('?controller=api&action=getLogs')
        .then(response => response.json())
        .then(data => {
            document.getElementById("logsContainer").innerHTML = `<pre>${data.logs}</pre>`; // Mostrar los logs obtenidos
        })
        .catch(error => console.error('Error:', error));
});
