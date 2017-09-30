<template>
    <ul class="dropdown-menu media-list pull-right animated fadeInDown">
        <li class="dropdown-header">Notifications ({{ numberOfNotifications }}) </li>
        <li class="media" v-for="notification in notifications">
            <a href="javascript:;">
                <div class="media-left"><i class="fa fa-bug media-object bg-red"></i></div>
                <div class="media-body">
                    <h6 class="media-heading">{{ notification.description }}</h6>
                    <div class="text-muted f-s-11">{{ notification.created_at }}</div>
                </div>
            </a>
        </li>
        <li class="dropdown-footer text-center">
            <a href="javascript:;">View more</a>
        </li>
    </ul>
</template>
<script>
    export default {
        data() {
            return {
                notifications: [],
                numberOfNotifications: 0
            }
        },
        mounted() {
            let self = this;
            axios.get('/user/notifications').then(function(data) {
                self.notifications = data.data;

                self.numberOfNotifications = self.notifications.length;
            });
        }
    }
</script>