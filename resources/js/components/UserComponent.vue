<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Users Index <button class="btn btn-sm btn-warning" @click="logout()">Logout</button></div>

                    <div class="card-body">
                        <table >
                        	<tr>
                                <td></td>
                        		<td>Email</td>
                        		<td>Name</td>
                        		<td>Username</td>
                        		<td>Actions</td>
                        	</tr>
                        	<tr v-for="user in items">
                                <td><input type="checkbox" v-model="checkedUser" :value="user.id"></td>
                        		<td>{{ user.email }}</td>
                        		<td>{{ user.first_name }} {{ user.last_name }}</td>
                        		<td>{{ user.username }}</td>
                        		<td>
                        			<button @click="editUser(user)" class="btn btn-sm btn-info">Edit</button>&nbsp;
                        			<button @click="deleteSingleUser(user.id)" class="btn btn-sm btn-danger">Delete</button>
                        		</td>
                        	</tr>
                        </table>
                        <button class="btn btn-sm btn-danger" @click="deleteChecked()">Delete All Checked</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">&nbsp;</div>

                    <div class="card-body">
                    	<form v-on:submit.prevent="submitForm">
                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>First Name</label>
                                </div>
                                <div class="col-md-8">
        		            	     <input type="text" v-model="item.first_name">
                                </div>
        		            </div>
        	            	
                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Last Name</label>
                                </div>
                                <div class="col-md-8">
        		            	     <input type="text" v-model="item.last_name">
                                </div>
        		            </div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Email</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="email" v-model="item.email">
                                </div>
        	            	</div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Username</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="text" v-model="item.username">
                                </div>
        	            	</div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Password</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="password" v-model="item.password">
                                </div>
        	            	</div>

                            <div class="row">
                                <div class="col-md-4">
                                     <label>Confirmation</label>
                                </div>
                                <div class="col-md-8">
                                     <input type="password" v-model="item.password_confirmation">
                                </div>
                            </div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Address</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="text" v-model="item.address">
                                </div>
        	            	</div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Post Code</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="text" v-model="item.post_code">
                                </div>
        	            	</div>

                    		<div class="row">
                                <div class="col-md-4">
        		            	     <label>Contact Number</label>
                                </div>
                                <div class="col-md-8">
        	            		     <input type="text" v-model="item.contact_number">
                                </div>
        	            	</div>
        	                <button  class="btn btn-sm  btn-primary">Submit</button>
        	                <button  type="button" class="btn btn-sm  btn-secondary" @click="clearForm()">Clear</button>
        	            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
    	props: {
    		// users: {type: Array}
    	},
    	data() {
	        return {
	            items: this.users,
	            item: {
	            	first_name: '',
        			last_name: '',
                    email: '',
                    password: '',
                    address: '',
                    post_code: '',
                    contact_number: '',
                    id: ''
	            },
                checkedUser: []
	        };
	    },
        mounted() {
			this.listUsers()
        },
        methods: {
			listUsers() {
				axios.get(
					'/api/users/', 
					{headers: {"Authorization" : `Bearer ${this.$cookie.get('accessToken')}`}}
				).then(
	                (response) => {
						// console.log(response.data.users);
						this.items = response.data.users;
	                },
					(error) => {
                        window.location.href = '/';
						// Vue.$toast.open(error.message);
					}
				);
			},
			clearForm() {
				this.item.first_name = '';
				this.item.last_name = '';
				this.item.email = '';
				this.item.address = '';
				this.item.post_code = '';
				this.item.contact_number = '';
				this.item.username = '';
				this.item.password = '';
				this.item.password_confirmation = '';
				this.item.id = '';
			},
        	submitForm() {
                let formData = this.item;
                if(this.item.id) {
					axios.patch(
						'/api/users/' + this.item.id, formData,
						{headers: {"Authorization" : `Bearer ${this.$cookie.get('accessToken')}`}}
					)
					.then(
	                    (response) => {
							this.listUsers();

							this.clearForm();
	                    	
                            Vue.$toast.open(response.data.message);
	                    }
	                ).catch(error => {
						Vue.$toast.open(error.response.data.message);
					});
	            }
	            else {
					axios.post(
						'/api/users', formData,
						{headers: {"Authorization" : `Bearer ${this.$cookie.get('accessToken')}`}}
					)
					.then(
	                    (response) => {
							this.listUsers();

	                    	this.clearForm();

                            Vue.$toast.open(response.data.message);
	                    }
	                ).catch(error => {
						Vue.$toast.open(error.response.data.message);
					});
	            }
        	},
        	editUser(item) {
            	this.item.first_name = item.first_name;
            	this.item.last_name = item.last_name;
            	this.item.email = item.email;
            	this.item.address = item.address;
            	this.item.post_code = item.post_code;
            	this.item.contact_number = item.contact_number;
            	this.item.username = item.username;
            	this.item.password = item.password;
            	this.item.id = item.id;
        	},
        	deleteUser(user_id) {
        		axios.delete(
					`/api/users/` + user_id,
					{headers: {"Authorization" : `Bearer ${this.$cookie.get('accessToken')}`}}
				).then(
                    (response) => {
						this.items = response.data.users;
                        Vue.$toast.open(response.data.message);
                    },
                    (error) => {
                        Vue.$toast.open(error.message);
                    }
                );
        	},
            deleteSingleUser(user_id) {
                if(confirm('Delete this user?')) {
                    this.deleteUser(user_id);
                }

				this.listUsers()
            },
            deleteChecked() {
				if (this.checkedUser.length) {
					if(confirm('Delete all selected users?')) {
						let _this = this;
						this.checkedUser.forEach(function(user_id) {
						_this.deleteUser(user_id);
						});
					}
				}
				this.listUsers()
            },
			logout() {
				axios.get(
					`/api/logout/`, 
					{
						headers: {
							"Authorization" : `Bearer ${this.$cookie.get('accessToken')}`
						}
					}
				).then(
	                (response) => {
						this.$cookie.delete('accessToken');
                        window.location.href = '/';
						// console.log(response);
	                },
					(error) => {
						Vue.$toast.open(error.message);
					}
				);
			}
        }
    }
</script>