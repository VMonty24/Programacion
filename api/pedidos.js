async function getPedidos() {
    document.getElementById("pedidosTableContainer").style.display = "block";
    const response = await fetch('?controller=api&action=getPedidos');
    const pedidos = await response.json();
    mostrarPedidos(pedidos);
}

function mostrarPedidos(pedidos) {
    document.getElementById("pedidosTableContainer").style.display = "block";
    const pedidosTable = document.getElementById("pedidosTable").getElementsByTagName("tbody")[0];
    pedidosTable.innerHTML = ""; // Limpiar la tabla antes de añadir los nuevos datos

    pedidos.forEach(pedido => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${pedido.id}</td>
            <td>${pedido.id_usuario}</td>
            <td>${pedido.total}</td>
            <td>${pedido.metodo_pago}</td>
            <td>${pedido.fecha}</td>
            <td>
                <button class="edit btn-action">Editar</button>
                <button class="delete btn-action" data-id="${pedido.id}">Eliminar</button>
            </td>
        `;
        pedidosTable.appendChild(fila);
    });
}

async function deletePedido(id) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este pedido?");
    if (!confirmacion) return;

    const response = await fetch(`?controller=api&action=deletePedido&id=${id}`);
    const data = await response.json();

    if (data.status === "success") {
        alert(data.message);
        getPedidos();
    } else {
        alert(data.message);
    }
}

async function editPedido(id) {
    const response = await fetch(`?controller=api&action=getPedidoById&id=${id}`);
    const pedido = await response.json();

    formContainer.innerHTML = `
        <label class="form-label" for="editIdUsuario">ID Usuario</label>
        <input type="text" id="editIdUsuario" class="form-input" placeholder="ID Usuario" value="${pedido.id_usuario}">
        <label class="form-label" for="editTotal">Total</label>
        <input type="text" id="editTotal" class="form-input" placeholder="Total" value="${pedido.total}">
        <label class="form-label" for="editMetodoPago">Método de Pago</label>
        <input type="text" id="editMetodoPago" class="form-input" placeholder="Método de Pago" value="${pedido.metodo_pago}">
        <label class="form-label" for="editFecha">Fecha</label>
        <input type="text" id="editFecha" class="form-input" placeholder="Fecha" value="${pedido.fecha}">
        <button id="submitEditarPedido" class="btn-admin">Editar Pedido</button>
    `;

    document.getElementById("submitEditarPedido").addEventListener("click", async function() {
        const updatedPedido = {
            id: pedido.id,
            id_usuario: document.getElementById("editIdUsuario").value,
            total: document.getElementById("editTotal").value,
            metodo_pago: document.getElementById("editMetodoPago").value,
            fecha: document.getElementById("editFecha").value
        };

        const updateResponse = await fetch(`?controller=api&action=updatePedido`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedPedido)
        });

        const data = await updateResponse.json();

        if (data.status === "success") {
            alert(data.message);
            document.getElementById("pedidosTableContainer").style.display = "block";
            document.getElementById("formContainer").style.display = "none";
            getPedidos();
        } else {
            alert(data.message);
        }
    });
}

async function createPedido() {
    document.getElementById("formContainer").style.display = "block";
    document.getElementById("pedidosTableContainer").style.display = "none";

    formContainer.innerHTML = `
        <label class="form-label" for="createIdUsuario">ID Usuario</label>
        <input type="text" id="createIdUsuario" class="form-input" placeholder="ID Usuario">
        <label class="form-label" for="createTotal">Total</label>
        <input type="text" id="createTotal" class="form-input" placeholder="Total">
        <label class="form-label" for="createMetodoPago">Método de Pago</label>
        <input type="text" id="createMetodoPago" class="form-input" placeholder="Método de Pago">
        <label class="form-label" for="createFecha">Fecha</label>
        <input type="text" id="createFecha" class="form-input" placeholder="Fecha">
        <button id="submitCreatePedido" class="btn-admin">Crear Pedido</button>
    `;

    document.getElementById("submitCreatePedido").addEventListener("click", async function() {
        const newPedido = {
            id_usuario: document.getElementById("createIdUsuario").value,
            total: document.getElementById("createTotal").value,
            metodo_pago: document.getElementById("createMetodoPago").value,
            fecha: document.getElementById("createFecha").value
        };

        const createResponse = await fetch(`?controller=api&action=createPedido`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newPedido)
        });

        const data = await createResponse.json();

        if (data.status === "success") {
            alert(data.message);
            document.getElementById("pedidosTableContainer").style.display = "block";
            document.getElementById("formContainer").style.display = "none";
            getPedidos();
        } else {
            alert(data.message);
        }
    });
}

// Event listeners
document.getElementById("getPedidos").addEventListener("click", getPedidos);
document.getElementById("newPedido").addEventListener("click", createPedido);

document.querySelector('#pedidosTable tbody').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete')) {
        const row = event.target.closest('tr');
        const id_pedido = row.querySelector('td').innerText;
        deletePedido(id_pedido);
    } else if (event.target.classList.contains('edit')) {
        const row = event.target.closest('tr');
        const id_pedido = row.querySelector('td').innerText;
        document.getElementById("pedidosTableContainer").style.display = "none";
        document.getElementById("formContainer").style.display = "block";
        editPedido(id_pedido);
    }
});