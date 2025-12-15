// Abrir o crear una base de datos en IndexedDB
const dbRequest = indexedDB.open("crudDB", 1);  // Base de datos llamada "crudDB"

// Crear la tabla o almacén de objetos si no existe
dbRequest.onupgradeneeded = function(e) {
    const db = e.target.result;
    if (!db.objectStoreNames.contains("person")) {
        db.createObjectStore("person", { keyPath: "id", autoIncrement: true });
    }
};

// Abrir la base de datos y manejar los errores
let db;
dbRequest.onsuccess = function(e) {
    db = e.target.result;
    mostrarPersona();
};

dbRequest.onerror = function(e) {
    console.log("Error al abrir la base de datos", e);
};

// Guarda una persona (crear o editar)
function guardarPersona(tipo) {
    var Idp = document.getElementById('idp').value;
    var Nombres = document.getElementById('nombres').value;
    var Apellidos = document.getElementById('apellidos').value;
    
    const transaction = db.transaction(["person"], "readwrite");
    const store = transaction.objectStore("person");
    
    if (tipo === 0) {  // Crear nuevo registro
        const newPerson = { p_nombres: Nombres, p_apellidos: Apellidos };
        store.add(newPerson);
    } else {  // Editar un registro
        const updatedPerson = { id: parseInt(Idp), p_nombres: Nombres, p_apellidos: Apellidos };
        store.put(updatedPerson);
    }

    document.getElementById("formu").reset();
    mostrarPersona();
}

// Muestra los datos de la tabla Persona
function mostrarPersona() {
    const tbody = document.getElementById("tbody");
    tbody.innerHTML = '';
    
    const transaction = db.transaction(["person"], "readonly");
    const store = transaction.objectStore("person");
    
    const request = store.getAll(); // Obtener todos los registros

    request.onsuccess = function(e) {
        const results = e.target.result;
        results.forEach(function(row) {
            tbody.innerHTML += 
                "<tr>" +
                "<td>" + row.id + "</td>" +
                "<td>" + row.p_nombres + "</td>" +
                "<td>" + row.p_apellidos + "</td>" +
                "<td><button onclick=\"borrarPersona(" + row.id + ")\">Borrar</button></td>" +
                "</tr>";
        });
    };
}

// Borra todos los datos de la tabla Persona
function borrarTodo() {
    const transaction = db.transaction(["person"], "readwrite");
    const store = transaction.objectStore("person");
    store.clear();
    mostrarPersona();
}

// Borra una persona por id
function borrarPersona(id) {
    const transaction = db.transaction(["person"], "readwrite");
    const store = transaction.objectStore("person");
    store.delete(id);
    mostrarPersona();
}