<template>
    <div class="flex flex-col w-full items-center">
        <h1 class="mt-2">Категории</h1>
        <div
            v-for="cat in data"
            v-bind:key="cat.id"
            class="mt-2 bg-slate-300/50 p-4 rounded-lg"
        >
            <div>
                <details>
                    <summary>
                        {{ cat.name }} топиков: {{ cat.topics.length }}
                    </summary>
                    <button
                        v-if="isAuth"
                        class="bg-blue-400 p-2 rounded-lg text-center text-white font-bold"
                        @click="openModal(cat.id)"
                    >
                        Создать топик:3
                    </button>
                    <p class="font-medium">
                        Описание:
                        <br />
                        {{ cat.description }}
                    </p>
                    <h2 class="font-bold">Топики:</h2>
                    <div v-for="t in cat.topics" v-bind:key="t.id">
                        <div
                            class="flex flex-col font-medium bg-gray-300/80 mt-2 rounded-lg p-4"
                        >
                            <span>Название: {{ t.title }}</span>
                            <span>Описание: {{ t.description }}</span>
                            <span
                                >Автор:
                                <a :href="'/profile/' + t.author.id">
                                    {{ t.author.name }}</a
                                >
                            </span>
                            <span>Кол-во постов: {{ t.posts.length }}</span>
                            <a
                                v-bind:href="'/topic/' + t.id"
                                class="text-center text-cyan-700 font-semibold"
                                >Перейти</a
                            >
                        </div>
                    </div>
                </details>
            </div>
        </div>
        <vs-dialog v-model="activeModal">
            <template #header>
                <h1>Создать топик</h1>
            </template>
            <div class="w-full flex flex-col">
                <vs-input v-model="topicName" placeholder="Название топика">
                </vs-input>
                <vs-input
                    class="mt-2"
                    v-model="topicDescription"
                    placeholder="Описание топика"
                >
                </vs-input>
            </div>

            <template #footer>
                <button
                    @click="createTopic"
                    class="bg-blue-400 rounded-lg w-full text-center text-white"
                >
                    <span v-if="!isFetch">Создать</span>
                    <span v-else>Создается</span>
                </button>
            </template>
        </vs-dialog>
    </div>
</template>

<script>
export default {
    data: () => ({
        data: null,
        activeModal: false,
        topicName: "",
        topicDescription: "",
        topicCategory: null,
        isAuth: false,
        isFetch: false,
    }),
    methods: {
        createTopic: async function () {
            const response = await axios.post(
                "/api/topics",
                {
                    title: this.topicName,
                    description: this.topicDescription,
                    to_category: this.topicCategory,
                    category_id: this.topicCategory
                },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
                }
            );
            if (response.data.success) {
                this.isFetch = !this.isFetch;
                this.fetchCategory();
                setTimeout(() => {
                    this.clearData();
                }, 2000);
            }
        },
        clearData: function () {
            this.isFetch = false;
            this.activeModal = false;
            this.topicCategory = 0;
            this.topicName = "";
            this.topicDescription = "";
        },
        openModal: async function (topicCategory) {
            this.topicCategory = topicCategory;
            this.activeModal = !this.activeModal;
        },
        fetchCategory: async function () {
            const dataResponse = await axios.get("/api/category");
            console.log(dataResponse);
            if (dataResponse.data.success) {
                this.data = dataResponse.data.response;
            }
        },
    },
    async mounted() {
        this.fetchCategory();
        this.isAuth = localStorage.getItem("isAuth");
    },
};
</script>

<style></style>
