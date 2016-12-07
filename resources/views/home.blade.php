@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="directory-header">Phone Directory</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-sm-1 col-md-offset-3 col-md-push-6">
            <button class="btn btn-success btn-add pull-right" v-on:click="showNewForm"><span class="glyphicon glyphicon-plus"></span></button>
        </div>
        <div class="col-md-6 col-sm-6 col-md-pull-1 entry-list-container">
            <div class="row">
                <div class="col-md-12">
                    <input type="text" class="form-control col-md-10" id="search-box" v-model="search_term" placeholder="Search">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-default" v-on:click="sort_ascending = true"><span class="glyphicon glyphicon-sort-by-alphabet"></span></button>
                    <button class="btn btn-default" v-on:click="sort_ascending = false"><span class="glyphicon glyphicon-sort-by-alphabet-alt"></span></button>
                </div>
            </div>
            <div class="row entry-list-container">
                <div class="col-md-12 entry-form-container">
                    <transition name="slide-fade">
                        <form action="" v-if="formShow" v-on:submit.prevent>
                            <div class="form-group">
                                <input type="hidden" id="id" v-model="entry_id">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" v-model="last_name">
                                <label for="first_name">First Name</label>
                                <input id="first_name" type="text" class="form-control" v-model="first_name">
                                <label for="phone">Phone #</label>
                                <input id="phone" type="text" class="form-control" v-model="phone">
                            </div>
                            <button class="btn btn-success pull-right" id="save" v-on:click="storeEntry">Save</button>
                            <button class="btn btn-danger pull-right" id="cancel" v-on:click="cancelForm">Cancel</button>
                        </form>
                    </transition>

                </div>
                <div class="entry-list">
                    <div class="col-md-12 entry-card" v-for="entry in sorted_entries" v-bind:key="entry.id">
                        <div class="name">
                            @{{ entry.last_name }}, @{{ entry.first_name }}
                            <button class="btn btn-default pull-right" v-on:click="editEntry(entry)"><span class="glyphicon glyphicon-pencil"></span></button>
                            <button class="btn btn-default pull-right" v-on:click="deleteEntry(entry)"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                        <div class="phone"> <a v-bind:href="'tel:' + entry.phone"> @{{ entry.phone }}</a> </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection