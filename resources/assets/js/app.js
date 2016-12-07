
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

//Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        entries: [],
        formShow: false,
        last_name: null,
        first_name: null,
        phone: null,
        entry_id: null,
        sort_ascending: true,
        search_term: null,
    },
    computed: {
      sorted_entries: function () {
          var entries = this.entries;
          if(this.search_term != "" && this.search_term != null)
          {

            entries = this.entries.filter(this.searchEntries);
          }
          if(this.sort_ascending){
              return entries.sort(function (entryA, entryB) {
                  if(entryA.last_name > entryB.last_name) {
                      return 1;
                  }
                  if(entryA.last_name < entryB.last_name) {
                      return -1;
                  }
                  return 0;
              });
          } else {
              return entries.sort(function (entryA, entryB) {
                  if(entryA.last_name > entryB.last_name) {
                      return -1;
                  }
                  if(entryA.last_name < entryB.last_name) {
                      return 1;
                  }
                  return 0;
              });
          }
      }
    },
    methods: {
        getEntries: function() {
            this.$http.get(window.Directory.url + 'entries').then(
                function (response) {
                    this.entries = response.body.entries;
                },
                function (response) {
                    console.log(response)
                }
            );
        },
        searchEntries: function(entry)
        {
            var last_name = entry.last_name.toLowerCase();
            var first_name = entry.first_name.toLowerCase();
            if(last_name.includes(this.search_term.toLowerCase()) || first_name.includes(this.search_term.toLowerCase()) || entry.id == this.entry_id){
                return true;
            }
            return false;
        },
        removeEntry: function(entry)
        {
            if(entry.id != this.entry_id)
            {
                return true;
            }
            return false;
        },
        showNewForm: function () {
            this.formShow = !this.formShow;
        },
        storeEntry: function () {
            if(this.entry_id == null)
            {
                this.$http.post(window.Directory.url + 'entries', {
                    'last_name': this.last_name,
                    'first_name': this.first_name,
                    'phone': this.phone
                }).then(
                    function (response) {
                        if(response.body.saved == true)
                        {
                            this.entries.push({
                                'last_name': this.last_name,
                                'first_name': this.first_name,
                                'phone': this.phone,
                                'id': response.body.id
                            });
                            this.clearForm();
                            this.formShow = false;
                        }
                    },
                    function (response) {
                        console.log(response)
                    }
                );
            } else {
                this.$http.patch(window.Directory.url + 'entries/' + this.entry_id, {
                    'id': this.entry_id,
                    'last_name': this.last_name,
                    'first_name': this.first_name,
                    'phone': this.phone
                }).then(
                    function (response) {
                        if(response.body.saved == true)
                        {
                            entry = this.entries.find(this.searchEntries);
                            index = this.entries.indexOf(entry);
                            Vue.set(this.entries, index, {
                             'last_name': this.last_name,
                             'first_name': this.first_name,
                             'phone': this.phone,
                             'id': response.body.id
                             });
                            this.clearForm();
                            this.formShow = false;
                        }
                    },
                    function (response) {
                        console.log(response)
                    }
                );
            }

        },
        clearForm: function () {
            this.last_name = null;
            this.first_name = null;
            this.phone = null;
            this.entry_id = null;
        },
        editEntry: function(entry) {
            if(this.formShow == true && this.entry_id == entry.id)
            {
                this.cancelForm();
            } else {
                if((this.formShow == true && this.entry_id != entry.id) || this.formShow == false)
                {
                    this.entry_id = entry.id;
                    this.last_name = entry.last_name;
                    this.first_name = entry.first_name;
                    this.phone = entry.phone;
                    this.formShow = true;
                }
            }

        },
        deleteEntry: function(entry) {
            this.$http.delete(window.Directory.url + 'entries/' + entry.id).then(
                function (response) {
                    if(response.body.deleted == true)
                    {
                        this.entry_id = entry.id;
                        this.entries = this.entries.filter(this.removeEntry);
                        this.entry_id = null;
                    }
                },
                function (response) {
                    console.log(response)
                }
            );
        },
        cancelForm: function()
        {
            this.formShow = false;
            this.clearForm();
        }
    },
    mounted: function () {
        this.getEntries();
    }
});
