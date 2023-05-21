<template>
    <div>
        <h1 class="gray mt-5">Домашняя страница</h1>
        <last-topic-activity class="mt-2" v-if="lastTopicActivity" :data="lastTopicActivity"></last-topic-activity>
        <last-post-activity class="mt-2" v-if="dataLastPostActivity" :data="dataLastPostActivity"></last-post-activity>
    </div>
</template>
<script>
import axios from 'axios';
import LastPostActivity from '../components/LastPostActivity.vue';
import LastTopicActivity from '../components/LastTopicActivity.vue';
export default {
  components: { LastTopicActivity , LastPostActivity },
    data: () => ({
        lastTopicActivity: null,
        dataLastPostActivity: null,
    }),
    methods: {

    },
    async mounted() {
        const topics =  await axios.get('/api/topics/lasted_activity');
        console.log(topics);
        if(topics.data.success) {
            this.lastTopicActivity = topics.data.response;
        }
        const posts = await axios.get('/api/posts');
        console.log(posts);
        if(posts.data.success) {
            this.dataLastPostActivity = posts.data.response;
        }

    }
}
</script>
<style scoped>
.gray {
    color: rgba(94, 89, 89, 0.828);
}
h1 {
    text-align: center;
}
</style>
