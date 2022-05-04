<template>
  <v-list dense>
    <v-list-tile exact to="/admin">
      <v-list-tile-action>
        <v-icon>dashboard</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Dashboard</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-group no-action>
      <v-list-tile slot="activator">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>Department Management</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile to="/admin/department">
        <v-list-tile-action>
          <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
          <v-list-tile-title>Departments</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile to="/admin/users">
        <v-list-tile-action>
            <v-icon>account_circle</v-icon>
        </v-list-tile-action>
        <v-list-tile-content>
            <v-list-tile-title>Users</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

        <v-list-tile to="/admin/employees">
            <v-list-tile-action>
                <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Employees</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-list-tile to="/admin/doctors">
            <v-list-tile-action>
                <v-icon>account_circle</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
                <v-list-tile-title>Doctors</v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
    </v-list-group>

    <v-list-tile to="/admin/patient">
      <v-list-tile-action>
        <v-icon>settings</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>Patients</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

    <v-list-tile to="/admin/medcentre">
      <v-list-tile-action>
        <v-icon>settings</v-icon>
      </v-list-tile-action>
      <v-list-tile-content>
        <v-list-tile-title>MedCentre</v-list-tile-title>
      </v-list-tile-content>
    </v-list-tile>

      <v-list-tile to="/admin/team">
          <v-list-tile-action>
              <v-icon>settings</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
              <v-list-tile-title></v-list-tile-title>
          </v-list-tile-content>
      </v-list-tile>
  </v-list>
</template>


<script>
export default {

}

</script>


