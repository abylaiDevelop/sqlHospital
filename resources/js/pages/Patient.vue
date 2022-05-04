<template>
    <div>
        <v-toolbar
            color="black accent-1"
            prominent
            tabs
        >
            <v-toolbar-side-icon></v-toolbar-side-icon>
            <v-toolbar-title class="title mr-4">Patients</v-toolbar-title>
            <v-autocomplete
                v-model="model"
                :items="items"
                :loading="isLoading"
                :search-input.sync="search"
                chips
                clearable
                hide-details
                hide-selected
                item-text="name"
                item-value="name"
                label="Search for a patient"
                solo
                @change="handleSearch()"
                @input="handleSearch()"
            >
                <template v-slot:no-data>
                    <v-list-tile>
                        <v-list-tile-title>
                            Search for patients
                        </v-list-tile-title>
                    </v-list-tile>
                </template>
                <template v-slot:selection="{ item, selected }">
                    <v-chip
                        :selected="selected"
                        color="blue-grey"
                        class="white--text"
                    >
                        <v-icon left>mdi-coin</v-icon>
                        <span v-text="item.name"></span>
                    </v-chip>
                </template>
                <template v-slot:item="{ item }">
                    <v-list-tile-avatar
                        color="indigo"
                        class="headline font-weight-light white--text"
                    >
                        {{ item.name.charAt(0) }}
                    </v-list-tile-avatar>
                    <v-list-tile-content>
                        <v-list-tile-title v-text="item.name"></v-list-tile-title>
                        <v-list-tile-sub-title v-text="item.symbol"></v-list-tile-sub-title>
                    </v-list-tile-content>
                    <v-list-tile-action>
                        <v-icon>mdi-coin</v-icon>
                    </v-list-tile-action>
                </template>
            </v-autocomplete>
            <template v-slot:extension>
                <v-tabs
                    :hide-slider="!model"
                    color="transparent"
                    slider-color="blue-grey"
                >
                </v-tabs>
            </template>
        </v-toolbar>
        <v-toolbar dark flat color="grey-lighten">
            <v-toolbar-title>Patient</v-toolbar-title>
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
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.phoneNumber"
                                        label="Phone number" ></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.age"
                                        label="age" ></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-text-field
                                        v-model="editedItem.blood"
                                        label="blood"></v-text-field>
                                </v-flex>
                                <v-flex xs12 >
                                    <v-radio-group v-model="editedItem.sex" row>
                                        <v-radio label="Male" value="Male"></v-radio>
                                        <v-radio label="Female" value="Female"></v-radio>
                                    </v-radio-group>
                                </v-flex>
                                <v-flex xs12>
                                    <v-select
                                        v-model="editedItem.doctor_id"
                                        :hint="`${editedItem.doctor_id}, ${editedItem.doctor_id}`"
                                        :items="tableData"
                                        item-text="Doctor"
                                        item-value="doctor_id"
                                        label="Select"
                                        persistent-hint
                                        return-object
                                        single-line
                                    ></v-select>
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
                <td class="text-xs-right">
                    {{props.item.phoneNumber}}
                </td>
                <td class="text-xs-right">
                    {{props.item.blood}}
                </td>
                <td class="text-xs-right">
                    {{props.item.sex}}
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
import doctors from "./Doctors";
import {forEach} from "lodash";

export default {
    data: () => ({
        dialog: false,
        model: null,
        search: null,
        isLoading: false,
        items: [],
        sex: ['Male', 'Female'],
        headers: [
            {text: 'Name', value: 'name'},
            {text: 'Email', value: 'email'},
            {text: 'Address', value: 'address', sortable: false},
            {text: 'Phone Number', value: 'phoneNumber'},
            {text: 'Blood', value: 'blood'},
            {text: 'Sex', value: 'sex'},
            {text: 'Patient Statement', value: 'patientsStatements', sortable: false},
        ],
        tableData: [],
        editedIndex: -1,
        allPermissions:[],
        editedItem: {
            name: '',
            email: '',
            address: '',
            phoneNumber: '',
            blood: '',
            sex: '',
            patientsStatements: '',
            patient_id: '',
            doctor_id: '',
            age: '',
        },
        defaultItem: {
            name: '',
            email: '',
            address: '',
            phoneNumber: '',
            blood: '',
            sex: '',
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
        search (val) {
            // Items have already been loaded
            if (this.items.length > 0) return

            this.isLoading = true

            // Lazily load input items
            fetch('/api/patients')
                .then(res => res.json())
                .then(res => {
                    this.items = res.data
                })
                .catch(err => {
                    console.log(err)
                })
                .finally(() => (this.isLoading = false))
            let doctor = [];
            this.items.forEach((value, index) => {
                doctor.push(value);
                console.log(value);
            });
            this.doctorsInfo = doctor;
        }
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
        handleSearch(){
            if (this.model !== null) {
                axios.get("/api/patients/search/"+this.model).then(responce => {
                    this.tableData = responce.data.data;
                });
            } else if (this.model === undefined) {
                this.initialize();
            }
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
