<template>
    <div class="flex flex-col w-full">
        <h1 class="text-center mt-5">Профиль</h1>
        <div
            class="bg-gray-300/50 flex flex-col w-[80vw] mt-2 justify-center items-center rounded-lg p-4 ml-2 self-center"
        >
            <span
                >Имя пользователя: <b>{{ user.name }}</b></span
            >
            <span
                >Email: <b>{{ user.email }}</b></span
            >
            <span
                >На форуме с:
                <b>{{ new Date(user.created_at).toDateString() }}</b></span
            >
            <span
                >Кол-во постов: <b>{{ user.posts.length }}</b></span
            >
            <span
                >Кол-во созданных топиков: <b>{{ user.topics.length }}</b></span
            >
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data: () => ({
        user: null,
    }),

    async mounted() {
        if (this.$route.params.id == undefined) {
            const profileResponse = await axios.get("/api/user/", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "access_token"
                    )}`,
                },
            });
            console.log(profileResponse);
            if (profileResponse.data.success) {
                this.user = profileResponse.data.response;
            }
        } else {
            const profileResponse = await axios.get(
                `/api/user/${this.$route.params.id}`
            );
            console.log(profileResponse);
            if (profileResponse.data.success) {
                this.user = profileResponse.data.response;
            }
        }
    },
};
</script>

<style scoped></style>
