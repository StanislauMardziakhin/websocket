<template>
    <div class="w-96 mx-auto py-12">
        <div class="mb-2">
            <h4>Messenger</h4>
            <div>
                <div>
                    <input type="text" v-model="body" class="rounded-full border border-indigo-300 "
                           placeholder="Enter your message...">
                </div>
                <div>
                    <a @click.prevent="publish" href="#"
                       class="block w-48 bg-indigo-500 hover:bg-indigo-300 text-white text-center py-2 mt-3 rounded-lg">Send</a>
                </div>
            </div>
            <div class="pt-4">
                <div class="text-sm pb-2 mb-2 border-b border-indigo-100" v-for="message in messages">
                    <p>{{ message.body }}</p>
                    <p class="text-right italic">{{ message.time }}</p>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "Index",

    props: [
        'messages'
    ],

    data() {
        return {
            body: ''
        }
    },

    methods: {
        publish() {
            axios.post('/messages', {body: this.body})
                .then(res => {
                    this.messages.unshift(res.data)
                    this.body = ''
                })
        }
    }
}
</script>

<style scoped>

</style>
