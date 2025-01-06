function mostrarProductos(productos) {
    noneDisplay();
    document.getElementById("productosTableContainer").style.display = "block";
    const productosTable = document.getElementById("productosTable").getElementsByTagName("tbody")[0];
    productosTable.innerHTML = ""; // Limpiar la tabla antes de añadir los nuevos datos

    productos.forEach(producto => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${producto.id}</td>
            <td>${producto.nombre}</td>
            <td>${producto.descripcion}</td>
            <td>${producto.precio}</td>
            <td>${producto.categoria}</td>
            <td><img src="${producto.image}" alt="Producto" width="100"></td>
            <td> 
                <button class="edit btn-action">Editar</button>
                <button class="delete btn-action" data-id="${producto.id}">Eliminar</button>
            </td>
        `;
        productosTable.appendChild(fila);
    });
}

async function getProductos() {
    const response = await fetch('?controller=api&action=getProductos');
    const productos = await response.json();
    mostrarProductos(productos);
}

async function deleteProducto(id) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este pedido?");
    if (!confirmacion) return; // Detener si el usuario cancela

    const response = await fetch(`?controller=api&action=deleteProducto&id=${id}`);
    const data = await response.json();

    console.log(data); // Agregar esta línea para ver el contenido de data

    if (data.status === "success") {
        alert(data.message);
        getProductos();
    } else {
        alert(data.message);
    }
}

async function editProducto(id) {
    noneDisplay();
    document.getElementById("formContainer").style.display = "block";

    // Obtener los datos del producto desde el servidor
    const response = await fetch(`?controller=api&action=getProductoById&id=${id}`);
    const producto = await response.json();

    formContainer.innerHTML = `
        <label class="form-label" for="editNombre">Nombre</label>
        <input type="text" id="editNombre" class="form-input" placeholder="Nombre" value="${producto.nombre}">
        <label class="form-label" for="editDescripcion">Descripción</label>
        <input type="text" id="editDescripcion" class="form-input" placeholder="Descripción" value="${producto.descripcion}">
        <label class="form-label" for="editPrecio">Precio</label>
        <input type="text" id="editPrecio" class="form-input" placeholder="Precio" value="${producto.precio}">
        <label class="form-label" for="editCategoria">Categoría</label>
        <input type="text" id="editCategoria" class="form-input" placeholder="Categoría" value="${producto.categoria}">
        <label class="form-label" for="editImagen">Imagen URL</label>
        <input type="text" id="editImagen" class="form-input" placeholder="Imagen URL" value="${producto.image}">
        <button id="submitEditarProducto" class="btn-admin">Editar Producto</button>
    `;

    document.getElementById("submitEditarProducto").addEventListener("click", async function() {
        const updatedProducto = {
            id: producto.id,
            nombre: document.getElementById("editNombre").value,
            descripcion: document.getElementById("editDescripcion").value,
            precio: document.getElementById("editPrecio").value,
            categoria: document.getElementById("editCategoria").value,
            image: document.getElementById("editImagen").value
        };

        const updateResponse = await fetch(`?controller=api&action=updateProducto`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedProducto)
        });

        const data = await updateResponse.json();

        if (data.status === "success") {
            alert(data.message);
            getProductos();
        } else {
            alert(data.message);
        }
    });
}

async function createProducto() {
    noneDisplay();
    document.getElementById("formContainer").style.display = "block";

    formContainer.innerHTML = `
        <label class="form-label" for="createNombre">Nombre</label>
        <input type="text" id="createNombre" class="form-input" placeholder="Nombre">
        <label class="form-label" for="createDescripcion">Descripción</label>
        <input type="text" id="createDescripcion" class="form-input" placeholder="Descripción">
        <label class="form-label" for="createPrecio">Precio</label>
        <input type="text" id="createPrecio" class="form-input" placeholder="Precio">
        <label class="form-label" for="createCategoria">Categoría</label>
        <input type="text" id="createCategoria" class="form-input" placeholder="Categoría">
        <label class="form-label" for="createImagen">Imagen URL</label>
        <input type="text" id="createImagen" class="form-input" placeholder="Imagen URL">
        <button id="submitCreateProducto" class="btn-admin">Crear Producto</button>
    `;

    document.getElementById("submitCreateProducto").addEventListener("click", async function() {
        const newProducto = {
            nombre: document.getElementById("createNombre").value,
            descripcion: document.getElementById("createDescripcion").value,
            precio: document.getElementById("createPrecio").value,
            categoria: document.getElementById("createCategoria").value,
            image: document.getElementById("createImagen").value
        };

        const createResponse = await fetch(`?controller=api&action=createProducto`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newProducto)
        });

        const data = await createResponse.json();

        if (data.status === "success") {
            alert(data.message);
            getProductos();
        } else {
            alert(data.message);
        }
    });
}

// Event listeners
document.getElementById("getProductos").addEventListener("click", getProductos);
document.getElementById("newProducto").addEventListener("click", createProducto);

document.querySelector('#productosTable tbody').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete')) {
        const row = event.target.closest('tr');
        const id_producto = row.querySelector('td').innerText;
        deleteProducto(id_producto);
    } else if (event.target.classList.contains('edit')) {
        const row = event.target.closest('tr');
        const id_producto = row.querySelector('td').innerText;
        editProducto(id_producto);
    }
});
