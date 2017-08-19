<template>
    <div class="container">
        <div class="row">
            <section class="content">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button v-for="status in issuesStatus" type="button"
                                            v-bind:class="getButtonClass(status.id)">
                                        {{ status.name }}
                                    </button>
                                    <button type="button" class="btn btn-default btn-filter" data-target="all">All
                                    </button>
                                </div>

                            </div>
                            <div class="table-container">
                                <table class="table table-filter">
                                    <tbody>

                                    <tr v-for="issue in issues">
                                        <td>
                                            {{issue.project.name}}
                                        </td>
                                        <td>
                                            {{issue.assigned_to.name}}
                                        </td>

                                        <td>
                                            <div class="media">
                                                <a v-on:click="test(issue.assigned_to.name)" href="#" class="pull-left">
                                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg"
                                                         class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right">{{issue.created_at}}</span>
                                                    <h4 class="title">
                                                        {{issue.name}}
                                                    </h4>
                                                    <p class="summary">{{issue.description}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span v-bind:class="getColour(issue.status)"> {{ issue.status_desc.name
                                                }} </span>
                                        </td>
                                        <td><a :href="getIssueUrl(issue.id)">Details</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                issues: {},
                issuesStatus: {},
                url: '/issue/show/'
            }
        },
        methods: {
            getStatus() {
                self = this;
                axios.get('/issue/show-all-status').then(function (response) {
                    self.issuesStatus = response.data;
                });
            },
            getIssues() {
                self = this;

                axios.get('/issue/show-all').then(function (response) {
                    self.issues = response.data;
                });
            },
            getColour(id) {
                if (id == 1) {
                    return "open";
                }
                if (id == 2) {
                    return "on-hold";
                }
                if (id == 3) {
                    return "closed";
                }
                if (id == 4) {
                    return "in-progress";
                }
                return "";
            },
            getButtonClass(id) {

                if (id == 1) {
                    return "btn btn-success btn-filter";
                }
                if (id == 2) {
                    return "btn btn-warning btn-filter";
                }
                if (id == 3) {
                    return "btn btn-danger btn-filter";
                }
                if (id == 4) {
                    return "btn btn-info btn-filter";
                }

                return "btn btn-default btn-filter";
            },
            getIssueUrl(id) {
                return "/issue/show/" + id;
            }
        },
        created() {
            this.getIssues();
            this.getStatus();
        },
        mounted() {
                  }
    }
</script>