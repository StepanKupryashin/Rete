<template>
  <div class="w-full">
    <h1 class="text-center">Админ панель</h1>
    <div class="flex w-full justify-around">
        <details>
            <summary>
                Пользователи
            </summary>
            здесь должны быть юзеры
        </details>
        <details>
            <summary>Категории</summary>
            здесь должны быть категории
        </details>
        <details>
            <summary>
                Топики
            </summary>
            здесь должны быть топики
        </details>
    </div>

  </div>

</template>

<script>
export default {
    async created() {
        if(!localStorage.getItem('is_admin')) {
            window.location = '/';
        }
    },
}
</script>

<style>

</style>
