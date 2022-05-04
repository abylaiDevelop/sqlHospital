<template>
    <div>
        <v-toolbar dark flat color="grey-lighten">
            <v-toolbar-title>Employees</v-toolbar-title>
            <v-divider
                class="mx-2"
                inset
                vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="700px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 >
                                    <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.email"
                                        label="Email"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.address"
                                        label="Address" ></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.patientsStatements"
                                        label="Patient Statement" ></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-toolbar dense>
                                        <v-overflow-btn
                                            :items="dropdown_font"
                                            label="Select font"
                                            hide-details
                                            class="pa-0"
                                        ></v-overflow-btn>

                                        <v-divider vertical></v-divider>

                                        <v-overflow-btn
                                            :items="dropdown_edit"
                                            editable
                                            label="Select size"
                                            hide-details
                                            class="pa-0"
                                            overflow
                                        ></v-overflow-btn>

                                        <v-divider
                                            class="mr-2"
                                            vertical
                                        ></v-divider>
                                        <v-divider
                                            class="mx-2"
                                            vertical
                                        ></v-divider>

                                        <v-btn-toggle
                                            v-model="toggle_exclusive"
                                            class="transparent"
                                        >
                                            <v-btn :value="1" flat>
                                                <v-icon>format_align_left</v-icon>
                                            </v-btn>

                                            <v-btn :value="2" flat>
                                                <v-icon>format_align_center</v-icon>
                                            </v-btn>

                                            <v-btn :value="3" flat>
                                                <v-icon>format_align_right</v-icon>
                                            </v-btn>

                                            <v-btn :value="4" flat>
                                                <v-icon>format_align_justify</v-icon>
                                            </v-btn>
                                        </v-btn-toggle>
                                    </v-toolbar>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
        <v-data-table
            :headers="headers"
            :items="tableData"
            class="elevation-1"
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.name }}</td>
                <td class="text-xs-right">{{ props.item.email }}</td>
                <td class="text-xs-right">
                    {{props.item.address}}
                </td>
                <td class="text-xs-right">{{ props.item.patientsStatements }}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                        small
                        class="mr-2"
                        @click="editItem(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                        small
                        @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
            <template slot="no-data">
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    data: () => ({
        dialog: false,
        headers: [
            {text: 'Name', value: 'name'},
            {text: 'Email', value: 'email'},
            {text: 'Address', value: 'address', sortable: false},
            {text: 'Patient Statement', value: 'patientsStatements', sortable: false},
        ],
        tableData: [],
        editedIndex: -1,
        allPermissions:[],
        editedItem: {
            name: '',
            email: '',
            address: '',
            patientsStatements: '',
            patient_id: ''
        },
        defaultItem: {
            name: '',
            email: '',
            address: '',
            patientsStatements: '',
        },

    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item';
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {

            axios.get('/api/patients').then(response => {
                this.tableData = response.data.data;
            });

            axios.get('/api/patients').then(response=>this.allPermissions=response.data.data);
        },

        handleFileUpload() {
            this.editedItem.img_path = this.$refs.file.files[0];
        },
        editItem(item) {
            this.editedIndex = this.tableData.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            const index = this.tableData.indexOf(item);
            confirm('Are you sure you want to delete this item?') && this.tableData.splice(index, 1);

            axios.delete('/api/patients/'+item.id).then(response=>console.log(response.data))

        },

        close() {
            this.dialog = false;
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            }, 300);
        },

        save() {

            if (this.editedIndex > -1) {
                Object.assign(this.tableData[this.editedIndex], this.editedItem);
                axios.post('/api/patients/'+this.editedItem.patient_id+"?_method=PUT",this.editedItem).then(response=>console.log(response.data));
                this.initialize();
            } else {
                this.tableData.push(this.editedItem);
                axios.post('/api/patients', this.editedItem).then(response=>console.log(response.data));
                console.log(this.editedItem);
            }
            this.close();
        },
    },
};
</script>
