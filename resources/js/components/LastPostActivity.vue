<template>
    <div>
        <div class="top-posts">
            <h2>Последняя активность постов:</h2>
            <vs-table v-if="data" :data="data" :items="data">
                <template #thead>
                  <vs-tr>
                    <vs-th>
                      Пост
                    </vs-th>
                    <vs-th>
                      Топик
                    </vs-th>
                    <vs-th>
                      Автор
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
                      {{ tr.message.slice(0, 40) }}...
                    </vs-td>
                    <vs-td>
                     <a :href="'/topic/' + tr.topic.id">{{ tr.topic.title }}</a>
                    </vs-td>
                    <vs-td>
                      <a :href="'/profile/' + tr.author.id">{{tr.author.name}}</a>
                    </vs-td>
                  </vs-tr>
                </template>
              </vs-table>
        </div>
    </div>
</template>
<script>
export default {
    name: 'LastPostActivity',
    props: {
        data: Array
    },
    created() {
        console.log(this.data)
    }
}
</script>
