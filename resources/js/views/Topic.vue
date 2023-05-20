<template>
    <div>
        {{ topic }}
    </div>
</template>
<script>
import axios from 'axios'
export default {
data: () => ({
    topic: null,
}),
async mounted() {
    if(this.$route.params.id !== undefined) {
        const topicResponse = await axios.get('/api/topics/' + this.$route.params.id)
        if(topicResponse.data.success) {
            this.topic = topicResponse.data.response;
        }
    }
}
}
</script>
<style scoped>

</style>
