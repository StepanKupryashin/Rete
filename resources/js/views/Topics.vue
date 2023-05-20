<template>
    <div class="flex flex-col w-full items-center">
        <h1 class="mt-2">Категории</h1>
        <div v-for="cat in data" v-bind:key="cat.id" class="mt-2 bg-slate-300/50 p-4 rounded-lg">
            <div>
                <details>
                    <summary>
                        {{cat.name }} топиков: {{ cat.topics.length }}
                    </summary>
                    <p class="font-medium">
                        Описание:
                        <br>
                        {{ cat.description }}
                    </p>
                    <h2 class="font-bold">Топики:</h2>
                    <div v-for="t in cat.topics" v-bind:key="t.id">
                        <div class="flex flex-col font-medium bg-gray-300/80 mt-2 rounded-lg p-4">
                            <span>Название: {{t.title}}</span>
                            <span>Описание: {{t.description}}</span>
                            <span>Автор:
                                <a :href="'/profile/' + t.author.id"> {{t.author.name}}</a>
                            </span>
                            <span>Кол-во постов: {{t.posts.length}}</span>
                            <a v-bind:href="'/topic/' + t.id" class="text-center text-cyan-700 font-semibold">Перейти</a>
                        </div>

                    </div>
                </details>

            </div>

        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        data: null,
    }),

    async mounted() {
        const dataResponse = await axios.get("/api/category/");
        console.log(dataResponse);
        if (dataResponse.data.success) {
            this.data = dataResponse.data.response;
        }
    },
};
</script>

<style></style>
