<template>
    <div class="w-[80vw]  relative">
        <div class="top-topics">
            <h2>Последняя активность топиков:</h2>
            <vs-table v-if="data" :data="data" :items="data">
                <template #thead>
                  <vs-tr>
                    <vs-th>
                      Топик
                    </vs-th>
                    <vs-th>
                      Описание топика
                    </vs-th>
                    <vs-th>
                      Ссылка
                    </vs-th>
                  </vs-tr>
                </template>
                <template #tbody>
                  <vs-tr
                    :key="i"
                    v-for="(tr, i) in data"
                    :data="tr"
                  >
                    <vs-td>
                      {{ tr.title }}
                    </vs-td>
                    <vs-td>
                     {{ tr.description }}
                    </vs-td>
                    <vs-td>
                      <a :href="'/topic/' + tr.id">Перейти</a>
                    </vs-td>
                  </vs-tr>
                </template>
              </vs-table>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        data: Array
    },
    created() {
        console.log(this.data)
    }
}
</script>
