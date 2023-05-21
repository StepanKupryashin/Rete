<template>
    <div class="w-full flex flex-col mb-5">
        <div class="flex flex-col items-center mt-5">
            <h1 class="font-bold text-xl">{{ topic.title }}</h1>
            <div class="flex flex-row">
                <h2 class="text-xl">Категории топика:</h2>
                <ul
                    v-for="c in topic.category"
                    v-bind:key="c.id"
                    class="flex items-center text-xl font-medium"
                >
                    <li class="ml-2">{{ c.name }}</li>
                </ul>
            </div>
            <h2 class="font-mono font-medium text-lg">
                Автор:
                <a :href="'/profile/' + topic.author.id">{{
                    topic.author.name
                }}</a>
            </h2>
        </div>
        <div v-if="isAuth" class="ml-2 flex flex-col w-[30%]">
            <h2>Написать пост:</h2>
            <textarea
                v-model="newPost"
                name="new-post"
                id="new-post"
                cols="50"
                rows="2"
                placeholder="Напишите текст поста"
                class="rounded-lg border shadow p-2"
            ></textarea>
            <button
                class="left-[70%] relative w-[7rem] rounded-lg bg-blue-500/90 p-2 mt-2 text-white font-medium"
            >
                Написать
            </button>
        </div>
        <h2 class="text-center text-xl font-bold">Посты</h2>
        <div class="w-full flex flex-col justify-center">
            <div
                v-for="p in topic.posts"
                v-bind:key="p.id"
                class="flex justify-center"
            >
                <div
                    class="flex flex-col bg-blue-600/80 mt-2 rounded-lg p-4 w-1/2 text-white font-semibold"
                >
                <span>Автор: {{p.author.name}}</span>
                <p>
                        {{ p.message }}
                    </p>
                    <div class="relative text-right">
                        Отправлено в {{ new Date(p.created_at).toLocaleDateString() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default {
    data: () => ({
        topic: null,
        isAuth: false,
        newPost: "",
    }),
    methods: {
        sendPost: () => {

        }
    },
    async mounted() {
        if (this.$route.params.id !== undefined) {
            const topicResponse = await axios.get(
                "/api/topics/" + this.$route.params.id
            );
            if (topicResponse.data.success) {
                this.topic = topicResponse.data.response;
            }
        }
        this.isAuth = localStorage.getItem("isAuth");
    },
};
</script>
<style scoped></style>
