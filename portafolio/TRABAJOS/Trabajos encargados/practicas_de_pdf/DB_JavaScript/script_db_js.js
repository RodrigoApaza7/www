// Creando la base de datos cliente
const db = window.openDatabase('data', '1.0', 'data', 1 * 1024 * 1024);

// Crea la tabla Persona
db.transaction(t => t.executeSql(
    'create table if not exists person (id INTEGER PRIMARY KEY, p_nombres TEXT, p_apellidos TEXT)',
    [],
    function () {
        console.log("tabla creada");
    },
    function () {
        console.log("error");
    }
));

mostrarPersona();

// Guarda variables a la tabla Persona
function guardarPersona(tipo) {
    var Idp = document.getElementById('idp').value;
    var Nombres = document.getElementById('nombres').value;
    var Apellidos = document.getElementById('apellidos').value;

    if (tipo == 0) {
        db.transaction(t => t.executeSql(
            'insert into person(p_nombres, p_apellidos) values (?, ?)',
            [Nombres, Apellidos]    
        ));
    } else {
        db.transaction(t => t.executeSql(
            'update person set p_nombres=?, p_apellidos=? WHERE id=?',
            [Nombres, Apellidos, Idp]
        ));
    }

    document.getElementById("formu").reset();
    mostrarPersona();
}

// Muestra los datos de la tabla Persona
function mostrarPersona() {
    tbody.innerHTML = '';

    db.transaction(t => t.executeSql(
        'select * from person',
        [],
        function (t, results) {
            var tbody = document.getElementById("tbody");
            for (var i = 0; i < results.rows.length; i++) {
                var row = results.rows.item(i);
                tbody.innerHTML +=
                    "<tr>" +
                    "<td>" + row.id + "</td>" +
                    "<td>" + row.p_nombres + "</td>" +
                    "<td>" + row.p_apellidos + "</td>" +
                    "<td><button onclick=\"borrarPersona(" + row.id + ")\">Borrar</button></td>" +
                    "</tr>";
            }
        }
    ));
}

// Borra todos los datos de la tabla Persona
function borrarTodo() {
    db.transaction(t => t.executeSql(
        'delete from person'
    ));
    mostrarPersona();
}

// Borra una persona por id
function borrarPersona(id) {
    db.transaction(t => t.executeSql(
        'delete from person where id=?',
        [id]
    ));
    mostrarPersona();
}