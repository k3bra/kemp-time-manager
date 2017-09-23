<template>
    <select v-model="selected" @change="changeStatus()" class="form-control">
        <option v-for="value in status" :value="value.id"
                @change="this.changeStatus(value.id)">
            {{value.name}}
        </option>
    </select>
</template>
<script>
    export default {
        props: ['issueId', 'statusId', 'status'],
        data() {
            return {
                selected: this.statusId,
                errors: {date: [], hours: []}
            }
        },
        methods: {
            changeStatus() {
                axios.post('/issue/change-status', {issueId: this.issueId, statusId: this.selected}).then(function(data) {
                    console.log(data);
                });
            }
        },
        mounted() {

            console.log('Component mounted.')
        }
    }
</script>