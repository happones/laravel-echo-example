<template>
    <div>
        <p>Your are {{ user.name }}</p>
        <ul>
            <li v-for="item in users">
                {{ item.name }}
            </li>
        </ul>
        <div class="form-group">
            <textarea v-model="data.message" class="form-control"></textarea>
        </div>
        <p>
            <button class="btn btn-primary" type="button" @click="onSendAll">
                Send to all
            </button>
             <button class="btn btn-secondary" type="button" @click="onSendToOthers">
                 Send to the others
             </button>
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {
                    message: ''
                },
                users: []
            }
        },
        mounted() {

            Echo.join('chat.1')
                .here((users) => {
                    this.users = users || [];
                })
                .joining((user) => {
                    alert(`Joining ${user.name}'`);
                })
                .leaving((user) => {
                    alert(`leaving ${user.name}'`);
                })
                .listen('NewMessage', (e) => {
                    console.log(e);
                    alert(e.message);
                });
        },
        props: {
            user: Object
        },
        methods: {
            onSendAll() {
                axios.post('/api/send-all', this.data)
                    .then(() => {
                        this.data.message = '';
                    })
            },
            onSendToOthers() {
                axios.post('/api/send-others', this.data)
                    .then(() => {
                        this.data.message = '';
                    })
            }
        }
    }
</script>
