<template>

  <div class="score-menu">
    <span v-for="item in items" :key="item.id" class="score-dropdown__item">
      <input 
        type="checkbox"
        name="item[keyName]"
        class="mr-1"
        @change="reportClick(item.id)"
      >
        {{item[keyName]}}
    </span>
  </div>

</template>

<script>
export default {
  props: {
    items: Array,
    keyName: String,
    filter: String
  },
  methods: {
    reportClick(id) {
      this.$emit('applyFilter', this.filter, id, event.target.checked)
    }
  }

}
</script>

<style>

</style>
