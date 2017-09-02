<template>
    <select v-model="selected" @change="assignUser()" class="form-control">
        <option v-for="user in users" :value="user.id"
                @change="this.assignUser(user.id)">
            {{user.name}}
        </option>
    </select>
</template>
<script>
    export default {
        props: ['issueId', 'userId', 'users'],
        data() {
            return {
                selected: this.userId,
                errors: {date: [], hours: []}
            }
        },
        methods: {
            assignUser() {
                axios.post('/issue/assign', {issueId: this.issueId, userId: this.selected}).then(function(data) {
                    console.log(data);
                });
            }
        },
        mounted() {

            console.log('Component mounted.')
        }
    }
</script>