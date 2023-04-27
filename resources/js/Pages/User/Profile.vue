<template>
    <div class="w-96 mx-auto py-12">
        <div>
            User {{ user.name }}
        </div>
        <div>
            <a @click.prevent="sendReaction" href="#"
               class="block w-48 bg-indigo-500 hover:bg-indigo-300 text-white text-center py-2 mt-3 rounded-lg">Send
                reaction</a>
        </div>
        <div v-if="reaction_str">
            {{ reaction_str }}
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    props: [
        'user'
    ],

    data() {
        return {
            reaction_str: ''
        }
    },

    methods: {
        sendReaction() {
            axios.post(`/users/${this.user.id}`, {from_user: this.$page.props.auth.user.name})
                .then(res => {
                this.reaction_str = res.data.reaction_str
                })
        }
    }
}

</script>

<style scoped>

</style>
