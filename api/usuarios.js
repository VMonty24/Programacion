// Función para mostrar los usuarios en una tabla
function mostrarUsuarios(usuarios) {
    noneDisplay();
    document.getElementById("usuariosTableContainer").style.display = "block";
    const usuariosTable = document.getElementById("usuariosTable").getElementsByTagName("tbody")[0];
    usuariosTable.innerHTML = ""; // Limpiar la tabla antes de añadir los nuevos datos

    // Usamos map() para crear las filas de la tabla y luego añadirlas
    const filas = usuarios.map(usuario => {
        const fila = document.createElement("tr");
        fila.innerHTML = `
            <td>${usuario.id}</td>
            <td>${usuario.nombre}</td>
            <td>${usuario.apellidos}</td>
            <td>${usuario.password}</td>
            <td>${usuario.email}</td>
            <td>${usuario.telefono}</td>
            <td>${usuario.direccion}</td>
            <td> 
                <button class="edit btn-action">Editar</button>
                <button class="delete btn-action" data-id="${usuario.id}">Eliminar</button>
            </td>
        `;
        return fila;
    });

    // Añadir todas las filas al cuerpo de la tabla
    filas.forEach(fila => usuariosTable.appendChild(fila));
}

// Función para obtener los usuarios desde la API
async function getUsuarios() {
    const response = await fetch('?controller=api&action=getUsuarios');
    const usuarios = await response.json();
    mostrarUsuarios(usuarios);
}

// Función para eliminar un usuario
async function deleteUsuario(id) {
    const confirmacion = confirm("¿Estás seguro de que deseas eliminar este usuario?");
    if (!confirmacion) return;

    const response = await fetch(`?controller=api&action=deleteUsuario&id=${id}`);
    const data = await response.json();

    if (data.status === "success") {
        alert(data.message);
        getUsuarios();
    } else {
        alert(data.message);
    }
}

// Función para editar un usuario
async function editUsuario(id) {
    noneDisplay();
    document.getElementById("formContainer").style.display = "block";
    const response = await fetch(`?controller=api&action=getUsuarioById&id=${id}`);
    const usuario = await response.json();

    // Rellenar el formulario con los datos del usuario
    formContainer.innerHTML = `
        <label class="form-label" for="editNombre">Nombre</label>
        <input type="text" id="editNombre" class="form-input" placeholder="Nombre" value="${usuario.nombre}">
        <label class="form-label" for="editApellidos">Apellidos</label>
        <input type="text" id="editApellidos" class="form-input" placeholder="Apellidos" value="${usuario.apellidos}">
        <label class="form-label" for="editPassword">Password</label>
        <input type="password" id="editPassword" class="form-input" placeholder="Password" value="${usuario.password}" required>
        <label class="form-label" for="editEmail">Email</label>
        <input type="email" id="editEmail" class="form-input" placeholder="Email" value="${usuario.email}" required>
        <label class="form-label" for="editTelefono">Teléfono</label>
        <input type="text" id="editTelefono" class="form-input" placeholder="Teléfono" value="${usuario.telefono}">
        <label class="form-label" for="editDireccion">Dirección</label>
        <input type="text" id="editDireccion" class="form-input" placeholder="Dirección" value="${usuario.direccion}">
        <button id="submitEditarUsuario" class="btn-admin">Editar Usuario</button>
    `;

    // Evento para enviar los datos actualizados del usuario
    document.getElementById("submitEditarUsuario").addEventListener("click", async function() {
        const updatedUsuario = {
            id: usuario.id,
            nombre: document.getElementById("editNombre").value,
            apellidos: document.getElementById("editApellidos").value,
            password: document.getElementById("editPassword").value,
            email: document.getElementById("editEmail").value,
            telefono: document.getElementById("editTelefono").value,
            direccion: document.getElementById("editDireccion").value
        };

        const updateResponse = await fetch(`?controller=api&action=updateUsuario`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(updatedUsuario)
        });

        const data = await updateResponse.json();

        if (data.status === "success") {
            alert(data.message);
            getUsuarios();
        } else {
            alert(data.message);
        }
    });
}

// Función para crear un nuevo usuario
async function createUsuario() {
    noneDisplay();
    document.getElementById("formContainer").style.display = "block";

    // Rellenar el formulario para crear un nuevo usuario
    formContainer.innerHTML = `
        <label class="form-label" for="createNombre">Nombre</label>
        <input type="text" id="createNombre" class="form-input" placeholder="Nombre">
        <label class="form-label" for="createApellidos">Apellidos</label>
        <input type="text" id="createApellidos" class="form-input" placeholder="Apellidos">
        <label class="form-label" for="createPassword">Password</label>
        <input type="password" id="createPassword" class="form-input" placeholder="Password" required> 
        <label class="form-label" for="createEmail">Email</label>
        <input type="email" id="createEmail" class="form-input" placeholder="Email" required>
        <label class="form-label" for="createTelefono">Teléfono</label>
        <input type="text" id="createTelefono" class="form-input" placeholder="Teléfono">
        <label class="form-label" for="createDireccion">Dirección</label>
        <input type="text" id="createDireccion" class="form-input" placeholder="Dirección">
        <button id="submitCreateUsuario" class="btn-admin">Crear Usuario</button>
    `;

    // Evento para enviar los datos del nuevo usuario
    document.getElementById("submitCreateUsuario").addEventListener("click", async function() {
        const newUsuario = {
            nombre: document.getElementById("createNombre").value,
            apellidos: document.getElementById("createApellidos").value,
            password: document.getElementById("createPassword").value,
            email: document.getElementById("createEmail").value,
            telefono: document.getElementById("createTelefono").value,
            direccion: document.getElementById("createDireccion").value
        };

        const createResponse = await fetch(`?controller=api&action=createUsuario`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(newUsuario)
        });

        const data = await createResponse.json();

        if (data.status === "success") {
            alert(data.message);
            document.getElementById("usuariosTableContainer").style.display = "block";
            document.getElementById("formContainer").style.display = "none";
            getUsuarios();
        } else {
            alert(data.message);
        }
    });
}

// Event listeners para los botones de obtener y crear usuarios
document.getElementById("getUsuarios").addEventListener("click", getUsuarios);
document.getElementById("newUsuario").addEventListener("click", createUsuario);

// Event listener para los botones de editar y eliminar en la tabla de usuarios
document.querySelector('#usuariosTable tbody').addEventListener('click', function(event) {
    if (event.target.classList.contains('delete')) {
        const row = event.target.closest('tr');
        const id_usuario = row.querySelector('td').innerText;
        deleteUsuario(id_usuario);
    } else if (event.target.classList.contains('edit')) {
        const row = event.target.closest('tr');
        const id_usuario = row.querySelector('td').innerText;
        editUsuario(id_usuario);
    }
});
