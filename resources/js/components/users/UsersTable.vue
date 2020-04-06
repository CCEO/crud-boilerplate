<template>
    <v-server-table url="/users" :columns="columns" :options="options">

    </v-server-table>
</template>

<script>
    export default {
        data() {
            return {
                columns: ['id', 'name', 'email', 'created_at'],
                options: {
                    columnsDropdown: true,
                    filterByColumn: true,
                    perPageValues: [10, 25, 50, 100],
                    responseAdapter: function (resp) {
                        var data = this.getResponseData(resp);
                        return {data: data.users, count: data.count}
                    },
                    saveState: true,
                    storage: 'localStorage'
                }
            }
        },
    }
</script>
