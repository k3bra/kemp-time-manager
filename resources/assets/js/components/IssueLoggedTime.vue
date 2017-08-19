<template>
    <span v-bind:class="getClass()">{{ loggedHours }}</span>
</template>

<script>
    export default {
        props: ['estimated', 'logged', 'issueId'],
        data() {
            return {
                loggedHours: 0
            }
        },
        created() {
            this.getHours();
        },
        mounted() {
            let self = this;
            Event.$on('hours', () => {
                self.getHours();
            });
        },
        methods: {
            getClass() {
                return "test";
            },
            getHours() {
                let self = this;
                console.log(self.issueId);
                axios.get('/issue/get-logged-hours', {params: {id: self.issueId}}).then(
                    (response) => {
                        self.loggedHours = response.data;
                    }
                );
            }
        }
    }
</script>
