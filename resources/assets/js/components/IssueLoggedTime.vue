<template>
    <span v-bind:class="getClass()">{{ loggedHours }} hour(s)</span>
</template>

<script>
    export default {
        props: ['estimated', 'issueId'],
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
                if (this.loggedHours > this.estimated) {
                    return "above-estimated"
                }

                return "below-estimated";
            },
            getHours() {
                let self = this;
                axios.get('/issue/get-logged-hours', {params: {id: self.issueId}}).then(
                    (response) => {
                        self.loggedHours = response.data;
                    }
                );
            }
        }
    }
</script>

<style scoped>
    .above-estimated {
        color: red;
    }

    .below-estimated {
        color: green;
    }

</style>