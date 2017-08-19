<template>
    <div class="modal" style="display:inherit!important;" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" @click="$emit('close')" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal title</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input class="form-control" v-model="date" type="date">
                        <span class="alert-danger" v-for="error in errors.date">{{error}}</span>
                    </div>
                    <div class="form-group">
                        <label for="Hours">Hours:</label>
                        <input type="number" v-model="hours" class="form-control">
                        <span class="alert-danger" v-for="error in errors.hours">{{error}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="$emit('close')" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" @click="logHours()" class="btn btn-primary">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</template>
<script>
    export default {
        props: ['issueId'],
        data() {
            return {
                date: this.formattedTodayDate(),
                hours: '',
                errors: {date: [], hours: []}
            }
        },
        methods: {
            logHours() {
                let self = this;
                axios.post('/issue/log-hour', {
                    date: this.date, hours: this.hours, id: this.issueId
                }).then((response) => {
                    let currentLoggedHours = response.data;
                    this.$emit('close');
                    Event.$emit('hours', currentLoggedHours);
                }).catch((error) => {
                    self.errors = error.response.data;
                });

            },
            formattedTodayDate() {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1; //January is 0!
                let yyyy = today.getFullYear();

                if (dd < 10) {
                    dd = '0' + dd
                }

                if (mm < 10) {
                    mm = '0' + mm
                }
                today = yyyy + '-' + mm + '-' + dd;
                console.log(today);
                return today;
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>