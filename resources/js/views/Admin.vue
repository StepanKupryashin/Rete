<template>
    <div class="w-full">
        <h1 class="text-center mt-4 font-bold text-3xl mb-2">Админ панель</h1>
        <div
            class="flex w-full justify-around flex-col items-center"
            v-if="data"
        >
            <details>
                <summary>Пользователи</summary>
                <div>
                    <div
                        v-for="user in AdminData.users"
                        v-bind:key="user.id"
                        class="flex rounded-lg p-2 mb-2 justify-around bg-blue-700/80 text-white font-semibold"
                    >
                        <span>{{ user.name }} </span>
                        <span v-if="user.is_admin">Админ </span>
                        <span v-else>Пользователь </span>
                        <button
                            v-if="!user.current_user"
                            @click="deleteUser(user.id)"
                        >
                            Удалить
                        </button>
                        <span v-else>Текущий</span>
                    </div>
                </div>
            </details>
            <details>
                <summary>Категории</summary>
                <div>
                    <button
                        class="bg-green-400 p-1 mb-2 rounded-lg text-white"
                        @click="isCreateCategory = !isCreateCategory"
                    >
                        Добавить категорию
                    </button>
                    <div>
                        <div
                            v-for="cat in AdminData.categories"
                            v-bind:key="cat.id"
                            class="flex flex-col rounded-lg p-2 mb-2 justify-around bg-blue-700/80 text-white font-semibold"
                        >
                            <span>{{ cat.name }}  </span>
                            <span>
                                Кол-во топиков: {{ cat.topics.length }}
                            </span>
                            <button @click="deleteCategory(cat.id)">Удалить</button>
                        </div>
                    </div>
                </div>
            </details>
            <details>
                <summary>Топики</summary>
                <div>
                    <button
                    class="bg-green-400 p-1 mb-2 rounded-lg text-white"
                    @click="isAddCategoryToTopic = !isAddCategoryToTopic"
                    >Добавить категорию к топику</button>
                    <div>
                        <div
                            v-for="t in AdminData.topics"
                            v-bind:key="t.id"
                            class="flex flex-col rounded-lg p-1 mb-2 justify-around bg-blue-700/80 text-white font-semibold"
                        >
                            <span>{{ t.title }}  </span>
                            <span>Автор: {{ t.author.name }}  </span>
                            <span>Кол-во постов: {{ t.posts.length }}  </span>
                            <span
                                >Кол-во категорий: {{ t.category.length }}  </span
                            >
                            <button @click="deleteTopic(t.id)">Удалить</button>
                        </div>
                    </div>
                </div>
            </details>
        </div>
        <vs-dialog v-model="isCreateCategory">
            <template #header>
                <h1>Создать Категорию</h1>
            </template>
            <div class="w-full flex flex-col">
                <vs-input
                    v-model="categoryName"
                    placeholder="Название Категории"
                >
                </vs-input>
                <vs-input
                    class="mt-2"
                    v-model="categoryDescription"
                    placeholder="Описание категории"
                >
                </vs-input>
            </div>

            <template #footer>
                <button
                    @click="createCategory"
                    class="bg-blue-400 rounded-lg w-full text-center text-white"
                >
                    <span v-if="!isFetch">Создать</span>
                    <span v-else>Создается</span>
                </button>
            </template>
        </vs-dialog>

        <vs-dialog v-model="isAddCategoryToTopic">
            <template #header>
                <h1>Добавить категорию к топику</h1>
            </template>
            <div class="w-full flex flex-col">
                <label>Категория:</label>
                <select  v-model='selectedCategory'>
                    <option v-for="cat in AdminData.categories" v-bind:value="cat.id" v-bind:key="cat.id">{{cat.name}}</option>
                </select>
                <label>Топик:</label>
                <select  v-model='selectedTopic'>
                    <option v-for="topic in AdminData.topics" v-bind:value="topic.id" v-bind:key="topic.id">{{topic.title}}</option>
                </select>
            </div>

            <template #footer>
                <button
                    @click="addCategoryToTopic"
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
import axios from "axios";
export default {
    data: () => ({
        data: [],
        AdminData: null,
        isFetch: false,
        isCreateCategory: false,
        categoryName: "",
        categoryDescription: "",
        isAddCategoryToTopic: false,
        selectedCategory: 1,
        selectedTopic: null,
    }),

    methods: {
        fetchData: async function () {
            const response = await axios.get("/api/admin/main", {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "access_token"
                    )}`,
                },
            });
            console.log(response);
            if (response.data.success) {
                this.AdminData = response.data.response;
            }
            this.selectedCategory = this.AdminData.categories[0].id;
            this.selectedTopic = this.AdminData.topics[0].id;
        },
        deleteUser: async function (id) {
            const response = await axios.delete(`/api/admin/user/${id}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "access_token"
                    )}`,
                },
            });
            console.log(response);
            this.fetchData();
        },
        async createCategory() {
            this.isFetch = true;
            const response = await axios.post(
                "/api/category/",
                {
                    name: this.categoryName,
                    description: this.categoryDescription,
                },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
                }
            );
            console.log(response);
            this.fetchData();
            setTimeout(() => {
                this.isFetch = false;
            }, 2000);
            this.isCreateCategory = false;
        },
        async addCategoryToTopic() {
            this.isFetch = true;
            const response = await axios.post(
                "/api/admin/topics/link_category",
                {
                    category_id: this.selectedCategory,
                    topic_id: this.selectedTopic,
                },
                {
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
                }
            );
            console.log(response);
            this.fetchData();
            setTimeout(() => {
                this.isFetch = false;
            }, 2000);
            this.isAddCategoryToTopic = false;
        },
       async deleteCategory(id) {
            const response = await axios.delete(`/api/category/${id}`, {
                headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
            })
            console.log(response);
            this.fetchData();
        },
        async deleteTopic(id) {
            const response = await axios.delete(`/api/topics/${id}`, {
                headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "access_token"
                        )}`,
                    },
            })
            console.log(response);
            this.fetchData();
        }
    },
    async mounted() {
        this.fetchData();
    },
};
</script>

<style></style>
