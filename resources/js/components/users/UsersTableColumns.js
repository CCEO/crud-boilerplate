export default {
    id: {
        head: "ID",
        default: true,
        filterable: true,
        filter: ""
    },
    name: {
        head: "Nombre",
        default: true,
        filterable: true,
        filter: "",
        sorteable: true
    },
    email: {
        head: "Correo",
        default: true,
        filterable: true,
        sorteable: true,
        filter: ""
    },
    created_at: {
        head: "Fecha",
        default: true,
        filterable: true,
        filter: ""
    },
    actions: {
        head: "Acciones",
        default: true,
        filterable: false,
    },
}
